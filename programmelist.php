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
$programme_list = new programme_list();

// Run the page
$programme_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$programme_list->isExport()) { ?>
<script>
var fprogrammelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprogrammelist = currentForm = new ew.Form("fprogrammelist", "list");
	fprogrammelist.formKeyCountName = '<?php echo $programme_list->FormKeyCountName ?>';
	loadjs.done("fprogrammelist");
});
var fprogrammelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprogrammelistsrch = currentSearchForm = new ew.Form("fprogrammelistsrch");

	// Dynamic selection lists
	// Filters

	fprogrammelistsrch.filterList = <?php echo $programme_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprogrammelistsrch.initSearchPanel = true;
	loadjs.done("fprogrammelistsrch");
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
<?php if (!$programme_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($programme_list->TotalRecords > 0 && $programme_list->ExportOptions->visible()) { ?>
<?php $programme_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($programme_list->ImportOptions->visible()) { ?>
<?php $programme_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($programme_list->SearchOptions->visible()) { ?>
<?php $programme_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($programme_list->FilterOptions->visible()) { ?>
<?php $programme_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$programme_list->isExport() || Config("EXPORT_MASTER_RECORD") && $programme_list->isExport("print")) { ?>
<?php
if ($programme_list->DbMasterFilter != "" && $programme->getCurrentMasterTable() == "dept_section") {
	if ($programme_list->MasterRecordExists) {
		include_once "dept_sectionmaster.php";
	}
}
?>
<?php } ?>
<?php
$programme_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$programme_list->isExport() && !$programme->CurrentAction) { ?>
<form name="fprogrammelistsrch" id="fprogrammelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprogrammelistsrch-search-panel" class="<?php echo $programme_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="programme">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $programme_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($programme_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($programme_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $programme_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($programme_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($programme_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($programme_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($programme_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $programme_list->showPageHeader(); ?>
<?php
$programme_list->showMessage();
?>
<?php if ($programme_list->TotalRecords > 0 || $programme->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($programme_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> programme">
<?php if (!$programme_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$programme_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $programme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprogrammelist" id="fprogrammelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme">
<?php if ($programme->getCurrentMasterTable() == "dept_section" && $programme->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="dept_section">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($programme_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($programme_list->LACode->getSessionValue()) ?>">
<input type="hidden" name="fk_SectionCode" value="<?php echo HtmlEncode($programme_list->SectionCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_programme" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($programme_list->TotalRecords > 0 || $programme_list->isGridEdit()) { ?>
<table id="tbl_programmelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$programme->RowType = ROWTYPE_HEADER;

// Render list options
$programme_list->renderListOptions();

// Render list options (header, left)
$programme_list->ListOptions->render("header", "left");
?>
<?php if ($programme_list->LACode->Visible) { // LACode ?>
	<?php if ($programme_list->SortUrl($programme_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $programme_list->LACode->headerCellClass() ?>"><div id="elh_programme_LACode" class="programme_LACode"><div class="ew-table-header-caption"><?php echo $programme_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $programme_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->LACode) ?>', 1);"><div id="elh_programme_LACode" class="programme_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($programme_list->SortUrl($programme_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $programme_list->DepartmentCode->headerCellClass() ?>"><div id="elh_programme_DepartmentCode" class="programme_DepartmentCode"><div class="ew-table-header-caption"><?php echo $programme_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $programme_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->DepartmentCode) ?>', 1);"><div id="elh_programme_DepartmentCode" class="programme_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($programme_list->SortUrl($programme_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $programme_list->SectionCode->headerCellClass() ?>"><div id="elh_programme_SectionCode" class="programme_SectionCode"><div class="ew-table-header-caption"><?php echo $programme_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $programme_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->SectionCode) ?>', 1);"><div id="elh_programme_SectionCode" class="programme_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_list->IFMISProgramme->Visible) { // IFMISProgramme ?>
	<?php if ($programme_list->SortUrl($programme_list->IFMISProgramme) == "") { ?>
		<th data-name="IFMISProgramme" class="<?php echo $programme_list->IFMISProgramme->headerCellClass() ?>"><div id="elh_programme_IFMISProgramme" class="programme_IFMISProgramme"><div class="ew-table-header-caption"><?php echo $programme_list->IFMISProgramme->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IFMISProgramme" class="<?php echo $programme_list->IFMISProgramme->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->IFMISProgramme) ?>', 1);"><div id="elh_programme_IFMISProgramme" class="programme_IFMISProgramme">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->IFMISProgramme->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_list->IFMISProgramme->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->IFMISProgramme->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($programme_list->SortUrl($programme_list->ProgrammeCode) == "") { ?>
		<th data-name="ProgrammeCode" class="<?php echo $programme_list->ProgrammeCode->headerCellClass() ?>"><div id="elh_programme_ProgrammeCode" class="programme_ProgrammeCode"><div class="ew-table-header-caption"><?php echo $programme_list->ProgrammeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeCode" class="<?php echo $programme_list->ProgrammeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->ProgrammeCode) ?>', 1);"><div id="elh_programme_ProgrammeCode" class="programme_ProgrammeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->ProgrammeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_list->ProgrammeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->ProgrammeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_list->ProgrammeName->Visible) { // ProgrammeName ?>
	<?php if ($programme_list->SortUrl($programme_list->ProgrammeName) == "") { ?>
		<th data-name="ProgrammeName" class="<?php echo $programme_list->ProgrammeName->headerCellClass() ?>"><div id="elh_programme_ProgrammeName" class="programme_ProgrammeName"><div class="ew-table-header-caption"><?php echo $programme_list->ProgrammeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeName" class="<?php echo $programme_list->ProgrammeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->ProgrammeName) ?>', 1);"><div id="elh_programme_ProgrammeName" class="programme_ProgrammeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->ProgrammeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_list->ProgrammeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->ProgrammeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_list->ProgrammeType->Visible) { // ProgrammeType ?>
	<?php if ($programme_list->SortUrl($programme_list->ProgrammeType) == "") { ?>
		<th data-name="ProgrammeType" class="<?php echo $programme_list->ProgrammeType->headerCellClass() ?>"><div id="elh_programme_ProgrammeType" class="programme_ProgrammeType"><div class="ew-table-header-caption"><?php echo $programme_list->ProgrammeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeType" class="<?php echo $programme_list->ProgrammeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_list->SortUrl($programme_list->ProgrammeType) ?>', 1);"><div id="elh_programme_ProgrammeType" class="programme_ProgrammeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_list->ProgrammeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_list->ProgrammeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_list->ProgrammeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$programme_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($programme_list->ExportAll && $programme_list->isExport()) {
	$programme_list->StopRecord = $programme_list->TotalRecords;
} else {

	// Set the last record to display
	if ($programme_list->TotalRecords > $programme_list->StartRecord + $programme_list->DisplayRecords - 1)
		$programme_list->StopRecord = $programme_list->StartRecord + $programme_list->DisplayRecords - 1;
	else
		$programme_list->StopRecord = $programme_list->TotalRecords;
}
$programme_list->RecordCount = $programme_list->StartRecord - 1;
if ($programme_list->Recordset && !$programme_list->Recordset->EOF) {
	$programme_list->Recordset->moveFirst();
	$selectLimit = $programme_list->UseSelectLimit;
	if (!$selectLimit && $programme_list->StartRecord > 1)
		$programme_list->Recordset->move($programme_list->StartRecord - 1);
} elseif (!$programme->AllowAddDeleteRow && $programme_list->StopRecord == 0) {
	$programme_list->StopRecord = $programme->GridAddRowCount;
}

// Initialize aggregate
$programme->RowType = ROWTYPE_AGGREGATEINIT;
$programme->resetAttributes();
$programme_list->renderRow();
while ($programme_list->RecordCount < $programme_list->StopRecord) {
	$programme_list->RecordCount++;
	if ($programme_list->RecordCount >= $programme_list->StartRecord) {
		$programme_list->RowCount++;

		// Set up key count
		$programme_list->KeyCount = $programme_list->RowIndex;

		// Init row class and style
		$programme->resetAttributes();
		$programme->CssClass = "";
		if ($programme_list->isGridAdd()) {
		} else {
			$programme_list->loadRowValues($programme_list->Recordset); // Load row values
		}
		$programme->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$programme->RowAttrs->merge(["data-rowindex" => $programme_list->RowCount, "id" => "r" . $programme_list->RowCount . "_programme", "data-rowtype" => $programme->RowType]);

		// Render row
		$programme_list->renderRow();

		// Render list options
		$programme_list->renderListOptions();
?>
	<tr <?php echo $programme->rowAttributes() ?>>
<?php

// Render list options (body, left)
$programme_list->ListOptions->render("body", "left", $programme_list->RowCount);
?>
	<?php if ($programme_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $programme_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_LACode">
<span<?php echo $programme_list->LACode->viewAttributes() ?>><?php echo $programme_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $programme_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_DepartmentCode">
<span<?php echo $programme_list->DepartmentCode->viewAttributes() ?>><?php echo $programme_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $programme_list->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_SectionCode">
<span<?php echo $programme_list->SectionCode->viewAttributes() ?>><?php echo $programme_list->SectionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_list->IFMISProgramme->Visible) { // IFMISProgramme ?>
		<td data-name="IFMISProgramme" <?php echo $programme_list->IFMISProgramme->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_IFMISProgramme">
<span<?php echo $programme_list->IFMISProgramme->viewAttributes() ?>><?php echo $programme_list->IFMISProgramme->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode" <?php echo $programme_list->ProgrammeCode->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_ProgrammeCode">
<span<?php echo $programme_list->ProgrammeCode->viewAttributes() ?>><?php echo $programme_list->ProgrammeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_list->ProgrammeName->Visible) { // ProgrammeName ?>
		<td data-name="ProgrammeName" <?php echo $programme_list->ProgrammeName->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_ProgrammeName">
<span<?php echo $programme_list->ProgrammeName->viewAttributes() ?>><?php echo $programme_list->ProgrammeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_list->ProgrammeType->Visible) { // ProgrammeType ?>
		<td data-name="ProgrammeType" <?php echo $programme_list->ProgrammeType->cellAttributes() ?>>
<span id="el<?php echo $programme_list->RowCount ?>_programme_ProgrammeType">
<span<?php echo $programme_list->ProgrammeType->viewAttributes() ?>><?php echo $programme_list->ProgrammeType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$programme_list->ListOptions->render("body", "right", $programme_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$programme_list->isGridAdd())
		$programme_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$programme->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($programme_list->Recordset)
	$programme_list->Recordset->Close();
?>
<?php if (!$programme_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$programme_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $programme_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($programme_list->TotalRecords == 0 && !$programme->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $programme_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$programme_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$programme_list->isExport()) { ?>
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
$programme_list->terminate();
?>