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
$vacancies_list = new vacancies_list();

// Run the page
$vacancies_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$vacancies_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$vacancies_list->isExport()) { ?>
<script>
var fvacancieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fvacancieslist = currentForm = new ew.Form("fvacancieslist", "list");
	fvacancieslist.formKeyCountName = '<?php echo $vacancies_list->FormKeyCountName ?>';
	loadjs.done("fvacancieslist");
});
var fvacancieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fvacancieslistsrch = currentSearchForm = new ew.Form("fvacancieslistsrch");

	// Dynamic selection lists
	// Filters

	fvacancieslistsrch.filterList = <?php echo $vacancies_list->getFilterList() ?>;

	// Init search panel as collapsed
	fvacancieslistsrch.initSearchPanel = true;
	loadjs.done("fvacancieslistsrch");
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
<?php if (!$vacancies_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($vacancies_list->TotalRecords > 0 && $vacancies_list->ExportOptions->visible()) { ?>
<?php $vacancies_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($vacancies_list->ImportOptions->visible()) { ?>
<?php $vacancies_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($vacancies_list->SearchOptions->visible()) { ?>
<?php $vacancies_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($vacancies_list->FilterOptions->visible()) { ?>
<?php $vacancies_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$vacancies_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$vacancies_list->isExport() && !$vacancies->CurrentAction) { ?>
<form name="fvacancieslistsrch" id="fvacancieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fvacancieslistsrch-search-panel" class="<?php echo $vacancies_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="vacancies">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $vacancies_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($vacancies_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($vacancies_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $vacancies_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($vacancies_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($vacancies_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($vacancies_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($vacancies_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $vacancies_list->showPageHeader(); ?>
<?php
$vacancies_list->showMessage();
?>
<?php if ($vacancies_list->TotalRecords > 0 || $vacancies->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($vacancies_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> vacancies">
<?php if (!$vacancies_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$vacancies_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $vacancies_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vacancies_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fvacancieslist" id="fvacancieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="vacancies">
<div id="gmp_vacancies" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($vacancies_list->TotalRecords > 0 || $vacancies_list->isGridEdit()) { ?>
<table id="tbl_vacancieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$vacancies->RowType = ROWTYPE_HEADER;

// Render list options
$vacancies_list->renderListOptions();

// Render list options (header, left)
$vacancies_list->ListOptions->render("header", "left");
?>
<?php if ($vacancies_list->PROVINCE->Visible) { // PROVINCE ?>
	<?php if ($vacancies_list->SortUrl($vacancies_list->PROVINCE) == "") { ?>
		<th data-name="PROVINCE" class="<?php echo $vacancies_list->PROVINCE->headerCellClass() ?>"><div id="elh_vacancies_PROVINCE" class="vacancies_PROVINCE"><div class="ew-table-header-caption"><?php echo $vacancies_list->PROVINCE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PROVINCE" class="<?php echo $vacancies_list->PROVINCE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancies_list->SortUrl($vacancies_list->PROVINCE) ?>', 1);"><div id="elh_vacancies_PROVINCE" class="vacancies_PROVINCE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancies_list->PROVINCE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancies_list->PROVINCE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancies_list->PROVINCE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancies_list->LOCAL_AUTHORITY->Visible) { // LOCAL AUTHORITY ?>
	<?php if ($vacancies_list->SortUrl($vacancies_list->LOCAL_AUTHORITY) == "") { ?>
		<th data-name="LOCAL_AUTHORITY" class="<?php echo $vacancies_list->LOCAL_AUTHORITY->headerCellClass() ?>"><div id="elh_vacancies_LOCAL_AUTHORITY" class="vacancies_LOCAL_AUTHORITY"><div class="ew-table-header-caption"><?php echo $vacancies_list->LOCAL_AUTHORITY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LOCAL_AUTHORITY" class="<?php echo $vacancies_list->LOCAL_AUTHORITY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancies_list->SortUrl($vacancies_list->LOCAL_AUTHORITY) ?>', 1);"><div id="elh_vacancies_LOCAL_AUTHORITY" class="vacancies_LOCAL_AUTHORITY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancies_list->LOCAL_AUTHORITY->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancies_list->LOCAL_AUTHORITY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancies_list->LOCAL_AUTHORITY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancies_list->DEPARTMENT->Visible) { // DEPARTMENT ?>
	<?php if ($vacancies_list->SortUrl($vacancies_list->DEPARTMENT) == "") { ?>
		<th data-name="DEPARTMENT" class="<?php echo $vacancies_list->DEPARTMENT->headerCellClass() ?>"><div id="elh_vacancies_DEPARTMENT" class="vacancies_DEPARTMENT"><div class="ew-table-header-caption"><?php echo $vacancies_list->DEPARTMENT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DEPARTMENT" class="<?php echo $vacancies_list->DEPARTMENT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancies_list->SortUrl($vacancies_list->DEPARTMENT) ?>', 1);"><div id="elh_vacancies_DEPARTMENT" class="vacancies_DEPARTMENT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancies_list->DEPARTMENT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancies_list->DEPARTMENT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancies_list->DEPARTMENT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancies_list->SECTION->Visible) { // SECTION ?>
	<?php if ($vacancies_list->SortUrl($vacancies_list->SECTION) == "") { ?>
		<th data-name="SECTION" class="<?php echo $vacancies_list->SECTION->headerCellClass() ?>"><div id="elh_vacancies_SECTION" class="vacancies_SECTION"><div class="ew-table-header-caption"><?php echo $vacancies_list->SECTION->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SECTION" class="<?php echo $vacancies_list->SECTION->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancies_list->SortUrl($vacancies_list->SECTION) ?>', 1);"><div id="elh_vacancies_SECTION" class="vacancies_SECTION">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancies_list->SECTION->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancies_list->SECTION->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancies_list->SECTION->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancies_list->POSITION->Visible) { // POSITION ?>
	<?php if ($vacancies_list->SortUrl($vacancies_list->POSITION) == "") { ?>
		<th data-name="POSITION" class="<?php echo $vacancies_list->POSITION->headerCellClass() ?>"><div id="elh_vacancies_POSITION" class="vacancies_POSITION"><div class="ew-table-header-caption"><?php echo $vacancies_list->POSITION->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="POSITION" class="<?php echo $vacancies_list->POSITION->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancies_list->SortUrl($vacancies_list->POSITION) ?>', 1);"><div id="elh_vacancies_POSITION" class="vacancies_POSITION">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancies_list->POSITION->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancies_list->POSITION->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancies_list->POSITION->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($vacancies_list->SALARY_SCALE->Visible) { // SALARY SCALE ?>
	<?php if ($vacancies_list->SortUrl($vacancies_list->SALARY_SCALE) == "") { ?>
		<th data-name="SALARY_SCALE" class="<?php echo $vacancies_list->SALARY_SCALE->headerCellClass() ?>"><div id="elh_vacancies_SALARY_SCALE" class="vacancies_SALARY_SCALE"><div class="ew-table-header-caption"><?php echo $vacancies_list->SALARY_SCALE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SALARY_SCALE" class="<?php echo $vacancies_list->SALARY_SCALE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $vacancies_list->SortUrl($vacancies_list->SALARY_SCALE) ?>', 1);"><div id="elh_vacancies_SALARY_SCALE" class="vacancies_SALARY_SCALE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $vacancies_list->SALARY_SCALE->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($vacancies_list->SALARY_SCALE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($vacancies_list->SALARY_SCALE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$vacancies_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($vacancies_list->ExportAll && $vacancies_list->isExport()) {
	$vacancies_list->StopRecord = $vacancies_list->TotalRecords;
} else {

	// Set the last record to display
	if ($vacancies_list->TotalRecords > $vacancies_list->StartRecord + $vacancies_list->DisplayRecords - 1)
		$vacancies_list->StopRecord = $vacancies_list->StartRecord + $vacancies_list->DisplayRecords - 1;
	else
		$vacancies_list->StopRecord = $vacancies_list->TotalRecords;
}
$vacancies_list->RecordCount = $vacancies_list->StartRecord - 1;
if ($vacancies_list->Recordset && !$vacancies_list->Recordset->EOF) {
	$vacancies_list->Recordset->moveFirst();
	$selectLimit = $vacancies_list->UseSelectLimit;
	if (!$selectLimit && $vacancies_list->StartRecord > 1)
		$vacancies_list->Recordset->move($vacancies_list->StartRecord - 1);
} elseif (!$vacancies->AllowAddDeleteRow && $vacancies_list->StopRecord == 0) {
	$vacancies_list->StopRecord = $vacancies->GridAddRowCount;
}

// Initialize aggregate
$vacancies->RowType = ROWTYPE_AGGREGATEINIT;
$vacancies->resetAttributes();
$vacancies_list->renderRow();
while ($vacancies_list->RecordCount < $vacancies_list->StopRecord) {
	$vacancies_list->RecordCount++;
	if ($vacancies_list->RecordCount >= $vacancies_list->StartRecord) {
		$vacancies_list->RowCount++;

		// Set up key count
		$vacancies_list->KeyCount = $vacancies_list->RowIndex;

		// Init row class and style
		$vacancies->resetAttributes();
		$vacancies->CssClass = "";
		if ($vacancies_list->isGridAdd()) {
		} else {
			$vacancies_list->loadRowValues($vacancies_list->Recordset); // Load row values
		}
		$vacancies->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$vacancies->RowAttrs->merge(["data-rowindex" => $vacancies_list->RowCount, "id" => "r" . $vacancies_list->RowCount . "_vacancies", "data-rowtype" => $vacancies->RowType]);

		// Render row
		$vacancies_list->renderRow();

		// Render list options
		$vacancies_list->renderListOptions();
?>
	<tr <?php echo $vacancies->rowAttributes() ?>>
<?php

// Render list options (body, left)
$vacancies_list->ListOptions->render("body", "left", $vacancies_list->RowCount);
?>
	<?php if ($vacancies_list->PROVINCE->Visible) { // PROVINCE ?>
		<td data-name="PROVINCE" <?php echo $vacancies_list->PROVINCE->cellAttributes() ?>>
<span id="el<?php echo $vacancies_list->RowCount ?>_vacancies_PROVINCE">
<span<?php echo $vacancies_list->PROVINCE->viewAttributes() ?>><?php echo $vacancies_list->PROVINCE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancies_list->LOCAL_AUTHORITY->Visible) { // LOCAL AUTHORITY ?>
		<td data-name="LOCAL_AUTHORITY" <?php echo $vacancies_list->LOCAL_AUTHORITY->cellAttributes() ?>>
<span id="el<?php echo $vacancies_list->RowCount ?>_vacancies_LOCAL_AUTHORITY">
<span<?php echo $vacancies_list->LOCAL_AUTHORITY->viewAttributes() ?>><?php echo $vacancies_list->LOCAL_AUTHORITY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancies_list->DEPARTMENT->Visible) { // DEPARTMENT ?>
		<td data-name="DEPARTMENT" <?php echo $vacancies_list->DEPARTMENT->cellAttributes() ?>>
<span id="el<?php echo $vacancies_list->RowCount ?>_vacancies_DEPARTMENT">
<span<?php echo $vacancies_list->DEPARTMENT->viewAttributes() ?>><?php echo $vacancies_list->DEPARTMENT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancies_list->SECTION->Visible) { // SECTION ?>
		<td data-name="SECTION" <?php echo $vacancies_list->SECTION->cellAttributes() ?>>
<span id="el<?php echo $vacancies_list->RowCount ?>_vacancies_SECTION">
<span<?php echo $vacancies_list->SECTION->viewAttributes() ?>><?php echo $vacancies_list->SECTION->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancies_list->POSITION->Visible) { // POSITION ?>
		<td data-name="POSITION" <?php echo $vacancies_list->POSITION->cellAttributes() ?>>
<span id="el<?php echo $vacancies_list->RowCount ?>_vacancies_POSITION">
<span<?php echo $vacancies_list->POSITION->viewAttributes() ?>><?php echo $vacancies_list->POSITION->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($vacancies_list->SALARY_SCALE->Visible) { // SALARY SCALE ?>
		<td data-name="SALARY_SCALE" <?php echo $vacancies_list->SALARY_SCALE->cellAttributes() ?>>
<span id="el<?php echo $vacancies_list->RowCount ?>_vacancies_SALARY_SCALE">
<span<?php echo $vacancies_list->SALARY_SCALE->viewAttributes() ?>><?php echo $vacancies_list->SALARY_SCALE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$vacancies_list->ListOptions->render("body", "right", $vacancies_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$vacancies_list->isGridAdd())
		$vacancies_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$vacancies->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($vacancies_list->Recordset)
	$vacancies_list->Recordset->Close();
?>
<?php if (!$vacancies_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$vacancies_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $vacancies_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $vacancies_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($vacancies_list->TotalRecords == 0 && !$vacancies->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $vacancies_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$vacancies_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$vacancies_list->isExport()) { ?>
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
$vacancies_list->terminate();
?>