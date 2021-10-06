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
$ndp_list = new ndp_list();

// Run the page
$ndp_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ndp_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ndp_list->isExport()) { ?>
<script>
var fndplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fndplist = currentForm = new ew.Form("fndplist", "list");
	fndplist.formKeyCountName = '<?php echo $ndp_list->FormKeyCountName ?>';
	loadjs.done("fndplist");
});
var fndplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fndplistsrch = currentSearchForm = new ew.Form("fndplistsrch");

	// Dynamic selection lists
	// Filters

	fndplistsrch.filterList = <?php echo $ndp_list->getFilterList() ?>;

	// Init search panel as collapsed
	fndplistsrch.initSearchPanel = true;
	loadjs.done("fndplistsrch");
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
<?php if (!$ndp_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ndp_list->TotalRecords > 0 && $ndp_list->ExportOptions->visible()) { ?>
<?php $ndp_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ndp_list->ImportOptions->visible()) { ?>
<?php $ndp_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ndp_list->SearchOptions->visible()) { ?>
<?php $ndp_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ndp_list->FilterOptions->visible()) { ?>
<?php $ndp_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ndp_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ndp_list->isExport() && !$ndp->CurrentAction) { ?>
<form name="fndplistsrch" id="fndplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fndplistsrch-search-panel" class="<?php echo $ndp_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ndp">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ndp_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ndp_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ndp_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ndp_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ndp_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ndp_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ndp_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ndp_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ndp_list->showPageHeader(); ?>
<?php
$ndp_list->showMessage();
?>
<?php if ($ndp_list->TotalRecords > 0 || $ndp->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ndp_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ndp">
<?php if (!$ndp_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ndp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ndp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ndp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fndplist" id="fndplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ndp">
<div id="gmp_ndp" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ndp_list->TotalRecords > 0 || $ndp_list->isGridEdit()) { ?>
<table id="tbl_ndplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ndp->RowType = ROWTYPE_HEADER;

// Render list options
$ndp_list->renderListOptions();

// Render list options (header, left)
$ndp_list->ListOptions->render("header", "left");
?>
<?php if ($ndp_list->NDP->Visible) { // NDP ?>
	<?php if ($ndp_list->SortUrl($ndp_list->NDP) == "") { ?>
		<th data-name="NDP" class="<?php echo $ndp_list->NDP->headerCellClass() ?>"><div id="elh_ndp_NDP" class="ndp_NDP"><div class="ew-table-header-caption"><?php echo $ndp_list->NDP->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NDP" class="<?php echo $ndp_list->NDP->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->NDP) ?>', 1);"><div id="elh_ndp_NDP" class="ndp_NDP">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->NDP->caption() ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->NDP->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->NDP->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ndp_list->NDPShortName->Visible) { // NDPShortName ?>
	<?php if ($ndp_list->SortUrl($ndp_list->NDPShortName) == "") { ?>
		<th data-name="NDPShortName" class="<?php echo $ndp_list->NDPShortName->headerCellClass() ?>"><div id="elh_ndp_NDPShortName" class="ndp_NDPShortName"><div class="ew-table-header-caption"><?php echo $ndp_list->NDPShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NDPShortName" class="<?php echo $ndp_list->NDPShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->NDPShortName) ?>', 1);"><div id="elh_ndp_NDPShortName" class="ndp_NDPShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->NDPShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->NDPShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->NDPShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ndp_list->FromYear->Visible) { // FromYear ?>
	<?php if ($ndp_list->SortUrl($ndp_list->FromYear) == "") { ?>
		<th data-name="FromYear" class="<?php echo $ndp_list->FromYear->headerCellClass() ?>"><div id="elh_ndp_FromYear" class="ndp_FromYear"><div class="ew-table-header-caption"><?php echo $ndp_list->FromYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FromYear" class="<?php echo $ndp_list->FromYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->FromYear) ?>', 1);"><div id="elh_ndp_FromYear" class="ndp_FromYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->FromYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->FromYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->FromYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ndp_list->ToYear->Visible) { // ToYear ?>
	<?php if ($ndp_list->SortUrl($ndp_list->ToYear) == "") { ?>
		<th data-name="ToYear" class="<?php echo $ndp_list->ToYear->headerCellClass() ?>"><div id="elh_ndp_ToYear" class="ndp_ToYear"><div class="ew-table-header-caption"><?php echo $ndp_list->ToYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ToYear" class="<?php echo $ndp_list->ToYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->ToYear) ?>', 1);"><div id="elh_ndp_ToYear" class="ndp_ToYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->ToYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->ToYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->ToYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ndp_list->NDPObjectives->Visible) { // NDPObjectives ?>
	<?php if ($ndp_list->SortUrl($ndp_list->NDPObjectives) == "") { ?>
		<th data-name="NDPObjectives" class="<?php echo $ndp_list->NDPObjectives->headerCellClass() ?>"><div id="elh_ndp_NDPObjectives" class="ndp_NDPObjectives"><div class="ew-table-header-caption"><?php echo $ndp_list->NDPObjectives->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NDPObjectives" class="<?php echo $ndp_list->NDPObjectives->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->NDPObjectives) ?>', 1);"><div id="elh_ndp_NDPObjectives" class="ndp_NDPObjectives">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->NDPObjectives->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->NDPObjectives->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->NDPObjectives->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ndp_list->EffectiveDate->Visible) { // EffectiveDate ?>
	<?php if ($ndp_list->SortUrl($ndp_list->EffectiveDate) == "") { ?>
		<th data-name="EffectiveDate" class="<?php echo $ndp_list->EffectiveDate->headerCellClass() ?>"><div id="elh_ndp_EffectiveDate" class="ndp_EffectiveDate"><div class="ew-table-header-caption"><?php echo $ndp_list->EffectiveDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EffectiveDate" class="<?php echo $ndp_list->EffectiveDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->EffectiveDate) ?>', 1);"><div id="elh_ndp_EffectiveDate" class="ndp_EffectiveDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->EffectiveDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->EffectiveDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->EffectiveDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ndp_list->NDPURL->Visible) { // NDPURL ?>
	<?php if ($ndp_list->SortUrl($ndp_list->NDPURL) == "") { ?>
		<th data-name="NDPURL" class="<?php echo $ndp_list->NDPURL->headerCellClass() ?>"><div id="elh_ndp_NDPURL" class="ndp_NDPURL"><div class="ew-table-header-caption"><?php echo $ndp_list->NDPURL->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NDPURL" class="<?php echo $ndp_list->NDPURL->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ndp_list->SortUrl($ndp_list->NDPURL) ?>', 1);"><div id="elh_ndp_NDPURL" class="ndp_NDPURL">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ndp_list->NDPURL->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ndp_list->NDPURL->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ndp_list->NDPURL->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ndp_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ndp_list->ExportAll && $ndp_list->isExport()) {
	$ndp_list->StopRecord = $ndp_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ndp_list->TotalRecords > $ndp_list->StartRecord + $ndp_list->DisplayRecords - 1)
		$ndp_list->StopRecord = $ndp_list->StartRecord + $ndp_list->DisplayRecords - 1;
	else
		$ndp_list->StopRecord = $ndp_list->TotalRecords;
}
$ndp_list->RecordCount = $ndp_list->StartRecord - 1;
if ($ndp_list->Recordset && !$ndp_list->Recordset->EOF) {
	$ndp_list->Recordset->moveFirst();
	$selectLimit = $ndp_list->UseSelectLimit;
	if (!$selectLimit && $ndp_list->StartRecord > 1)
		$ndp_list->Recordset->move($ndp_list->StartRecord - 1);
} elseif (!$ndp->AllowAddDeleteRow && $ndp_list->StopRecord == 0) {
	$ndp_list->StopRecord = $ndp->GridAddRowCount;
}

// Initialize aggregate
$ndp->RowType = ROWTYPE_AGGREGATEINIT;
$ndp->resetAttributes();
$ndp_list->renderRow();
while ($ndp_list->RecordCount < $ndp_list->StopRecord) {
	$ndp_list->RecordCount++;
	if ($ndp_list->RecordCount >= $ndp_list->StartRecord) {
		$ndp_list->RowCount++;

		// Set up key count
		$ndp_list->KeyCount = $ndp_list->RowIndex;

		// Init row class and style
		$ndp->resetAttributes();
		$ndp->CssClass = "";
		if ($ndp_list->isGridAdd()) {
		} else {
			$ndp_list->loadRowValues($ndp_list->Recordset); // Load row values
		}
		$ndp->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ndp->RowAttrs->merge(["data-rowindex" => $ndp_list->RowCount, "id" => "r" . $ndp_list->RowCount . "_ndp", "data-rowtype" => $ndp->RowType]);

		// Render row
		$ndp_list->renderRow();

		// Render list options
		$ndp_list->renderListOptions();
?>
	<tr <?php echo $ndp->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ndp_list->ListOptions->render("body", "left", $ndp_list->RowCount);
?>
	<?php if ($ndp_list->NDP->Visible) { // NDP ?>
		<td data-name="NDP" <?php echo $ndp_list->NDP->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_NDP">
<span<?php echo $ndp_list->NDP->viewAttributes() ?>><?php echo $ndp_list->NDP->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ndp_list->NDPShortName->Visible) { // NDPShortName ?>
		<td data-name="NDPShortName" <?php echo $ndp_list->NDPShortName->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_NDPShortName">
<span<?php echo $ndp_list->NDPShortName->viewAttributes() ?>><?php echo $ndp_list->NDPShortName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ndp_list->FromYear->Visible) { // FromYear ?>
		<td data-name="FromYear" <?php echo $ndp_list->FromYear->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_FromYear">
<span<?php echo $ndp_list->FromYear->viewAttributes() ?>><?php echo $ndp_list->FromYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ndp_list->ToYear->Visible) { // ToYear ?>
		<td data-name="ToYear" <?php echo $ndp_list->ToYear->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_ToYear">
<span<?php echo $ndp_list->ToYear->viewAttributes() ?>><?php echo $ndp_list->ToYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ndp_list->NDPObjectives->Visible) { // NDPObjectives ?>
		<td data-name="NDPObjectives" <?php echo $ndp_list->NDPObjectives->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_NDPObjectives">
<span<?php echo $ndp_list->NDPObjectives->viewAttributes() ?>><?php echo $ndp_list->NDPObjectives->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ndp_list->EffectiveDate->Visible) { // EffectiveDate ?>
		<td data-name="EffectiveDate" <?php echo $ndp_list->EffectiveDate->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_EffectiveDate">
<span<?php echo $ndp_list->EffectiveDate->viewAttributes() ?>><?php echo $ndp_list->EffectiveDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ndp_list->NDPURL->Visible) { // NDPURL ?>
		<td data-name="NDPURL" <?php echo $ndp_list->NDPURL->cellAttributes() ?>>
<span id="el<?php echo $ndp_list->RowCount ?>_ndp_NDPURL">
<span<?php echo $ndp_list->NDPURL->viewAttributes() ?>><?php echo $ndp_list->NDPURL->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ndp_list->ListOptions->render("body", "right", $ndp_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ndp_list->isGridAdd())
		$ndp_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ndp->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ndp_list->Recordset)
	$ndp_list->Recordset->Close();
?>
<?php if (!$ndp_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ndp_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ndp_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ndp_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ndp_list->TotalRecords == 0 && !$ndp->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ndp_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ndp_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ndp_list->isExport()) { ?>
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
$ndp_list->terminate();
?>