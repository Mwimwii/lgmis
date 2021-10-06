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
$pos_ref_list = new pos_ref_list();

// Run the page
$pos_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pos_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$pos_ref_list->isExport()) { ?>
<script>
var fpos_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpos_reflist = currentForm = new ew.Form("fpos_reflist", "list");
	fpos_reflist.formKeyCountName = '<?php echo $pos_ref_list->FormKeyCountName ?>';
	loadjs.done("fpos_reflist");
});
var fpos_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpos_reflistsrch = currentSearchForm = new ew.Form("fpos_reflistsrch");

	// Dynamic selection lists
	// Filters

	fpos_reflistsrch.filterList = <?php echo $pos_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpos_reflistsrch.initSearchPanel = true;
	loadjs.done("fpos_reflistsrch");
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
<?php if (!$pos_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($pos_ref_list->TotalRecords > 0 && $pos_ref_list->ExportOptions->visible()) { ?>
<?php $pos_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($pos_ref_list->ImportOptions->visible()) { ?>
<?php $pos_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($pos_ref_list->SearchOptions->visible()) { ?>
<?php $pos_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($pos_ref_list->FilterOptions->visible()) { ?>
<?php $pos_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$pos_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$pos_ref_list->isExport() && !$pos_ref->CurrentAction) { ?>
<form name="fpos_reflistsrch" id="fpos_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpos_reflistsrch-search-panel" class="<?php echo $pos_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="pos_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $pos_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($pos_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($pos_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $pos_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($pos_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($pos_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($pos_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($pos_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $pos_ref_list->showPageHeader(); ?>
<?php
$pos_ref_list->showMessage();
?>
<?php if ($pos_ref_list->TotalRecords > 0 || $pos_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($pos_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> pos_ref">
<?php if (!$pos_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$pos_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pos_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pos_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpos_reflist" id="fpos_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pos_ref">
<div id="gmp_pos_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($pos_ref_list->TotalRecords > 0 || $pos_ref_list->isGridEdit()) { ?>
<table id="tbl_pos_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$pos_ref->RowType = ROWTYPE_HEADER;

// Render list options
$pos_ref_list->renderListOptions();

// Render list options (header, left)
$pos_ref_list->ListOptions->render("header", "left");
?>
<?php if ($pos_ref_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($pos_ref_list->SortUrl($pos_ref_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $pos_ref_list->ProvinceCode->headerCellClass() ?>"><div id="elh_pos_ref_ProvinceCode" class="pos_ref_ProvinceCode"><div class="ew-table-header-caption"><?php echo $pos_ref_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $pos_ref_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_ref_list->SortUrl($pos_ref_list->ProvinceCode) ?>', 1);"><div id="elh_pos_ref_ProvinceCode" class="pos_ref_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_ref_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($pos_ref_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_ref_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pos_ref_list->LAcode->Visible) { // LAcode ?>
	<?php if ($pos_ref_list->SortUrl($pos_ref_list->LAcode) == "") { ?>
		<th data-name="LAcode" class="<?php echo $pos_ref_list->LAcode->headerCellClass() ?>"><div id="elh_pos_ref_LAcode" class="pos_ref_LAcode"><div class="ew-table-header-caption"><?php echo $pos_ref_list->LAcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAcode" class="<?php echo $pos_ref_list->LAcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_ref_list->SortUrl($pos_ref_list->LAcode) ?>', 1);"><div id="elh_pos_ref_LAcode" class="pos_ref_LAcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_ref_list->LAcode->caption() ?></span><span class="ew-table-header-sort"><?php if ($pos_ref_list->LAcode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_ref_list->LAcode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pos_ref_list->PositionName->Visible) { // PositionName ?>
	<?php if ($pos_ref_list->SortUrl($pos_ref_list->PositionName) == "") { ?>
		<th data-name="PositionName" class="<?php echo $pos_ref_list->PositionName->headerCellClass() ?>"><div id="elh_pos_ref_PositionName" class="pos_ref_PositionName"><div class="ew-table-header-caption"><?php echo $pos_ref_list->PositionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionName" class="<?php echo $pos_ref_list->PositionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_ref_list->SortUrl($pos_ref_list->PositionName) ?>', 1);"><div id="elh_pos_ref_PositionName" class="pos_ref_PositionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_ref_list->PositionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pos_ref_list->PositionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_ref_list->PositionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pos_ref_list->SalaryScale->Visible) { // SalaryScale ?>
	<?php if ($pos_ref_list->SortUrl($pos_ref_list->SalaryScale) == "") { ?>
		<th data-name="SalaryScale" class="<?php echo $pos_ref_list->SalaryScale->headerCellClass() ?>"><div id="elh_pos_ref_SalaryScale" class="pos_ref_SalaryScale"><div class="ew-table-header-caption"><?php echo $pos_ref_list->SalaryScale->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SalaryScale" class="<?php echo $pos_ref_list->SalaryScale->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_ref_list->SortUrl($pos_ref_list->SalaryScale) ?>', 1);"><div id="elh_pos_ref_SalaryScale" class="pos_ref_SalaryScale">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_ref_list->SalaryScale->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pos_ref_list->SalaryScale->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_ref_list->SalaryScale->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pos_ref_list->Sectionname->Visible) { // Sectionname ?>
	<?php if ($pos_ref_list->SortUrl($pos_ref_list->Sectionname) == "") { ?>
		<th data-name="Sectionname" class="<?php echo $pos_ref_list->Sectionname->headerCellClass() ?>"><div id="elh_pos_ref_Sectionname" class="pos_ref_Sectionname"><div class="ew-table-header-caption"><?php echo $pos_ref_list->Sectionname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Sectionname" class="<?php echo $pos_ref_list->Sectionname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_ref_list->SortUrl($pos_ref_list->Sectionname) ?>', 1);"><div id="elh_pos_ref_Sectionname" class="pos_ref_Sectionname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_ref_list->Sectionname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($pos_ref_list->Sectionname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_ref_list->Sectionname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pos_ref_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($pos_ref_list->SortUrl($pos_ref_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $pos_ref_list->CouncilType->headerCellClass() ?>"><div id="elh_pos_ref_CouncilType" class="pos_ref_CouncilType"><div class="ew-table-header-caption"><?php echo $pos_ref_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $pos_ref_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $pos_ref_list->SortUrl($pos_ref_list->CouncilType) ?>', 1);"><div id="elh_pos_ref_CouncilType" class="pos_ref_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $pos_ref_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($pos_ref_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($pos_ref_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pos_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pos_ref_list->ExportAll && $pos_ref_list->isExport()) {
	$pos_ref_list->StopRecord = $pos_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($pos_ref_list->TotalRecords > $pos_ref_list->StartRecord + $pos_ref_list->DisplayRecords - 1)
		$pos_ref_list->StopRecord = $pos_ref_list->StartRecord + $pos_ref_list->DisplayRecords - 1;
	else
		$pos_ref_list->StopRecord = $pos_ref_list->TotalRecords;
}
$pos_ref_list->RecordCount = $pos_ref_list->StartRecord - 1;
if ($pos_ref_list->Recordset && !$pos_ref_list->Recordset->EOF) {
	$pos_ref_list->Recordset->moveFirst();
	$selectLimit = $pos_ref_list->UseSelectLimit;
	if (!$selectLimit && $pos_ref_list->StartRecord > 1)
		$pos_ref_list->Recordset->move($pos_ref_list->StartRecord - 1);
} elseif (!$pos_ref->AllowAddDeleteRow && $pos_ref_list->StopRecord == 0) {
	$pos_ref_list->StopRecord = $pos_ref->GridAddRowCount;
}

// Initialize aggregate
$pos_ref->RowType = ROWTYPE_AGGREGATEINIT;
$pos_ref->resetAttributes();
$pos_ref_list->renderRow();
while ($pos_ref_list->RecordCount < $pos_ref_list->StopRecord) {
	$pos_ref_list->RecordCount++;
	if ($pos_ref_list->RecordCount >= $pos_ref_list->StartRecord) {
		$pos_ref_list->RowCount++;

		// Set up key count
		$pos_ref_list->KeyCount = $pos_ref_list->RowIndex;

		// Init row class and style
		$pos_ref->resetAttributes();
		$pos_ref->CssClass = "";
		if ($pos_ref_list->isGridAdd()) {
		} else {
			$pos_ref_list->loadRowValues($pos_ref_list->Recordset); // Load row values
		}
		$pos_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$pos_ref->RowAttrs->merge(["data-rowindex" => $pos_ref_list->RowCount, "id" => "r" . $pos_ref_list->RowCount . "_pos_ref", "data-rowtype" => $pos_ref->RowType]);

		// Render row
		$pos_ref_list->renderRow();

		// Render list options
		$pos_ref_list->renderListOptions();
?>
	<tr <?php echo $pos_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$pos_ref_list->ListOptions->render("body", "left", $pos_ref_list->RowCount);
?>
	<?php if ($pos_ref_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $pos_ref_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $pos_ref_list->RowCount ?>_pos_ref_ProvinceCode">
<span<?php echo $pos_ref_list->ProvinceCode->viewAttributes() ?>><?php echo $pos_ref_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pos_ref_list->LAcode->Visible) { // LAcode ?>
		<td data-name="LAcode" <?php echo $pos_ref_list->LAcode->cellAttributes() ?>>
<span id="el<?php echo $pos_ref_list->RowCount ?>_pos_ref_LAcode">
<span<?php echo $pos_ref_list->LAcode->viewAttributes() ?>><?php echo $pos_ref_list->LAcode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pos_ref_list->PositionName->Visible) { // PositionName ?>
		<td data-name="PositionName" <?php echo $pos_ref_list->PositionName->cellAttributes() ?>>
<span id="el<?php echo $pos_ref_list->RowCount ?>_pos_ref_PositionName">
<span<?php echo $pos_ref_list->PositionName->viewAttributes() ?>><?php echo $pos_ref_list->PositionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pos_ref_list->SalaryScale->Visible) { // SalaryScale ?>
		<td data-name="SalaryScale" <?php echo $pos_ref_list->SalaryScale->cellAttributes() ?>>
<span id="el<?php echo $pos_ref_list->RowCount ?>_pos_ref_SalaryScale">
<span<?php echo $pos_ref_list->SalaryScale->viewAttributes() ?>><?php echo $pos_ref_list->SalaryScale->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pos_ref_list->Sectionname->Visible) { // Sectionname ?>
		<td data-name="Sectionname" <?php echo $pos_ref_list->Sectionname->cellAttributes() ?>>
<span id="el<?php echo $pos_ref_list->RowCount ?>_pos_ref_Sectionname">
<span<?php echo $pos_ref_list->Sectionname->viewAttributes() ?>><?php echo $pos_ref_list->Sectionname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($pos_ref_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $pos_ref_list->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $pos_ref_list->RowCount ?>_pos_ref_CouncilType">
<span<?php echo $pos_ref_list->CouncilType->viewAttributes() ?>><?php echo $pos_ref_list->CouncilType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pos_ref_list->ListOptions->render("body", "right", $pos_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$pos_ref_list->isGridAdd())
		$pos_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$pos_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($pos_ref_list->Recordset)
	$pos_ref_list->Recordset->Close();
?>
<?php if (!$pos_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$pos_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $pos_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $pos_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($pos_ref_list->TotalRecords == 0 && !$pos_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $pos_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$pos_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$pos_ref_list->isExport()) { ?>
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
$pos_ref_list->terminate();
?>