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
$occupation_list = new occupation_list();

// Run the page
$occupation_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$occupation_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$occupation_list->isExport()) { ?>
<script>
var foccupationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foccupationlist = currentForm = new ew.Form("foccupationlist", "list");
	foccupationlist.formKeyCountName = '<?php echo $occupation_list->FormKeyCountName ?>';
	loadjs.done("foccupationlist");
});
var foccupationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foccupationlistsrch = currentSearchForm = new ew.Form("foccupationlistsrch");

	// Dynamic selection lists
	// Filters

	foccupationlistsrch.filterList = <?php echo $occupation_list->getFilterList() ?>;

	// Init search panel as collapsed
	foccupationlistsrch.initSearchPanel = true;
	loadjs.done("foccupationlistsrch");
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
<?php if (!$occupation_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($occupation_list->TotalRecords > 0 && $occupation_list->ExportOptions->visible()) { ?>
<?php $occupation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($occupation_list->ImportOptions->visible()) { ?>
<?php $occupation_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($occupation_list->SearchOptions->visible()) { ?>
<?php $occupation_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($occupation_list->FilterOptions->visible()) { ?>
<?php $occupation_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$occupation_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$occupation_list->isExport() && !$occupation->CurrentAction) { ?>
<form name="foccupationlistsrch" id="foccupationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foccupationlistsrch-search-panel" class="<?php echo $occupation_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="occupation">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $occupation_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($occupation_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($occupation_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $occupation_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($occupation_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($occupation_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($occupation_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($occupation_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $occupation_list->showPageHeader(); ?>
<?php
$occupation_list->showMessage();
?>
<?php if ($occupation_list->TotalRecords > 0 || $occupation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($occupation_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> occupation">
<?php if (!$occupation_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$occupation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $occupation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $occupation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foccupationlist" id="foccupationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="occupation">
<div id="gmp_occupation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($occupation_list->TotalRecords > 0 || $occupation_list->isGridEdit()) { ?>
<table id="tbl_occupationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$occupation->RowType = ROWTYPE_HEADER;

// Render list options
$occupation_list->renderListOptions();

// Render list options (header, left)
$occupation_list->ListOptions->render("header", "left");
?>
<?php if ($occupation_list->OccupationCode->Visible) { // OccupationCode ?>
	<?php if ($occupation_list->SortUrl($occupation_list->OccupationCode) == "") { ?>
		<th data-name="OccupationCode" class="<?php echo $occupation_list->OccupationCode->headerCellClass() ?>"><div id="elh_occupation_OccupationCode" class="occupation_OccupationCode"><div class="ew-table-header-caption"><?php echo $occupation_list->OccupationCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OccupationCode" class="<?php echo $occupation_list->OccupationCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $occupation_list->SortUrl($occupation_list->OccupationCode) ?>', 1);"><div id="elh_occupation_OccupationCode" class="occupation_OccupationCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $occupation_list->OccupationCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($occupation_list->OccupationCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($occupation_list->OccupationCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($occupation_list->OccupationName->Visible) { // OccupationName ?>
	<?php if ($occupation_list->SortUrl($occupation_list->OccupationName) == "") { ?>
		<th data-name="OccupationName" class="<?php echo $occupation_list->OccupationName->headerCellClass() ?>"><div id="elh_occupation_OccupationName" class="occupation_OccupationName"><div class="ew-table-header-caption"><?php echo $occupation_list->OccupationName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OccupationName" class="<?php echo $occupation_list->OccupationName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $occupation_list->SortUrl($occupation_list->OccupationName) ?>', 1);"><div id="elh_occupation_OccupationName" class="occupation_OccupationName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $occupation_list->OccupationName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($occupation_list->OccupationName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($occupation_list->OccupationName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$occupation_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($occupation_list->ExportAll && $occupation_list->isExport()) {
	$occupation_list->StopRecord = $occupation_list->TotalRecords;
} else {

	// Set the last record to display
	if ($occupation_list->TotalRecords > $occupation_list->StartRecord + $occupation_list->DisplayRecords - 1)
		$occupation_list->StopRecord = $occupation_list->StartRecord + $occupation_list->DisplayRecords - 1;
	else
		$occupation_list->StopRecord = $occupation_list->TotalRecords;
}
$occupation_list->RecordCount = $occupation_list->StartRecord - 1;
if ($occupation_list->Recordset && !$occupation_list->Recordset->EOF) {
	$occupation_list->Recordset->moveFirst();
	$selectLimit = $occupation_list->UseSelectLimit;
	if (!$selectLimit && $occupation_list->StartRecord > 1)
		$occupation_list->Recordset->move($occupation_list->StartRecord - 1);
} elseif (!$occupation->AllowAddDeleteRow && $occupation_list->StopRecord == 0) {
	$occupation_list->StopRecord = $occupation->GridAddRowCount;
}

// Initialize aggregate
$occupation->RowType = ROWTYPE_AGGREGATEINIT;
$occupation->resetAttributes();
$occupation_list->renderRow();
while ($occupation_list->RecordCount < $occupation_list->StopRecord) {
	$occupation_list->RecordCount++;
	if ($occupation_list->RecordCount >= $occupation_list->StartRecord) {
		$occupation_list->RowCount++;

		// Set up key count
		$occupation_list->KeyCount = $occupation_list->RowIndex;

		// Init row class and style
		$occupation->resetAttributes();
		$occupation->CssClass = "";
		if ($occupation_list->isGridAdd()) {
		} else {
			$occupation_list->loadRowValues($occupation_list->Recordset); // Load row values
		}
		$occupation->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$occupation->RowAttrs->merge(["data-rowindex" => $occupation_list->RowCount, "id" => "r" . $occupation_list->RowCount . "_occupation", "data-rowtype" => $occupation->RowType]);

		// Render row
		$occupation_list->renderRow();

		// Render list options
		$occupation_list->renderListOptions();
?>
	<tr <?php echo $occupation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$occupation_list->ListOptions->render("body", "left", $occupation_list->RowCount);
?>
	<?php if ($occupation_list->OccupationCode->Visible) { // OccupationCode ?>
		<td data-name="OccupationCode" <?php echo $occupation_list->OccupationCode->cellAttributes() ?>>
<span id="el<?php echo $occupation_list->RowCount ?>_occupation_OccupationCode">
<span<?php echo $occupation_list->OccupationCode->viewAttributes() ?>><?php echo $occupation_list->OccupationCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($occupation_list->OccupationName->Visible) { // OccupationName ?>
		<td data-name="OccupationName" <?php echo $occupation_list->OccupationName->cellAttributes() ?>>
<span id="el<?php echo $occupation_list->RowCount ?>_occupation_OccupationName">
<span<?php echo $occupation_list->OccupationName->viewAttributes() ?>><?php echo $occupation_list->OccupationName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$occupation_list->ListOptions->render("body", "right", $occupation_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$occupation_list->isGridAdd())
		$occupation_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$occupation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($occupation_list->Recordset)
	$occupation_list->Recordset->Close();
?>
<?php if (!$occupation_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$occupation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $occupation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $occupation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($occupation_list->TotalRecords == 0 && !$occupation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $occupation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$occupation_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$occupation_list->isExport()) { ?>
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
$occupation_list->terminate();
?>