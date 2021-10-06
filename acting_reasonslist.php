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
$acting_reasons_list = new acting_reasons_list();

// Run the page
$acting_reasons_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_reasons_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acting_reasons_list->isExport()) { ?>
<script>
var facting_reasonslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facting_reasonslist = currentForm = new ew.Form("facting_reasonslist", "list");
	facting_reasonslist.formKeyCountName = '<?php echo $acting_reasons_list->FormKeyCountName ?>';
	loadjs.done("facting_reasonslist");
});
var facting_reasonslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	facting_reasonslistsrch = currentSearchForm = new ew.Form("facting_reasonslistsrch");

	// Dynamic selection lists
	// Filters

	facting_reasonslistsrch.filterList = <?php echo $acting_reasons_list->getFilterList() ?>;

	// Init search panel as collapsed
	facting_reasonslistsrch.initSearchPanel = true;
	loadjs.done("facting_reasonslistsrch");
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
<?php if (!$acting_reasons_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acting_reasons_list->TotalRecords > 0 && $acting_reasons_list->ExportOptions->visible()) { ?>
<?php $acting_reasons_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acting_reasons_list->ImportOptions->visible()) { ?>
<?php $acting_reasons_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($acting_reasons_list->SearchOptions->visible()) { ?>
<?php $acting_reasons_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($acting_reasons_list->FilterOptions->visible()) { ?>
<?php $acting_reasons_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acting_reasons_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$acting_reasons_list->isExport() && !$acting_reasons->CurrentAction) { ?>
<form name="facting_reasonslistsrch" id="facting_reasonslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="facting_reasonslistsrch-search-panel" class="<?php echo $acting_reasons_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="acting_reasons">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $acting_reasons_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($acting_reasons_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($acting_reasons_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $acting_reasons_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($acting_reasons_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($acting_reasons_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($acting_reasons_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($acting_reasons_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $acting_reasons_list->showPageHeader(); ?>
<?php
$acting_reasons_list->showMessage();
?>
<?php if ($acting_reasons_list->TotalRecords > 0 || $acting_reasons->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($acting_reasons_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> acting_reasons">
<?php if (!$acting_reasons_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$acting_reasons_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_reasons_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acting_reasons_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="facting_reasonslist" id="facting_reasonslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_reasons">
<div id="gmp_acting_reasons" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($acting_reasons_list->TotalRecords > 0 || $acting_reasons_list->isGridEdit()) { ?>
<table id="tbl_acting_reasonslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$acting_reasons->RowType = ROWTYPE_HEADER;

// Render list options
$acting_reasons_list->renderListOptions();

// Render list options (header, left)
$acting_reasons_list->ListOptions->render("header", "left");
?>
<?php if ($acting_reasons_list->ActingReasons->Visible) { // ActingReasons ?>
	<?php if ($acting_reasons_list->SortUrl($acting_reasons_list->ActingReasons) == "") { ?>
		<th data-name="ActingReasons" class="<?php echo $acting_reasons_list->ActingReasons->headerCellClass() ?>"><div id="elh_acting_reasons_ActingReasons" class="acting_reasons_ActingReasons"><div class="ew-table-header-caption"><?php echo $acting_reasons_list->ActingReasons->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingReasons" class="<?php echo $acting_reasons_list->ActingReasons->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acting_reasons_list->SortUrl($acting_reasons_list->ActingReasons) ?>', 1);"><div id="elh_acting_reasons_ActingReasons" class="acting_reasons_ActingReasons">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acting_reasons_list->ActingReasons->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acting_reasons_list->ActingReasons->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acting_reasons_list->ActingReasons->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$acting_reasons_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($acting_reasons_list->ExportAll && $acting_reasons_list->isExport()) {
	$acting_reasons_list->StopRecord = $acting_reasons_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acting_reasons_list->TotalRecords > $acting_reasons_list->StartRecord + $acting_reasons_list->DisplayRecords - 1)
		$acting_reasons_list->StopRecord = $acting_reasons_list->StartRecord + $acting_reasons_list->DisplayRecords - 1;
	else
		$acting_reasons_list->StopRecord = $acting_reasons_list->TotalRecords;
}
$acting_reasons_list->RecordCount = $acting_reasons_list->StartRecord - 1;
if ($acting_reasons_list->Recordset && !$acting_reasons_list->Recordset->EOF) {
	$acting_reasons_list->Recordset->moveFirst();
	$selectLimit = $acting_reasons_list->UseSelectLimit;
	if (!$selectLimit && $acting_reasons_list->StartRecord > 1)
		$acting_reasons_list->Recordset->move($acting_reasons_list->StartRecord - 1);
} elseif (!$acting_reasons->AllowAddDeleteRow && $acting_reasons_list->StopRecord == 0) {
	$acting_reasons_list->StopRecord = $acting_reasons->GridAddRowCount;
}

// Initialize aggregate
$acting_reasons->RowType = ROWTYPE_AGGREGATEINIT;
$acting_reasons->resetAttributes();
$acting_reasons_list->renderRow();
while ($acting_reasons_list->RecordCount < $acting_reasons_list->StopRecord) {
	$acting_reasons_list->RecordCount++;
	if ($acting_reasons_list->RecordCount >= $acting_reasons_list->StartRecord) {
		$acting_reasons_list->RowCount++;

		// Set up key count
		$acting_reasons_list->KeyCount = $acting_reasons_list->RowIndex;

		// Init row class and style
		$acting_reasons->resetAttributes();
		$acting_reasons->CssClass = "";
		if ($acting_reasons_list->isGridAdd()) {
		} else {
			$acting_reasons_list->loadRowValues($acting_reasons_list->Recordset); // Load row values
		}
		$acting_reasons->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acting_reasons->RowAttrs->merge(["data-rowindex" => $acting_reasons_list->RowCount, "id" => "r" . $acting_reasons_list->RowCount . "_acting_reasons", "data-rowtype" => $acting_reasons->RowType]);

		// Render row
		$acting_reasons_list->renderRow();

		// Render list options
		$acting_reasons_list->renderListOptions();
?>
	<tr <?php echo $acting_reasons->rowAttributes() ?>>
<?php

// Render list options (body, left)
$acting_reasons_list->ListOptions->render("body", "left", $acting_reasons_list->RowCount);
?>
	<?php if ($acting_reasons_list->ActingReasons->Visible) { // ActingReasons ?>
		<td data-name="ActingReasons" <?php echo $acting_reasons_list->ActingReasons->cellAttributes() ?>>
<span id="el<?php echo $acting_reasons_list->RowCount ?>_acting_reasons_ActingReasons">
<span<?php echo $acting_reasons_list->ActingReasons->viewAttributes() ?>><?php echo $acting_reasons_list->ActingReasons->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$acting_reasons_list->ListOptions->render("body", "right", $acting_reasons_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$acting_reasons_list->isGridAdd())
		$acting_reasons_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$acting_reasons->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acting_reasons_list->Recordset)
	$acting_reasons_list->Recordset->Close();
?>
<?php if (!$acting_reasons_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$acting_reasons_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_reasons_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acting_reasons_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($acting_reasons_list->TotalRecords == 0 && !$acting_reasons->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acting_reasons_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acting_reasons_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acting_reasons_list->isExport()) { ?>
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
$acting_reasons_list->terminate();
?>