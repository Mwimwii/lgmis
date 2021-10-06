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
$programme_ref_list = new programme_ref_list();

// Run the page
$programme_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$programme_ref_list->isExport()) { ?>
<script>
var fprogramme_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprogramme_reflist = currentForm = new ew.Form("fprogramme_reflist", "list");
	fprogramme_reflist.formKeyCountName = '<?php echo $programme_ref_list->FormKeyCountName ?>';
	loadjs.done("fprogramme_reflist");
});
var fprogramme_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprogramme_reflistsrch = currentSearchForm = new ew.Form("fprogramme_reflistsrch");

	// Dynamic selection lists
	// Filters

	fprogramme_reflistsrch.filterList = <?php echo $programme_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprogramme_reflistsrch.initSearchPanel = true;
	loadjs.done("fprogramme_reflistsrch");
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
<?php if (!$programme_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($programme_ref_list->TotalRecords > 0 && $programme_ref_list->ExportOptions->visible()) { ?>
<?php $programme_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($programme_ref_list->ImportOptions->visible()) { ?>
<?php $programme_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($programme_ref_list->SearchOptions->visible()) { ?>
<?php $programme_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($programme_ref_list->FilterOptions->visible()) { ?>
<?php $programme_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$programme_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$programme_ref_list->isExport() && !$programme_ref->CurrentAction) { ?>
<form name="fprogramme_reflistsrch" id="fprogramme_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprogramme_reflistsrch-search-panel" class="<?php echo $programme_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="programme_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $programme_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($programme_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($programme_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $programme_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($programme_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($programme_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($programme_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($programme_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $programme_ref_list->showPageHeader(); ?>
<?php
$programme_ref_list->showMessage();
?>
<?php if ($programme_ref_list->TotalRecords > 0 || $programme_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($programme_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> programme_ref">
<?php if (!$programme_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$programme_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $programme_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprogramme_reflist" id="fprogramme_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_ref">
<div id="gmp_programme_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($programme_ref_list->TotalRecords > 0 || $programme_ref_list->isGridEdit()) { ?>
<table id="tbl_programme_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$programme_ref->RowType = ROWTYPE_HEADER;

// Render list options
$programme_ref_list->renderListOptions();

// Render list options (header, left)
$programme_ref_list->ListOptions->render("header", "left");
?>
<?php if ($programme_ref_list->ProgRefCode->Visible) { // ProgRefCode ?>
	<?php if ($programme_ref_list->SortUrl($programme_ref_list->ProgRefCode) == "") { ?>
		<th data-name="ProgRefCode" class="<?php echo $programme_ref_list->ProgRefCode->headerCellClass() ?>"><div id="elh_programme_ref_ProgRefCode" class="programme_ref_ProgRefCode"><div class="ew-table-header-caption"><?php echo $programme_ref_list->ProgRefCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgRefCode" class="<?php echo $programme_ref_list->ProgRefCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_ref_list->SortUrl($programme_ref_list->ProgRefCode) ?>', 1);"><div id="elh_programme_ref_ProgRefCode" class="programme_ref_ProgRefCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_ref_list->ProgRefCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_ref_list->ProgRefCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_ref_list->ProgRefCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_ref_list->FunctionCode->Visible) { // FunctionCode ?>
	<?php if ($programme_ref_list->SortUrl($programme_ref_list->FunctionCode) == "") { ?>
		<th data-name="FunctionCode" class="<?php echo $programme_ref_list->FunctionCode->headerCellClass() ?>"><div id="elh_programme_ref_FunctionCode" class="programme_ref_FunctionCode"><div class="ew-table-header-caption"><?php echo $programme_ref_list->FunctionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FunctionCode" class="<?php echo $programme_ref_list->FunctionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_ref_list->SortUrl($programme_ref_list->FunctionCode) ?>', 1);"><div id="elh_programme_ref_FunctionCode" class="programme_ref_FunctionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_ref_list->FunctionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_ref_list->FunctionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_ref_list->FunctionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_ref_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
	<?php if ($programme_ref_list->SortUrl($programme_ref_list->ProgrammeCode) == "") { ?>
		<th data-name="ProgrammeCode" class="<?php echo $programme_ref_list->ProgrammeCode->headerCellClass() ?>"><div id="elh_programme_ref_ProgrammeCode" class="programme_ref_ProgrammeCode"><div class="ew-table-header-caption"><?php echo $programme_ref_list->ProgrammeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeCode" class="<?php echo $programme_ref_list->ProgrammeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_ref_list->SortUrl($programme_ref_list->ProgrammeCode) ?>', 1);"><div id="elh_programme_ref_ProgrammeCode" class="programme_ref_ProgrammeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_ref_list->ProgrammeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_ref_list->ProgrammeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_ref_list->ProgrammeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_ref_list->ProgrammeName->Visible) { // ProgrammeName ?>
	<?php if ($programme_ref_list->SortUrl($programme_ref_list->ProgrammeName) == "") { ?>
		<th data-name="ProgrammeName" class="<?php echo $programme_ref_list->ProgrammeName->headerCellClass() ?>"><div id="elh_programme_ref_ProgrammeName" class="programme_ref_ProgrammeName"><div class="ew-table-header-caption"><?php echo $programme_ref_list->ProgrammeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeName" class="<?php echo $programme_ref_list->ProgrammeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_ref_list->SortUrl($programme_ref_list->ProgrammeName) ?>', 1);"><div id="elh_programme_ref_ProgrammeName" class="programme_ref_ProgrammeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_ref_list->ProgrammeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_ref_list->ProgrammeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_ref_list->ProgrammeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$programme_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($programme_ref_list->ExportAll && $programme_ref_list->isExport()) {
	$programme_ref_list->StopRecord = $programme_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($programme_ref_list->TotalRecords > $programme_ref_list->StartRecord + $programme_ref_list->DisplayRecords - 1)
		$programme_ref_list->StopRecord = $programme_ref_list->StartRecord + $programme_ref_list->DisplayRecords - 1;
	else
		$programme_ref_list->StopRecord = $programme_ref_list->TotalRecords;
}
$programme_ref_list->RecordCount = $programme_ref_list->StartRecord - 1;
if ($programme_ref_list->Recordset && !$programme_ref_list->Recordset->EOF) {
	$programme_ref_list->Recordset->moveFirst();
	$selectLimit = $programme_ref_list->UseSelectLimit;
	if (!$selectLimit && $programme_ref_list->StartRecord > 1)
		$programme_ref_list->Recordset->move($programme_ref_list->StartRecord - 1);
} elseif (!$programme_ref->AllowAddDeleteRow && $programme_ref_list->StopRecord == 0) {
	$programme_ref_list->StopRecord = $programme_ref->GridAddRowCount;
}

// Initialize aggregate
$programme_ref->RowType = ROWTYPE_AGGREGATEINIT;
$programme_ref->resetAttributes();
$programme_ref_list->renderRow();
while ($programme_ref_list->RecordCount < $programme_ref_list->StopRecord) {
	$programme_ref_list->RecordCount++;
	if ($programme_ref_list->RecordCount >= $programme_ref_list->StartRecord) {
		$programme_ref_list->RowCount++;

		// Set up key count
		$programme_ref_list->KeyCount = $programme_ref_list->RowIndex;

		// Init row class and style
		$programme_ref->resetAttributes();
		$programme_ref->CssClass = "";
		if ($programme_ref_list->isGridAdd()) {
		} else {
			$programme_ref_list->loadRowValues($programme_ref_list->Recordset); // Load row values
		}
		$programme_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$programme_ref->RowAttrs->merge(["data-rowindex" => $programme_ref_list->RowCount, "id" => "r" . $programme_ref_list->RowCount . "_programme_ref", "data-rowtype" => $programme_ref->RowType]);

		// Render row
		$programme_ref_list->renderRow();

		// Render list options
		$programme_ref_list->renderListOptions();
?>
	<tr <?php echo $programme_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$programme_ref_list->ListOptions->render("body", "left", $programme_ref_list->RowCount);
?>
	<?php if ($programme_ref_list->ProgRefCode->Visible) { // ProgRefCode ?>
		<td data-name="ProgRefCode" <?php echo $programme_ref_list->ProgRefCode->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_list->RowCount ?>_programme_ref_ProgRefCode">
<span<?php echo $programme_ref_list->ProgRefCode->viewAttributes() ?>><?php echo $programme_ref_list->ProgRefCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_ref_list->FunctionCode->Visible) { // FunctionCode ?>
		<td data-name="FunctionCode" <?php echo $programme_ref_list->FunctionCode->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_list->RowCount ?>_programme_ref_FunctionCode">
<span<?php echo $programme_ref_list->FunctionCode->viewAttributes() ?>><?php echo $programme_ref_list->FunctionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_ref_list->ProgrammeCode->Visible) { // ProgrammeCode ?>
		<td data-name="ProgrammeCode" <?php echo $programme_ref_list->ProgrammeCode->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_list->RowCount ?>_programme_ref_ProgrammeCode">
<span<?php echo $programme_ref_list->ProgrammeCode->viewAttributes() ?>><?php echo $programme_ref_list->ProgrammeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_ref_list->ProgrammeName->Visible) { // ProgrammeName ?>
		<td data-name="ProgrammeName" <?php echo $programme_ref_list->ProgrammeName->cellAttributes() ?>>
<span id="el<?php echo $programme_ref_list->RowCount ?>_programme_ref_ProgrammeName">
<span<?php echo $programme_ref_list->ProgrammeName->viewAttributes() ?>><?php echo $programme_ref_list->ProgrammeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$programme_ref_list->ListOptions->render("body", "right", $programme_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$programme_ref_list->isGridAdd())
		$programme_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$programme_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($programme_ref_list->Recordset)
	$programme_ref_list->Recordset->Close();
?>
<?php if (!$programme_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$programme_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $programme_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($programme_ref_list->TotalRecords == 0 && !$programme_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $programme_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$programme_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$programme_ref_list->isExport()) { ?>
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
$programme_ref_list->terminate();
?>