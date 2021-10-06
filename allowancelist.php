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
$allowance_list = new allowance_list();

// Run the page
$allowance_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$allowance_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$allowance_list->isExport()) { ?>
<script>
var fallowancelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fallowancelist = currentForm = new ew.Form("fallowancelist", "list");
	fallowancelist.formKeyCountName = '<?php echo $allowance_list->FormKeyCountName ?>';
	loadjs.done("fallowancelist");
});
var fallowancelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fallowancelistsrch = currentSearchForm = new ew.Form("fallowancelistsrch");

	// Dynamic selection lists
	// Filters

	fallowancelistsrch.filterList = <?php echo $allowance_list->getFilterList() ?>;

	// Init search panel as collapsed
	fallowancelistsrch.initSearchPanel = true;
	loadjs.done("fallowancelistsrch");
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
<?php if (!$allowance_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($allowance_list->TotalRecords > 0 && $allowance_list->ExportOptions->visible()) { ?>
<?php $allowance_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($allowance_list->ImportOptions->visible()) { ?>
<?php $allowance_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($allowance_list->SearchOptions->visible()) { ?>
<?php $allowance_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($allowance_list->FilterOptions->visible()) { ?>
<?php $allowance_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$allowance_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$allowance_list->isExport() && !$allowance->CurrentAction) { ?>
<form name="fallowancelistsrch" id="fallowancelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fallowancelistsrch-search-panel" class="<?php echo $allowance_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="allowance">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $allowance_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($allowance_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($allowance_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $allowance_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($allowance_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($allowance_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($allowance_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($allowance_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $allowance_list->showPageHeader(); ?>
<?php
$allowance_list->showMessage();
?>
<?php if ($allowance_list->TotalRecords > 0 || $allowance->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($allowance_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> allowance">
<?php if (!$allowance_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$allowance_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $allowance_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $allowance_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fallowancelist" id="fallowancelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="allowance">
<div id="gmp_allowance" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($allowance_list->TotalRecords > 0 || $allowance_list->isGridEdit()) { ?>
<table id="tbl_allowancelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$allowance->RowType = ROWTYPE_HEADER;

// Render list options
$allowance_list->renderListOptions();

// Render list options (header, left)
$allowance_list->ListOptions->render("header", "left");
?>
<?php if ($allowance_list->AllowanceCode->Visible) { // AllowanceCode ?>
	<?php if ($allowance_list->SortUrl($allowance_list->AllowanceCode) == "") { ?>
		<th data-name="AllowanceCode" class="<?php echo $allowance_list->AllowanceCode->headerCellClass() ?>"><div id="elh_allowance_AllowanceCode" class="allowance_AllowanceCode"><div class="ew-table-header-caption"><?php echo $allowance_list->AllowanceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceCode" class="<?php echo $allowance_list->AllowanceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $allowance_list->SortUrl($allowance_list->AllowanceCode) ?>', 1);"><div id="elh_allowance_AllowanceCode" class="allowance_AllowanceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $allowance_list->AllowanceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($allowance_list->AllowanceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($allowance_list->AllowanceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($allowance_list->AllowanceName->Visible) { // AllowanceName ?>
	<?php if ($allowance_list->SortUrl($allowance_list->AllowanceName) == "") { ?>
		<th data-name="AllowanceName" class="<?php echo $allowance_list->AllowanceName->headerCellClass() ?>"><div id="elh_allowance_AllowanceName" class="allowance_AllowanceName"><div class="ew-table-header-caption"><?php echo $allowance_list->AllowanceName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceName" class="<?php echo $allowance_list->AllowanceName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $allowance_list->SortUrl($allowance_list->AllowanceName) ?>', 1);"><div id="elh_allowance_AllowanceName" class="allowance_AllowanceName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $allowance_list->AllowanceName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($allowance_list->AllowanceName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($allowance_list->AllowanceName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($allowance_list->AllowanceAmount->Visible) { // AllowanceAmount ?>
	<?php if ($allowance_list->SortUrl($allowance_list->AllowanceAmount) == "") { ?>
		<th data-name="AllowanceAmount" class="<?php echo $allowance_list->AllowanceAmount->headerCellClass() ?>"><div id="elh_allowance_AllowanceAmount" class="allowance_AllowanceAmount"><div class="ew-table-header-caption"><?php echo $allowance_list->AllowanceAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllowanceAmount" class="<?php echo $allowance_list->AllowanceAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $allowance_list->SortUrl($allowance_list->AllowanceAmount) ?>', 1);"><div id="elh_allowance_AllowanceAmount" class="allowance_AllowanceAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $allowance_list->AllowanceAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($allowance_list->AllowanceAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($allowance_list->AllowanceAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$allowance_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($allowance_list->ExportAll && $allowance_list->isExport()) {
	$allowance_list->StopRecord = $allowance_list->TotalRecords;
} else {

	// Set the last record to display
	if ($allowance_list->TotalRecords > $allowance_list->StartRecord + $allowance_list->DisplayRecords - 1)
		$allowance_list->StopRecord = $allowance_list->StartRecord + $allowance_list->DisplayRecords - 1;
	else
		$allowance_list->StopRecord = $allowance_list->TotalRecords;
}
$allowance_list->RecordCount = $allowance_list->StartRecord - 1;
if ($allowance_list->Recordset && !$allowance_list->Recordset->EOF) {
	$allowance_list->Recordset->moveFirst();
	$selectLimit = $allowance_list->UseSelectLimit;
	if (!$selectLimit && $allowance_list->StartRecord > 1)
		$allowance_list->Recordset->move($allowance_list->StartRecord - 1);
} elseif (!$allowance->AllowAddDeleteRow && $allowance_list->StopRecord == 0) {
	$allowance_list->StopRecord = $allowance->GridAddRowCount;
}

// Initialize aggregate
$allowance->RowType = ROWTYPE_AGGREGATEINIT;
$allowance->resetAttributes();
$allowance_list->renderRow();
while ($allowance_list->RecordCount < $allowance_list->StopRecord) {
	$allowance_list->RecordCount++;
	if ($allowance_list->RecordCount >= $allowance_list->StartRecord) {
		$allowance_list->RowCount++;

		// Set up key count
		$allowance_list->KeyCount = $allowance_list->RowIndex;

		// Init row class and style
		$allowance->resetAttributes();
		$allowance->CssClass = "";
		if ($allowance_list->isGridAdd()) {
		} else {
			$allowance_list->loadRowValues($allowance_list->Recordset); // Load row values
		}
		$allowance->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$allowance->RowAttrs->merge(["data-rowindex" => $allowance_list->RowCount, "id" => "r" . $allowance_list->RowCount . "_allowance", "data-rowtype" => $allowance->RowType]);

		// Render row
		$allowance_list->renderRow();

		// Render list options
		$allowance_list->renderListOptions();
?>
	<tr <?php echo $allowance->rowAttributes() ?>>
<?php

// Render list options (body, left)
$allowance_list->ListOptions->render("body", "left", $allowance_list->RowCount);
?>
	<?php if ($allowance_list->AllowanceCode->Visible) { // AllowanceCode ?>
		<td data-name="AllowanceCode" <?php echo $allowance_list->AllowanceCode->cellAttributes() ?>>
<span id="el<?php echo $allowance_list->RowCount ?>_allowance_AllowanceCode">
<span<?php echo $allowance_list->AllowanceCode->viewAttributes() ?>><?php echo $allowance_list->AllowanceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($allowance_list->AllowanceName->Visible) { // AllowanceName ?>
		<td data-name="AllowanceName" <?php echo $allowance_list->AllowanceName->cellAttributes() ?>>
<span id="el<?php echo $allowance_list->RowCount ?>_allowance_AllowanceName">
<span<?php echo $allowance_list->AllowanceName->viewAttributes() ?>><?php echo $allowance_list->AllowanceName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($allowance_list->AllowanceAmount->Visible) { // AllowanceAmount ?>
		<td data-name="AllowanceAmount" <?php echo $allowance_list->AllowanceAmount->cellAttributes() ?>>
<span id="el<?php echo $allowance_list->RowCount ?>_allowance_AllowanceAmount">
<span<?php echo $allowance_list->AllowanceAmount->viewAttributes() ?>><?php echo $allowance_list->AllowanceAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$allowance_list->ListOptions->render("body", "right", $allowance_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$allowance_list->isGridAdd())
		$allowance_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$allowance->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($allowance_list->Recordset)
	$allowance_list->Recordset->Close();
?>
<?php if (!$allowance_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$allowance_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $allowance_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $allowance_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($allowance_list->TotalRecords == 0 && !$allowance->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $allowance_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$allowance_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$allowance_list->isExport()) { ?>
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
$allowance_list->terminate();
?>