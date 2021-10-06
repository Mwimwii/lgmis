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
$programme_type_list = new programme_type_list();

// Run the page
$programme_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$programme_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$programme_type_list->isExport()) { ?>
<script>
var fprogramme_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprogramme_typelist = currentForm = new ew.Form("fprogramme_typelist", "list");
	fprogramme_typelist.formKeyCountName = '<?php echo $programme_type_list->FormKeyCountName ?>';
	loadjs.done("fprogramme_typelist");
});
var fprogramme_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprogramme_typelistsrch = currentSearchForm = new ew.Form("fprogramme_typelistsrch");

	// Dynamic selection lists
	// Filters

	fprogramme_typelistsrch.filterList = <?php echo $programme_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprogramme_typelistsrch.initSearchPanel = true;
	loadjs.done("fprogramme_typelistsrch");
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
<?php if (!$programme_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($programme_type_list->TotalRecords > 0 && $programme_type_list->ExportOptions->visible()) { ?>
<?php $programme_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($programme_type_list->ImportOptions->visible()) { ?>
<?php $programme_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($programme_type_list->SearchOptions->visible()) { ?>
<?php $programme_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($programme_type_list->FilterOptions->visible()) { ?>
<?php $programme_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$programme_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$programme_type_list->isExport() && !$programme_type->CurrentAction) { ?>
<form name="fprogramme_typelistsrch" id="fprogramme_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprogramme_typelistsrch-search-panel" class="<?php echo $programme_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="programme_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $programme_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($programme_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($programme_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $programme_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($programme_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($programme_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($programme_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($programme_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $programme_type_list->showPageHeader(); ?>
<?php
$programme_type_list->showMessage();
?>
<?php if ($programme_type_list->TotalRecords > 0 || $programme_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($programme_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> programme_type">
<?php if (!$programme_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$programme_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $programme_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprogramme_typelist" id="fprogramme_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="programme_type">
<div id="gmp_programme_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($programme_type_list->TotalRecords > 0 || $programme_type_list->isGridEdit()) { ?>
<table id="tbl_programme_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$programme_type->RowType = ROWTYPE_HEADER;

// Render list options
$programme_type_list->renderListOptions();

// Render list options (header, left)
$programme_type_list->ListOptions->render("header", "left");
?>
<?php if ($programme_type_list->ProgrammeType->Visible) { // ProgrammeType ?>
	<?php if ($programme_type_list->SortUrl($programme_type_list->ProgrammeType) == "") { ?>
		<th data-name="ProgrammeType" class="<?php echo $programme_type_list->ProgrammeType->headerCellClass() ?>"><div id="elh_programme_type_ProgrammeType" class="programme_type_ProgrammeType"><div class="ew-table-header-caption"><?php echo $programme_type_list->ProgrammeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeType" class="<?php echo $programme_type_list->ProgrammeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_type_list->SortUrl($programme_type_list->ProgrammeType) ?>', 1);"><div id="elh_programme_type_ProgrammeType" class="programme_type_ProgrammeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_type_list->ProgrammeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($programme_type_list->ProgrammeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_type_list->ProgrammeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($programme_type_list->ProgrammeTypeDesc->Visible) { // ProgrammeTypeDesc ?>
	<?php if ($programme_type_list->SortUrl($programme_type_list->ProgrammeTypeDesc) == "") { ?>
		<th data-name="ProgrammeTypeDesc" class="<?php echo $programme_type_list->ProgrammeTypeDesc->headerCellClass() ?>"><div id="elh_programme_type_ProgrammeTypeDesc" class="programme_type_ProgrammeTypeDesc"><div class="ew-table-header-caption"><?php echo $programme_type_list->ProgrammeTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgrammeTypeDesc" class="<?php echo $programme_type_list->ProgrammeTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $programme_type_list->SortUrl($programme_type_list->ProgrammeTypeDesc) ?>', 1);"><div id="elh_programme_type_ProgrammeTypeDesc" class="programme_type_ProgrammeTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $programme_type_list->ProgrammeTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($programme_type_list->ProgrammeTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($programme_type_list->ProgrammeTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$programme_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($programme_type_list->ExportAll && $programme_type_list->isExport()) {
	$programme_type_list->StopRecord = $programme_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($programme_type_list->TotalRecords > $programme_type_list->StartRecord + $programme_type_list->DisplayRecords - 1)
		$programme_type_list->StopRecord = $programme_type_list->StartRecord + $programme_type_list->DisplayRecords - 1;
	else
		$programme_type_list->StopRecord = $programme_type_list->TotalRecords;
}
$programme_type_list->RecordCount = $programme_type_list->StartRecord - 1;
if ($programme_type_list->Recordset && !$programme_type_list->Recordset->EOF) {
	$programme_type_list->Recordset->moveFirst();
	$selectLimit = $programme_type_list->UseSelectLimit;
	if (!$selectLimit && $programme_type_list->StartRecord > 1)
		$programme_type_list->Recordset->move($programme_type_list->StartRecord - 1);
} elseif (!$programme_type->AllowAddDeleteRow && $programme_type_list->StopRecord == 0) {
	$programme_type_list->StopRecord = $programme_type->GridAddRowCount;
}

// Initialize aggregate
$programme_type->RowType = ROWTYPE_AGGREGATEINIT;
$programme_type->resetAttributes();
$programme_type_list->renderRow();
while ($programme_type_list->RecordCount < $programme_type_list->StopRecord) {
	$programme_type_list->RecordCount++;
	if ($programme_type_list->RecordCount >= $programme_type_list->StartRecord) {
		$programme_type_list->RowCount++;

		// Set up key count
		$programme_type_list->KeyCount = $programme_type_list->RowIndex;

		// Init row class and style
		$programme_type->resetAttributes();
		$programme_type->CssClass = "";
		if ($programme_type_list->isGridAdd()) {
		} else {
			$programme_type_list->loadRowValues($programme_type_list->Recordset); // Load row values
		}
		$programme_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$programme_type->RowAttrs->merge(["data-rowindex" => $programme_type_list->RowCount, "id" => "r" . $programme_type_list->RowCount . "_programme_type", "data-rowtype" => $programme_type->RowType]);

		// Render row
		$programme_type_list->renderRow();

		// Render list options
		$programme_type_list->renderListOptions();
?>
	<tr <?php echo $programme_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$programme_type_list->ListOptions->render("body", "left", $programme_type_list->RowCount);
?>
	<?php if ($programme_type_list->ProgrammeType->Visible) { // ProgrammeType ?>
		<td data-name="ProgrammeType" <?php echo $programme_type_list->ProgrammeType->cellAttributes() ?>>
<span id="el<?php echo $programme_type_list->RowCount ?>_programme_type_ProgrammeType">
<span<?php echo $programme_type_list->ProgrammeType->viewAttributes() ?>><?php echo $programme_type_list->ProgrammeType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($programme_type_list->ProgrammeTypeDesc->Visible) { // ProgrammeTypeDesc ?>
		<td data-name="ProgrammeTypeDesc" <?php echo $programme_type_list->ProgrammeTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $programme_type_list->RowCount ?>_programme_type_ProgrammeTypeDesc">
<span<?php echo $programme_type_list->ProgrammeTypeDesc->viewAttributes() ?>><?php echo $programme_type_list->ProgrammeTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$programme_type_list->ListOptions->render("body", "right", $programme_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$programme_type_list->isGridAdd())
		$programme_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$programme_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($programme_type_list->Recordset)
	$programme_type_list->Recordset->Close();
?>
<?php if (!$programme_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$programme_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $programme_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $programme_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($programme_type_list->TotalRecords == 0 && !$programme_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $programme_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$programme_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$programme_type_list->isExport()) { ?>
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
$programme_type_list->terminate();
?>