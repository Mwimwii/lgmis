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
$retirement_type_list = new retirement_type_list();

// Run the page
$retirement_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$retirement_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$retirement_type_list->isExport()) { ?>
<script>
var fretirement_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fretirement_typelist = currentForm = new ew.Form("fretirement_typelist", "list");
	fretirement_typelist.formKeyCountName = '<?php echo $retirement_type_list->FormKeyCountName ?>';
	loadjs.done("fretirement_typelist");
});
var fretirement_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fretirement_typelistsrch = currentSearchForm = new ew.Form("fretirement_typelistsrch");

	// Dynamic selection lists
	// Filters

	fretirement_typelistsrch.filterList = <?php echo $retirement_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fretirement_typelistsrch.initSearchPanel = true;
	loadjs.done("fretirement_typelistsrch");
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
<?php if (!$retirement_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($retirement_type_list->TotalRecords > 0 && $retirement_type_list->ExportOptions->visible()) { ?>
<?php $retirement_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($retirement_type_list->ImportOptions->visible()) { ?>
<?php $retirement_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($retirement_type_list->SearchOptions->visible()) { ?>
<?php $retirement_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($retirement_type_list->FilterOptions->visible()) { ?>
<?php $retirement_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$retirement_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$retirement_type_list->isExport() && !$retirement_type->CurrentAction) { ?>
<form name="fretirement_typelistsrch" id="fretirement_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fretirement_typelistsrch-search-panel" class="<?php echo $retirement_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="retirement_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $retirement_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($retirement_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($retirement_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $retirement_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($retirement_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($retirement_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($retirement_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($retirement_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $retirement_type_list->showPageHeader(); ?>
<?php
$retirement_type_list->showMessage();
?>
<?php if ($retirement_type_list->TotalRecords > 0 || $retirement_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($retirement_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> retirement_type">
<?php if (!$retirement_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$retirement_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $retirement_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $retirement_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fretirement_typelist" id="fretirement_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="retirement_type">
<div id="gmp_retirement_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($retirement_type_list->TotalRecords > 0 || $retirement_type_list->isGridEdit()) { ?>
<table id="tbl_retirement_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$retirement_type->RowType = ROWTYPE_HEADER;

// Render list options
$retirement_type_list->renderListOptions();

// Render list options (header, left)
$retirement_type_list->ListOptions->render("header", "left");
?>
<?php if ($retirement_type_list->RetirementCode->Visible) { // RetirementCode ?>
	<?php if ($retirement_type_list->SortUrl($retirement_type_list->RetirementCode) == "") { ?>
		<th data-name="RetirementCode" class="<?php echo $retirement_type_list->RetirementCode->headerCellClass() ?>"><div id="elh_retirement_type_RetirementCode" class="retirement_type_RetirementCode"><div class="ew-table-header-caption"><?php echo $retirement_type_list->RetirementCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetirementCode" class="<?php echo $retirement_type_list->RetirementCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $retirement_type_list->SortUrl($retirement_type_list->RetirementCode) ?>', 1);"><div id="elh_retirement_type_RetirementCode" class="retirement_type_RetirementCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $retirement_type_list->RetirementCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($retirement_type_list->RetirementCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($retirement_type_list->RetirementCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($retirement_type_list->RetirementType->Visible) { // RetirementType ?>
	<?php if ($retirement_type_list->SortUrl($retirement_type_list->RetirementType) == "") { ?>
		<th data-name="RetirementType" class="<?php echo $retirement_type_list->RetirementType->headerCellClass() ?>"><div id="elh_retirement_type_RetirementType" class="retirement_type_RetirementType"><div class="ew-table-header-caption"><?php echo $retirement_type_list->RetirementType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetirementType" class="<?php echo $retirement_type_list->RetirementType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $retirement_type_list->SortUrl($retirement_type_list->RetirementType) ?>', 1);"><div id="elh_retirement_type_RetirementType" class="retirement_type_RetirementType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $retirement_type_list->RetirementType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($retirement_type_list->RetirementType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($retirement_type_list->RetirementType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($retirement_type_list->ExitCode->Visible) { // ExitCode ?>
	<?php if ($retirement_type_list->SortUrl($retirement_type_list->ExitCode) == "") { ?>
		<th data-name="ExitCode" class="<?php echo $retirement_type_list->ExitCode->headerCellClass() ?>"><div id="elh_retirement_type_ExitCode" class="retirement_type_ExitCode"><div class="ew-table-header-caption"><?php echo $retirement_type_list->ExitCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitCode" class="<?php echo $retirement_type_list->ExitCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $retirement_type_list->SortUrl($retirement_type_list->ExitCode) ?>', 1);"><div id="elh_retirement_type_ExitCode" class="retirement_type_ExitCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $retirement_type_list->ExitCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($retirement_type_list->ExitCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($retirement_type_list->ExitCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$retirement_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($retirement_type_list->ExportAll && $retirement_type_list->isExport()) {
	$retirement_type_list->StopRecord = $retirement_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($retirement_type_list->TotalRecords > $retirement_type_list->StartRecord + $retirement_type_list->DisplayRecords - 1)
		$retirement_type_list->StopRecord = $retirement_type_list->StartRecord + $retirement_type_list->DisplayRecords - 1;
	else
		$retirement_type_list->StopRecord = $retirement_type_list->TotalRecords;
}
$retirement_type_list->RecordCount = $retirement_type_list->StartRecord - 1;
if ($retirement_type_list->Recordset && !$retirement_type_list->Recordset->EOF) {
	$retirement_type_list->Recordset->moveFirst();
	$selectLimit = $retirement_type_list->UseSelectLimit;
	if (!$selectLimit && $retirement_type_list->StartRecord > 1)
		$retirement_type_list->Recordset->move($retirement_type_list->StartRecord - 1);
} elseif (!$retirement_type->AllowAddDeleteRow && $retirement_type_list->StopRecord == 0) {
	$retirement_type_list->StopRecord = $retirement_type->GridAddRowCount;
}

// Initialize aggregate
$retirement_type->RowType = ROWTYPE_AGGREGATEINIT;
$retirement_type->resetAttributes();
$retirement_type_list->renderRow();
while ($retirement_type_list->RecordCount < $retirement_type_list->StopRecord) {
	$retirement_type_list->RecordCount++;
	if ($retirement_type_list->RecordCount >= $retirement_type_list->StartRecord) {
		$retirement_type_list->RowCount++;

		// Set up key count
		$retirement_type_list->KeyCount = $retirement_type_list->RowIndex;

		// Init row class and style
		$retirement_type->resetAttributes();
		$retirement_type->CssClass = "";
		if ($retirement_type_list->isGridAdd()) {
		} else {
			$retirement_type_list->loadRowValues($retirement_type_list->Recordset); // Load row values
		}
		$retirement_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$retirement_type->RowAttrs->merge(["data-rowindex" => $retirement_type_list->RowCount, "id" => "r" . $retirement_type_list->RowCount . "_retirement_type", "data-rowtype" => $retirement_type->RowType]);

		// Render row
		$retirement_type_list->renderRow();

		// Render list options
		$retirement_type_list->renderListOptions();
?>
	<tr <?php echo $retirement_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$retirement_type_list->ListOptions->render("body", "left", $retirement_type_list->RowCount);
?>
	<?php if ($retirement_type_list->RetirementCode->Visible) { // RetirementCode ?>
		<td data-name="RetirementCode" <?php echo $retirement_type_list->RetirementCode->cellAttributes() ?>>
<span id="el<?php echo $retirement_type_list->RowCount ?>_retirement_type_RetirementCode">
<span<?php echo $retirement_type_list->RetirementCode->viewAttributes() ?>><?php echo $retirement_type_list->RetirementCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($retirement_type_list->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType" <?php echo $retirement_type_list->RetirementType->cellAttributes() ?>>
<span id="el<?php echo $retirement_type_list->RowCount ?>_retirement_type_RetirementType">
<span<?php echo $retirement_type_list->RetirementType->viewAttributes() ?>><?php echo $retirement_type_list->RetirementType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($retirement_type_list->ExitCode->Visible) { // ExitCode ?>
		<td data-name="ExitCode" <?php echo $retirement_type_list->ExitCode->cellAttributes() ?>>
<span id="el<?php echo $retirement_type_list->RowCount ?>_retirement_type_ExitCode">
<span<?php echo $retirement_type_list->ExitCode->viewAttributes() ?>><?php echo $retirement_type_list->ExitCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$retirement_type_list->ListOptions->render("body", "right", $retirement_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$retirement_type_list->isGridAdd())
		$retirement_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$retirement_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($retirement_type_list->Recordset)
	$retirement_type_list->Recordset->Close();
?>
<?php if (!$retirement_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$retirement_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $retirement_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $retirement_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($retirement_type_list->TotalRecords == 0 && !$retirement_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $retirement_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$retirement_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$retirement_type_list->isExport()) { ?>
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
$retirement_type_list->terminate();
?>