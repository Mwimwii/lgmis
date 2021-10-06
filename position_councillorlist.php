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
$position_councillor_list = new position_councillor_list();

// Run the page
$position_councillor_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$position_councillor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$position_councillor_list->isExport()) { ?>
<script>
var fposition_councillorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fposition_councillorlist = currentForm = new ew.Form("fposition_councillorlist", "list");
	fposition_councillorlist.formKeyCountName = '<?php echo $position_councillor_list->FormKeyCountName ?>';
	loadjs.done("fposition_councillorlist");
});
var fposition_councillorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fposition_councillorlistsrch = currentSearchForm = new ew.Form("fposition_councillorlistsrch");

	// Dynamic selection lists
	// Filters

	fposition_councillorlistsrch.filterList = <?php echo $position_councillor_list->getFilterList() ?>;

	// Init search panel as collapsed
	fposition_councillorlistsrch.initSearchPanel = true;
	loadjs.done("fposition_councillorlistsrch");
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
<?php if (!$position_councillor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($position_councillor_list->TotalRecords > 0 && $position_councillor_list->ExportOptions->visible()) { ?>
<?php $position_councillor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($position_councillor_list->ImportOptions->visible()) { ?>
<?php $position_councillor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($position_councillor_list->SearchOptions->visible()) { ?>
<?php $position_councillor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($position_councillor_list->FilterOptions->visible()) { ?>
<?php $position_councillor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$position_councillor_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$position_councillor_list->isExport() && !$position_councillor->CurrentAction) { ?>
<form name="fposition_councillorlistsrch" id="fposition_councillorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fposition_councillorlistsrch-search-panel" class="<?php echo $position_councillor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="position_councillor">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $position_councillor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($position_councillor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($position_councillor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $position_councillor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($position_councillor_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($position_councillor_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($position_councillor_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($position_councillor_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $position_councillor_list->showPageHeader(); ?>
<?php
$position_councillor_list->showMessage();
?>
<?php if ($position_councillor_list->TotalRecords > 0 || $position_councillor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($position_councillor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> position_councillor">
<?php if (!$position_councillor_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$position_councillor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_councillor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $position_councillor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fposition_councillorlist" id="fposition_councillorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="position_councillor">
<div id="gmp_position_councillor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($position_councillor_list->TotalRecords > 0 || $position_councillor_list->isGridEdit()) { ?>
<table id="tbl_position_councillorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$position_councillor->RowType = ROWTYPE_HEADER;

// Render list options
$position_councillor_list->renderListOptions();

// Render list options (header, left)
$position_councillor_list->ListOptions->render("header", "left");
?>
<?php if ($position_councillor_list->PositionCode->Visible) { // PositionCode ?>
	<?php if ($position_councillor_list->SortUrl($position_councillor_list->PositionCode) == "") { ?>
		<th data-name="PositionCode" class="<?php echo $position_councillor_list->PositionCode->headerCellClass() ?>"><div id="elh_position_councillor_PositionCode" class="position_councillor_PositionCode"><div class="ew-table-header-caption"><?php echo $position_councillor_list->PositionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionCode" class="<?php echo $position_councillor_list->PositionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_councillor_list->SortUrl($position_councillor_list->PositionCode) ?>', 1);"><div id="elh_position_councillor_PositionCode" class="position_councillor_PositionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_councillor_list->PositionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($position_councillor_list->PositionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_councillor_list->PositionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($position_councillor_list->PositionName->Visible) { // PositionName ?>
	<?php if ($position_councillor_list->SortUrl($position_councillor_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $position_councillor_list->PositionName->headerCellClass() ?>"><div id="elh_position_councillor_PositionName" class="position_councillor_PositionName"><div class="ew-table-header-caption"><?php echo $position_councillor_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $position_councillor_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $position_councillor_list->SortUrl($position_councillor_list->PositionName) ?>', 1);"><div id="elh_position_councillor_PositionName" class="position_councillor_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $position_councillor_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($position_councillor_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($position_councillor_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$position_councillor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($position_councillor_list->ExportAll && $position_councillor_list->isExport()) {
	$position_councillor_list->StopRecord = $position_councillor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($position_councillor_list->TotalRecords > $position_councillor_list->StartRecord + $position_councillor_list->DisplayRecords - 1)
		$position_councillor_list->StopRecord = $position_councillor_list->StartRecord + $position_councillor_list->DisplayRecords - 1;
	else
		$position_councillor_list->StopRecord = $position_councillor_list->TotalRecords;
}
$position_councillor_list->RecordCount = $position_councillor_list->StartRecord - 1;
if ($position_councillor_list->Recordset && !$position_councillor_list->Recordset->EOF) {
	$position_councillor_list->Recordset->moveFirst();
	$selectLimit = $position_councillor_list->UseSelectLimit;
	if (!$selectLimit && $position_councillor_list->StartRecord > 1)
		$position_councillor_list->Recordset->move($position_councillor_list->StartRecord - 1);
} elseif (!$position_councillor->AllowAddDeleteRow && $position_councillor_list->StopRecord == 0) {
	$position_councillor_list->StopRecord = $position_councillor->GridAddRowCount;
}

// Initialize aggregate
$position_councillor->RowType = ROWTYPE_AGGREGATEINIT;
$position_councillor->resetAttributes();
$position_councillor_list->renderRow();
while ($position_councillor_list->RecordCount < $position_councillor_list->StopRecord) {
	$position_councillor_list->RecordCount++;
	if ($position_councillor_list->RecordCount >= $position_councillor_list->StartRecord) {
		$position_councillor_list->RowCount++;

		// Set up key count
		$position_councillor_list->KeyCount = $position_councillor_list->RowIndex;

		// Init row class and style
		$position_councillor->resetAttributes();
		$position_councillor->CssClass = "";
		if ($position_councillor_list->isGridAdd()) {
		} else {
			$position_councillor_list->loadRowValues($position_councillor_list->Recordset); // Load row values
		}
		$position_councillor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$position_councillor->RowAttrs->merge(["data-rowindex" => $position_councillor_list->RowCount, "id" => "r" . $position_councillor_list->RowCount . "_position_councillor", "data-rowtype" => $position_councillor->RowType]);

		// Render row
		$position_councillor_list->renderRow();

		// Render list options
		$position_councillor_list->renderListOptions();
?>
	<tr <?php echo $position_councillor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$position_councillor_list->ListOptions->render("body", "left", $position_councillor_list->RowCount);
?>
	<?php if ($position_councillor_list->PositionCode->Visible) { // PositionCode ?>
		<td data-name="PositionCode" <?php echo $position_councillor_list->PositionCode->cellAttributes() ?>>
<span id="el<?php echo $position_councillor_list->RowCount ?>_position_councillor_PositionCode">
<span<?php echo $position_councillor_list->PositionCode->viewAttributes() ?>><?php echo $position_councillor_list->PositionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($position_councillor_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $position_councillor_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $position_councillor_list->RowCount ?>_position_councillor_PositionName">
<span<?php echo $position_councillor_list->PositionName->viewAttributes() ?>><?php echo $position_councillor_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$position_councillor_list->ListOptions->render("body", "right", $position_councillor_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$position_councillor_list->isGridAdd())
		$position_councillor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$position_councillor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($position_councillor_list->Recordset)
	$position_councillor_list->Recordset->Close();
?>
<?php if (!$position_councillor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$position_councillor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $position_councillor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $position_councillor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($position_councillor_list->TotalRecords == 0 && !$position_councillor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $position_councillor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$position_councillor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$position_councillor_list->isExport()) { ?>
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
$position_councillor_list->terminate();
?>