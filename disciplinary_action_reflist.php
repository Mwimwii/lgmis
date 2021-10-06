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
$disciplinary_action_ref_list = new disciplinary_action_ref_list();

// Run the page
$disciplinary_action_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$disciplinary_action_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$disciplinary_action_ref_list->isExport()) { ?>
<script>
var fdisciplinary_action_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdisciplinary_action_reflist = currentForm = new ew.Form("fdisciplinary_action_reflist", "list");
	fdisciplinary_action_reflist.formKeyCountName = '<?php echo $disciplinary_action_ref_list->FormKeyCountName ?>';
	loadjs.done("fdisciplinary_action_reflist");
});
var fdisciplinary_action_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdisciplinary_action_reflistsrch = currentSearchForm = new ew.Form("fdisciplinary_action_reflistsrch");

	// Dynamic selection lists
	// Filters

	fdisciplinary_action_reflistsrch.filterList = <?php echo $disciplinary_action_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdisciplinary_action_reflistsrch.initSearchPanel = true;
	loadjs.done("fdisciplinary_action_reflistsrch");
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
<?php if (!$disciplinary_action_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($disciplinary_action_ref_list->TotalRecords > 0 && $disciplinary_action_ref_list->ExportOptions->visible()) { ?>
<?php $disciplinary_action_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($disciplinary_action_ref_list->ImportOptions->visible()) { ?>
<?php $disciplinary_action_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($disciplinary_action_ref_list->SearchOptions->visible()) { ?>
<?php $disciplinary_action_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($disciplinary_action_ref_list->FilterOptions->visible()) { ?>
<?php $disciplinary_action_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$disciplinary_action_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$disciplinary_action_ref_list->isExport() && !$disciplinary_action_ref->CurrentAction) { ?>
<form name="fdisciplinary_action_reflistsrch" id="fdisciplinary_action_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdisciplinary_action_reflistsrch-search-panel" class="<?php echo $disciplinary_action_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="disciplinary_action_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $disciplinary_action_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($disciplinary_action_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($disciplinary_action_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $disciplinary_action_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($disciplinary_action_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($disciplinary_action_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($disciplinary_action_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($disciplinary_action_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $disciplinary_action_ref_list->showPageHeader(); ?>
<?php
$disciplinary_action_ref_list->showMessage();
?>
<?php if ($disciplinary_action_ref_list->TotalRecords > 0 || $disciplinary_action_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($disciplinary_action_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> disciplinary_action_ref">
<?php if (!$disciplinary_action_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$disciplinary_action_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $disciplinary_action_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $disciplinary_action_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdisciplinary_action_reflist" id="fdisciplinary_action_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="disciplinary_action_ref">
<div id="gmp_disciplinary_action_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($disciplinary_action_ref_list->TotalRecords > 0 || $disciplinary_action_ref_list->isGridEdit()) { ?>
<table id="tbl_disciplinary_action_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$disciplinary_action_ref->RowType = ROWTYPE_HEADER;

// Render list options
$disciplinary_action_ref_list->renderListOptions();

// Render list options (header, left)
$disciplinary_action_ref_list->ListOptions->render("header", "left");
?>
<?php if ($disciplinary_action_ref_list->ActionCode->Visible) { // ActionCode ?>
	<?php if ($disciplinary_action_ref_list->SortUrl($disciplinary_action_ref_list->ActionCode) == "") { ?>
		<th data-name="ActionCode" class="<?php echo $disciplinary_action_ref_list->ActionCode->headerCellClass() ?>"><div id="elh_disciplinary_action_ref_ActionCode" class="disciplinary_action_ref_ActionCode"><div class="ew-table-header-caption"><?php echo $disciplinary_action_ref_list->ActionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionCode" class="<?php echo $disciplinary_action_ref_list->ActionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $disciplinary_action_ref_list->SortUrl($disciplinary_action_ref_list->ActionCode) ?>', 1);"><div id="elh_disciplinary_action_ref_ActionCode" class="disciplinary_action_ref_ActionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $disciplinary_action_ref_list->ActionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($disciplinary_action_ref_list->ActionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($disciplinary_action_ref_list->ActionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($disciplinary_action_ref_list->ActionDesc->Visible) { // ActionDesc ?>
	<?php if ($disciplinary_action_ref_list->SortUrl($disciplinary_action_ref_list->ActionDesc) == "") { ?>
		<th data-name="ActionDesc" class="<?php echo $disciplinary_action_ref_list->ActionDesc->headerCellClass() ?>"><div id="elh_disciplinary_action_ref_ActionDesc" class="disciplinary_action_ref_ActionDesc"><div class="ew-table-header-caption"><?php echo $disciplinary_action_ref_list->ActionDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDesc" class="<?php echo $disciplinary_action_ref_list->ActionDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $disciplinary_action_ref_list->SortUrl($disciplinary_action_ref_list->ActionDesc) ?>', 1);"><div id="elh_disciplinary_action_ref_ActionDesc" class="disciplinary_action_ref_ActionDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $disciplinary_action_ref_list->ActionDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($disciplinary_action_ref_list->ActionDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($disciplinary_action_ref_list->ActionDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($disciplinary_action_ref_list->Authority->Visible) { // Authority ?>
	<?php if ($disciplinary_action_ref_list->SortUrl($disciplinary_action_ref_list->Authority) == "") { ?>
		<th data-name="Authority" class="<?php echo $disciplinary_action_ref_list->Authority->headerCellClass() ?>"><div id="elh_disciplinary_action_ref_Authority" class="disciplinary_action_ref_Authority"><div class="ew-table-header-caption"><?php echo $disciplinary_action_ref_list->Authority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Authority" class="<?php echo $disciplinary_action_ref_list->Authority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $disciplinary_action_ref_list->SortUrl($disciplinary_action_ref_list->Authority) ?>', 1);"><div id="elh_disciplinary_action_ref_Authority" class="disciplinary_action_ref_Authority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $disciplinary_action_ref_list->Authority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($disciplinary_action_ref_list->Authority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($disciplinary_action_ref_list->Authority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$disciplinary_action_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($disciplinary_action_ref_list->ExportAll && $disciplinary_action_ref_list->isExport()) {
	$disciplinary_action_ref_list->StopRecord = $disciplinary_action_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($disciplinary_action_ref_list->TotalRecords > $disciplinary_action_ref_list->StartRecord + $disciplinary_action_ref_list->DisplayRecords - 1)
		$disciplinary_action_ref_list->StopRecord = $disciplinary_action_ref_list->StartRecord + $disciplinary_action_ref_list->DisplayRecords - 1;
	else
		$disciplinary_action_ref_list->StopRecord = $disciplinary_action_ref_list->TotalRecords;
}
$disciplinary_action_ref_list->RecordCount = $disciplinary_action_ref_list->StartRecord - 1;
if ($disciplinary_action_ref_list->Recordset && !$disciplinary_action_ref_list->Recordset->EOF) {
	$disciplinary_action_ref_list->Recordset->moveFirst();
	$selectLimit = $disciplinary_action_ref_list->UseSelectLimit;
	if (!$selectLimit && $disciplinary_action_ref_list->StartRecord > 1)
		$disciplinary_action_ref_list->Recordset->move($disciplinary_action_ref_list->StartRecord - 1);
} elseif (!$disciplinary_action_ref->AllowAddDeleteRow && $disciplinary_action_ref_list->StopRecord == 0) {
	$disciplinary_action_ref_list->StopRecord = $disciplinary_action_ref->GridAddRowCount;
}

// Initialize aggregate
$disciplinary_action_ref->RowType = ROWTYPE_AGGREGATEINIT;
$disciplinary_action_ref->resetAttributes();
$disciplinary_action_ref_list->renderRow();
while ($disciplinary_action_ref_list->RecordCount < $disciplinary_action_ref_list->StopRecord) {
	$disciplinary_action_ref_list->RecordCount++;
	if ($disciplinary_action_ref_list->RecordCount >= $disciplinary_action_ref_list->StartRecord) {
		$disciplinary_action_ref_list->RowCount++;

		// Set up key count
		$disciplinary_action_ref_list->KeyCount = $disciplinary_action_ref_list->RowIndex;

		// Init row class and style
		$disciplinary_action_ref->resetAttributes();
		$disciplinary_action_ref->CssClass = "";
		if ($disciplinary_action_ref_list->isGridAdd()) {
		} else {
			$disciplinary_action_ref_list->loadRowValues($disciplinary_action_ref_list->Recordset); // Load row values
		}
		$disciplinary_action_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$disciplinary_action_ref->RowAttrs->merge(["data-rowindex" => $disciplinary_action_ref_list->RowCount, "id" => "r" . $disciplinary_action_ref_list->RowCount . "_disciplinary_action_ref", "data-rowtype" => $disciplinary_action_ref->RowType]);

		// Render row
		$disciplinary_action_ref_list->renderRow();

		// Render list options
		$disciplinary_action_ref_list->renderListOptions();
?>
	<tr <?php echo $disciplinary_action_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$disciplinary_action_ref_list->ListOptions->render("body", "left", $disciplinary_action_ref_list->RowCount);
?>
	<?php if ($disciplinary_action_ref_list->ActionCode->Visible) { // ActionCode ?>
		<td data-name="ActionCode" <?php echo $disciplinary_action_ref_list->ActionCode->cellAttributes() ?>>
<span id="el<?php echo $disciplinary_action_ref_list->RowCount ?>_disciplinary_action_ref_ActionCode">
<span<?php echo $disciplinary_action_ref_list->ActionCode->viewAttributes() ?>><?php echo $disciplinary_action_ref_list->ActionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($disciplinary_action_ref_list->ActionDesc->Visible) { // ActionDesc ?>
		<td data-name="ActionDesc" <?php echo $disciplinary_action_ref_list->ActionDesc->cellAttributes() ?>>
<span id="el<?php echo $disciplinary_action_ref_list->RowCount ?>_disciplinary_action_ref_ActionDesc">
<span<?php echo $disciplinary_action_ref_list->ActionDesc->viewAttributes() ?>><?php echo $disciplinary_action_ref_list->ActionDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($disciplinary_action_ref_list->Authority->Visible) { // Authority ?>
		<td data-name="Authority" <?php echo $disciplinary_action_ref_list->Authority->cellAttributes() ?>>
<span id="el<?php echo $disciplinary_action_ref_list->RowCount ?>_disciplinary_action_ref_Authority">
<span<?php echo $disciplinary_action_ref_list->Authority->viewAttributes() ?>><?php echo $disciplinary_action_ref_list->Authority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$disciplinary_action_ref_list->ListOptions->render("body", "right", $disciplinary_action_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$disciplinary_action_ref_list->isGridAdd())
		$disciplinary_action_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$disciplinary_action_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($disciplinary_action_ref_list->Recordset)
	$disciplinary_action_ref_list->Recordset->Close();
?>
<?php if (!$disciplinary_action_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$disciplinary_action_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $disciplinary_action_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $disciplinary_action_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($disciplinary_action_ref_list->TotalRecords == 0 && !$disciplinary_action_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $disciplinary_action_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$disciplinary_action_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$disciplinary_action_ref_list->isExport()) { ?>
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
$disciplinary_action_ref_list->terminate();
?>