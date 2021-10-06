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
$funding_source_training_list = new funding_source_training_list();

// Run the page
$funding_source_training_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$funding_source_training_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$funding_source_training_list->isExport()) { ?>
<script>
var ffunding_source_traininglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ffunding_source_traininglist = currentForm = new ew.Form("ffunding_source_traininglist", "list");
	ffunding_source_traininglist.formKeyCountName = '<?php echo $funding_source_training_list->FormKeyCountName ?>';
	loadjs.done("ffunding_source_traininglist");
});
var ffunding_source_traininglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ffunding_source_traininglistsrch = currentSearchForm = new ew.Form("ffunding_source_traininglistsrch");

	// Dynamic selection lists
	// Filters

	ffunding_source_traininglistsrch.filterList = <?php echo $funding_source_training_list->getFilterList() ?>;

	// Init search panel as collapsed
	ffunding_source_traininglistsrch.initSearchPanel = true;
	loadjs.done("ffunding_source_traininglistsrch");
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
<?php if (!$funding_source_training_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($funding_source_training_list->TotalRecords > 0 && $funding_source_training_list->ExportOptions->visible()) { ?>
<?php $funding_source_training_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($funding_source_training_list->ImportOptions->visible()) { ?>
<?php $funding_source_training_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($funding_source_training_list->SearchOptions->visible()) { ?>
<?php $funding_source_training_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($funding_source_training_list->FilterOptions->visible()) { ?>
<?php $funding_source_training_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$funding_source_training_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$funding_source_training_list->isExport() && !$funding_source_training->CurrentAction) { ?>
<form name="ffunding_source_traininglistsrch" id="ffunding_source_traininglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ffunding_source_traininglistsrch-search-panel" class="<?php echo $funding_source_training_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="funding_source_training">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $funding_source_training_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($funding_source_training_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($funding_source_training_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $funding_source_training_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($funding_source_training_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($funding_source_training_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($funding_source_training_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($funding_source_training_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $funding_source_training_list->showPageHeader(); ?>
<?php
$funding_source_training_list->showMessage();
?>
<?php if ($funding_source_training_list->TotalRecords > 0 || $funding_source_training->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($funding_source_training_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> funding_source_training">
<?php if (!$funding_source_training_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$funding_source_training_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $funding_source_training_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $funding_source_training_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ffunding_source_traininglist" id="ffunding_source_traininglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="funding_source_training">
<div id="gmp_funding_source_training" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($funding_source_training_list->TotalRecords > 0 || $funding_source_training_list->isGridEdit()) { ?>
<table id="tbl_funding_source_traininglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$funding_source_training->RowType = ROWTYPE_HEADER;

// Render list options
$funding_source_training_list->renderListOptions();

// Render list options (header, left)
$funding_source_training_list->ListOptions->render("header", "left");
?>
<?php if ($funding_source_training_list->FundingSource->Visible) { // FundingSource ?>
	<?php if ($funding_source_training_list->SortUrl($funding_source_training_list->FundingSource) == "") { ?>
		<th data-name="FundingSource" class="<?php echo $funding_source_training_list->FundingSource->headerCellClass() ?>"><div id="elh_funding_source_training_FundingSource" class="funding_source_training_FundingSource"><div class="ew-table-header-caption"><?php echo $funding_source_training_list->FundingSource->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FundingSource" class="<?php echo $funding_source_training_list->FundingSource->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $funding_source_training_list->SortUrl($funding_source_training_list->FundingSource) ?>', 1);"><div id="elh_funding_source_training_FundingSource" class="funding_source_training_FundingSource">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $funding_source_training_list->FundingSource->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($funding_source_training_list->FundingSource->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($funding_source_training_list->FundingSource->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$funding_source_training_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($funding_source_training_list->ExportAll && $funding_source_training_list->isExport()) {
	$funding_source_training_list->StopRecord = $funding_source_training_list->TotalRecords;
} else {

	// Set the last record to display
	if ($funding_source_training_list->TotalRecords > $funding_source_training_list->StartRecord + $funding_source_training_list->DisplayRecords - 1)
		$funding_source_training_list->StopRecord = $funding_source_training_list->StartRecord + $funding_source_training_list->DisplayRecords - 1;
	else
		$funding_source_training_list->StopRecord = $funding_source_training_list->TotalRecords;
}
$funding_source_training_list->RecordCount = $funding_source_training_list->StartRecord - 1;
if ($funding_source_training_list->Recordset && !$funding_source_training_list->Recordset->EOF) {
	$funding_source_training_list->Recordset->moveFirst();
	$selectLimit = $funding_source_training_list->UseSelectLimit;
	if (!$selectLimit && $funding_source_training_list->StartRecord > 1)
		$funding_source_training_list->Recordset->move($funding_source_training_list->StartRecord - 1);
} elseif (!$funding_source_training->AllowAddDeleteRow && $funding_source_training_list->StopRecord == 0) {
	$funding_source_training_list->StopRecord = $funding_source_training->GridAddRowCount;
}

// Initialize aggregate
$funding_source_training->RowType = ROWTYPE_AGGREGATEINIT;
$funding_source_training->resetAttributes();
$funding_source_training_list->renderRow();
while ($funding_source_training_list->RecordCount < $funding_source_training_list->StopRecord) {
	$funding_source_training_list->RecordCount++;
	if ($funding_source_training_list->RecordCount >= $funding_source_training_list->StartRecord) {
		$funding_source_training_list->RowCount++;

		// Set up key count
		$funding_source_training_list->KeyCount = $funding_source_training_list->RowIndex;

		// Init row class and style
		$funding_source_training->resetAttributes();
		$funding_source_training->CssClass = "";
		if ($funding_source_training_list->isGridAdd()) {
		} else {
			$funding_source_training_list->loadRowValues($funding_source_training_list->Recordset); // Load row values
		}
		$funding_source_training->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$funding_source_training->RowAttrs->merge(["data-rowindex" => $funding_source_training_list->RowCount, "id" => "r" . $funding_source_training_list->RowCount . "_funding_source_training", "data-rowtype" => $funding_source_training->RowType]);

		// Render row
		$funding_source_training_list->renderRow();

		// Render list options
		$funding_source_training_list->renderListOptions();
?>
	<tr <?php echo $funding_source_training->rowAttributes() ?>>
<?php

// Render list options (body, left)
$funding_source_training_list->ListOptions->render("body", "left", $funding_source_training_list->RowCount);
?>
	<?php if ($funding_source_training_list->FundingSource->Visible) { // FundingSource ?>
		<td data-name="FundingSource" <?php echo $funding_source_training_list->FundingSource->cellAttributes() ?>>
<span id="el<?php echo $funding_source_training_list->RowCount ?>_funding_source_training_FundingSource">
<span<?php echo $funding_source_training_list->FundingSource->viewAttributes() ?>><?php echo $funding_source_training_list->FundingSource->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$funding_source_training_list->ListOptions->render("body", "right", $funding_source_training_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$funding_source_training_list->isGridAdd())
		$funding_source_training_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$funding_source_training->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($funding_source_training_list->Recordset)
	$funding_source_training_list->Recordset->Close();
?>
<?php if (!$funding_source_training_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$funding_source_training_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $funding_source_training_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $funding_source_training_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($funding_source_training_list->TotalRecords == 0 && !$funding_source_training->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $funding_source_training_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$funding_source_training_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$funding_source_training_list->isExport()) { ?>
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
$funding_source_training_list->terminate();
?>