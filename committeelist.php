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
$committee_list = new committee_list();

// Run the page
$committee_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$committee_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$committee_list->isExport()) { ?>
<script>
var fcommitteelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcommitteelist = currentForm = new ew.Form("fcommitteelist", "list");
	fcommitteelist.formKeyCountName = '<?php echo $committee_list->FormKeyCountName ?>';
	loadjs.done("fcommitteelist");
});
var fcommitteelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcommitteelistsrch = currentSearchForm = new ew.Form("fcommitteelistsrch");

	// Dynamic selection lists
	// Filters

	fcommitteelistsrch.filterList = <?php echo $committee_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcommitteelistsrch.initSearchPanel = true;
	loadjs.done("fcommitteelistsrch");
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
<?php if (!$committee_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($committee_list->TotalRecords > 0 && $committee_list->ExportOptions->visible()) { ?>
<?php $committee_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($committee_list->ImportOptions->visible()) { ?>
<?php $committee_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($committee_list->SearchOptions->visible()) { ?>
<?php $committee_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($committee_list->FilterOptions->visible()) { ?>
<?php $committee_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$committee_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$committee_list->isExport() && !$committee->CurrentAction) { ?>
<form name="fcommitteelistsrch" id="fcommitteelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcommitteelistsrch-search-panel" class="<?php echo $committee_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="committee">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $committee_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($committee_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($committee_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $committee_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($committee_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($committee_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($committee_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($committee_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $committee_list->showPageHeader(); ?>
<?php
$committee_list->showMessage();
?>
<?php if ($committee_list->TotalRecords > 0 || $committee->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($committee_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> committee">
<?php if (!$committee_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$committee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $committee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcommitteelist" id="fcommitteelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="committee">
<div id="gmp_committee" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($committee_list->TotalRecords > 0 || $committee_list->isGridEdit()) { ?>
<table id="tbl_committeelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$committee->RowType = ROWTYPE_HEADER;

// Render list options
$committee_list->renderListOptions();

// Render list options (header, left)
$committee_list->ListOptions->render("header", "left");
?>
<?php if ($committee_list->CommitteCode->Visible) { // CommitteCode ?>
	<?php if ($committee_list->SortUrl($committee_list->CommitteCode) == "") { ?>
		<th data-name="CommitteCode" class="<?php echo $committee_list->CommitteCode->headerCellClass() ?>"><div id="elh_committee_CommitteCode" class="committee_CommitteCode"><div class="ew-table-header-caption"><?php echo $committee_list->CommitteCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteCode" class="<?php echo $committee_list->CommitteCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $committee_list->SortUrl($committee_list->CommitteCode) ?>', 1);"><div id="elh_committee_CommitteCode" class="committee_CommitteCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_list->CommitteCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($committee_list->CommitteCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_list->CommitteCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($committee_list->CommitteeName->Visible) { // CommitteeName ?>
	<?php if ($committee_list->SortUrl($committee_list->CommitteeName) == "") { ?>
		<th data-name="CommitteeName" class="<?php echo $committee_list->CommitteeName->headerCellClass() ?>"><div id="elh_committee_CommitteeName" class="committee_CommitteeName"><div class="ew-table-header-caption"><?php echo $committee_list->CommitteeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CommitteeName" class="<?php echo $committee_list->CommitteeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $committee_list->SortUrl($committee_list->CommitteeName) ?>', 1);"><div id="elh_committee_CommitteeName" class="committee_CommitteeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $committee_list->CommitteeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($committee_list->CommitteeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($committee_list->CommitteeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$committee_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($committee_list->ExportAll && $committee_list->isExport()) {
	$committee_list->StopRecord = $committee_list->TotalRecords;
} else {

	// Set the last record to display
	if ($committee_list->TotalRecords > $committee_list->StartRecord + $committee_list->DisplayRecords - 1)
		$committee_list->StopRecord = $committee_list->StartRecord + $committee_list->DisplayRecords - 1;
	else
		$committee_list->StopRecord = $committee_list->TotalRecords;
}
$committee_list->RecordCount = $committee_list->StartRecord - 1;
if ($committee_list->Recordset && !$committee_list->Recordset->EOF) {
	$committee_list->Recordset->moveFirst();
	$selectLimit = $committee_list->UseSelectLimit;
	if (!$selectLimit && $committee_list->StartRecord > 1)
		$committee_list->Recordset->move($committee_list->StartRecord - 1);
} elseif (!$committee->AllowAddDeleteRow && $committee_list->StopRecord == 0) {
	$committee_list->StopRecord = $committee->GridAddRowCount;
}

// Initialize aggregate
$committee->RowType = ROWTYPE_AGGREGATEINIT;
$committee->resetAttributes();
$committee_list->renderRow();
while ($committee_list->RecordCount < $committee_list->StopRecord) {
	$committee_list->RecordCount++;
	if ($committee_list->RecordCount >= $committee_list->StartRecord) {
		$committee_list->RowCount++;

		// Set up key count
		$committee_list->KeyCount = $committee_list->RowIndex;

		// Init row class and style
		$committee->resetAttributes();
		$committee->CssClass = "";
		if ($committee_list->isGridAdd()) {
		} else {
			$committee_list->loadRowValues($committee_list->Recordset); // Load row values
		}
		$committee->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$committee->RowAttrs->merge(["data-rowindex" => $committee_list->RowCount, "id" => "r" . $committee_list->RowCount . "_committee", "data-rowtype" => $committee->RowType]);

		// Render row
		$committee_list->renderRow();

		// Render list options
		$committee_list->renderListOptions();
?>
	<tr <?php echo $committee->rowAttributes() ?>>
<?php

// Render list options (body, left)
$committee_list->ListOptions->render("body", "left", $committee_list->RowCount);
?>
	<?php if ($committee_list->CommitteCode->Visible) { // CommitteCode ?>
		<td data-name="CommitteCode" <?php echo $committee_list->CommitteCode->cellAttributes() ?>>
<span id="el<?php echo $committee_list->RowCount ?>_committee_CommitteCode">
<span<?php echo $committee_list->CommitteCode->viewAttributes() ?>><?php echo $committee_list->CommitteCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($committee_list->CommitteeName->Visible) { // CommitteeName ?>
		<td data-name="CommitteeName" <?php echo $committee_list->CommitteeName->cellAttributes() ?>>
<span id="el<?php echo $committee_list->RowCount ?>_committee_CommitteeName">
<span<?php echo $committee_list->CommitteeName->viewAttributes() ?>><?php echo $committee_list->CommitteeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$committee_list->ListOptions->render("body", "right", $committee_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$committee_list->isGridAdd())
		$committee_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$committee->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($committee_list->Recordset)
	$committee_list->Recordset->Close();
?>
<?php if (!$committee_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$committee_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $committee_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $committee_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($committee_list->TotalRecords == 0 && !$committee->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $committee_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$committee_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$committee_list->isExport()) { ?>
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
$committee_list->terminate();
?>