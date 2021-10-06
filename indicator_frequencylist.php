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
$indicator_frequency_list = new indicator_frequency_list();

// Run the page
$indicator_frequency_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_frequency_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$indicator_frequency_list->isExport()) { ?>
<script>
var findicator_frequencylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	findicator_frequencylist = currentForm = new ew.Form("findicator_frequencylist", "list");
	findicator_frequencylist.formKeyCountName = '<?php echo $indicator_frequency_list->FormKeyCountName ?>';
	loadjs.done("findicator_frequencylist");
});
var findicator_frequencylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	findicator_frequencylistsrch = currentSearchForm = new ew.Form("findicator_frequencylistsrch");

	// Dynamic selection lists
	// Filters

	findicator_frequencylistsrch.filterList = <?php echo $indicator_frequency_list->getFilterList() ?>;

	// Init search panel as collapsed
	findicator_frequencylistsrch.initSearchPanel = true;
	loadjs.done("findicator_frequencylistsrch");
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
<?php if (!$indicator_frequency_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($indicator_frequency_list->TotalRecords > 0 && $indicator_frequency_list->ExportOptions->visible()) { ?>
<?php $indicator_frequency_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_frequency_list->ImportOptions->visible()) { ?>
<?php $indicator_frequency_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_frequency_list->SearchOptions->visible()) { ?>
<?php $indicator_frequency_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_frequency_list->FilterOptions->visible()) { ?>
<?php $indicator_frequency_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$indicator_frequency_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$indicator_frequency_list->isExport() && !$indicator_frequency->CurrentAction) { ?>
<form name="findicator_frequencylistsrch" id="findicator_frequencylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="findicator_frequencylistsrch-search-panel" class="<?php echo $indicator_frequency_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="indicator_frequency">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $indicator_frequency_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($indicator_frequency_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($indicator_frequency_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $indicator_frequency_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($indicator_frequency_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($indicator_frequency_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($indicator_frequency_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($indicator_frequency_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $indicator_frequency_list->showPageHeader(); ?>
<?php
$indicator_frequency_list->showMessage();
?>
<?php if ($indicator_frequency_list->TotalRecords > 0 || $indicator_frequency->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($indicator_frequency_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> indicator_frequency">
<?php if (!$indicator_frequency_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$indicator_frequency_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_frequency_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_frequency_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="findicator_frequencylist" id="findicator_frequencylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_frequency">
<div id="gmp_indicator_frequency" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($indicator_frequency_list->TotalRecords > 0 || $indicator_frequency_list->isGridEdit()) { ?>
<table id="tbl_indicator_frequencylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$indicator_frequency->RowType = ROWTYPE_HEADER;

// Render list options
$indicator_frequency_list->renderListOptions();

// Render list options (header, left)
$indicator_frequency_list->ListOptions->render("header", "left");
?>
<?php if ($indicator_frequency_list->indicator_frequency->Visible) { // indicator_frequency ?>
	<?php if ($indicator_frequency_list->SortUrl($indicator_frequency_list->indicator_frequency) == "") { ?>
		<th data-name="indicator_frequency" class="<?php echo $indicator_frequency_list->indicator_frequency->headerCellClass() ?>"><div id="elh_indicator_frequency_indicator_frequency" class="indicator_frequency_indicator_frequency"><div class="ew-table-header-caption"><?php echo $indicator_frequency_list->indicator_frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_frequency" class="<?php echo $indicator_frequency_list->indicator_frequency->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_frequency_list->SortUrl($indicator_frequency_list->indicator_frequency) ?>', 1);"><div id="elh_indicator_frequency_indicator_frequency" class="indicator_frequency_indicator_frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_frequency_list->indicator_frequency->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_frequency_list->indicator_frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_frequency_list->indicator_frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_frequency_list->frequency_desc->Visible) { // frequency_desc ?>
	<?php if ($indicator_frequency_list->SortUrl($indicator_frequency_list->frequency_desc) == "") { ?>
		<th data-name="frequency_desc" class="<?php echo $indicator_frequency_list->frequency_desc->headerCellClass() ?>"><div id="elh_indicator_frequency_frequency_desc" class="indicator_frequency_frequency_desc"><div class="ew-table-header-caption"><?php echo $indicator_frequency_list->frequency_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="frequency_desc" class="<?php echo $indicator_frequency_list->frequency_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_frequency_list->SortUrl($indicator_frequency_list->frequency_desc) ?>', 1);"><div id="elh_indicator_frequency_frequency_desc" class="indicator_frequency_frequency_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_frequency_list->frequency_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_frequency_list->frequency_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_frequency_list->frequency_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$indicator_frequency_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($indicator_frequency_list->ExportAll && $indicator_frequency_list->isExport()) {
	$indicator_frequency_list->StopRecord = $indicator_frequency_list->TotalRecords;
} else {

	// Set the last record to display
	if ($indicator_frequency_list->TotalRecords > $indicator_frequency_list->StartRecord + $indicator_frequency_list->DisplayRecords - 1)
		$indicator_frequency_list->StopRecord = $indicator_frequency_list->StartRecord + $indicator_frequency_list->DisplayRecords - 1;
	else
		$indicator_frequency_list->StopRecord = $indicator_frequency_list->TotalRecords;
}
$indicator_frequency_list->RecordCount = $indicator_frequency_list->StartRecord - 1;
if ($indicator_frequency_list->Recordset && !$indicator_frequency_list->Recordset->EOF) {
	$indicator_frequency_list->Recordset->moveFirst();
	$selectLimit = $indicator_frequency_list->UseSelectLimit;
	if (!$selectLimit && $indicator_frequency_list->StartRecord > 1)
		$indicator_frequency_list->Recordset->move($indicator_frequency_list->StartRecord - 1);
} elseif (!$indicator_frequency->AllowAddDeleteRow && $indicator_frequency_list->StopRecord == 0) {
	$indicator_frequency_list->StopRecord = $indicator_frequency->GridAddRowCount;
}

// Initialize aggregate
$indicator_frequency->RowType = ROWTYPE_AGGREGATEINIT;
$indicator_frequency->resetAttributes();
$indicator_frequency_list->renderRow();
while ($indicator_frequency_list->RecordCount < $indicator_frequency_list->StopRecord) {
	$indicator_frequency_list->RecordCount++;
	if ($indicator_frequency_list->RecordCount >= $indicator_frequency_list->StartRecord) {
		$indicator_frequency_list->RowCount++;

		// Set up key count
		$indicator_frequency_list->KeyCount = $indicator_frequency_list->RowIndex;

		// Init row class and style
		$indicator_frequency->resetAttributes();
		$indicator_frequency->CssClass = "";
		if ($indicator_frequency_list->isGridAdd()) {
		} else {
			$indicator_frequency_list->loadRowValues($indicator_frequency_list->Recordset); // Load row values
		}
		$indicator_frequency->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$indicator_frequency->RowAttrs->merge(["data-rowindex" => $indicator_frequency_list->RowCount, "id" => "r" . $indicator_frequency_list->RowCount . "_indicator_frequency", "data-rowtype" => $indicator_frequency->RowType]);

		// Render row
		$indicator_frequency_list->renderRow();

		// Render list options
		$indicator_frequency_list->renderListOptions();
?>
	<tr <?php echo $indicator_frequency->rowAttributes() ?>>
<?php

// Render list options (body, left)
$indicator_frequency_list->ListOptions->render("body", "left", $indicator_frequency_list->RowCount);
?>
	<?php if ($indicator_frequency_list->indicator_frequency->Visible) { // indicator_frequency ?>
		<td data-name="indicator_frequency" <?php echo $indicator_frequency_list->indicator_frequency->cellAttributes() ?>>
<span id="el<?php echo $indicator_frequency_list->RowCount ?>_indicator_frequency_indicator_frequency">
<span<?php echo $indicator_frequency_list->indicator_frequency->viewAttributes() ?>><?php echo $indicator_frequency_list->indicator_frequency->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_frequency_list->frequency_desc->Visible) { // frequency_desc ?>
		<td data-name="frequency_desc" <?php echo $indicator_frequency_list->frequency_desc->cellAttributes() ?>>
<span id="el<?php echo $indicator_frequency_list->RowCount ?>_indicator_frequency_frequency_desc">
<span<?php echo $indicator_frequency_list->frequency_desc->viewAttributes() ?>><?php echo $indicator_frequency_list->frequency_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$indicator_frequency_list->ListOptions->render("body", "right", $indicator_frequency_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$indicator_frequency_list->isGridAdd())
		$indicator_frequency_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$indicator_frequency->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($indicator_frequency_list->Recordset)
	$indicator_frequency_list->Recordset->Close();
?>
<?php if (!$indicator_frequency_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$indicator_frequency_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_frequency_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_frequency_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($indicator_frequency_list->TotalRecords == 0 && !$indicator_frequency->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $indicator_frequency_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$indicator_frequency_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$indicator_frequency_list->isExport()) { ?>
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
$indicator_frequency_list->terminate();
?>