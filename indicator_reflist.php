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
$indicator_ref_list = new indicator_ref_list();

// Run the page
$indicator_ref_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$indicator_ref_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$indicator_ref_list->isExport()) { ?>
<script>
var findicator_reflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	findicator_reflist = currentForm = new ew.Form("findicator_reflist", "list");
	findicator_reflist.formKeyCountName = '<?php echo $indicator_ref_list->FormKeyCountName ?>';
	loadjs.done("findicator_reflist");
});
var findicator_reflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	findicator_reflistsrch = currentSearchForm = new ew.Form("findicator_reflistsrch");

	// Dynamic selection lists
	// Filters

	findicator_reflistsrch.filterList = <?php echo $indicator_ref_list->getFilterList() ?>;

	// Init search panel as collapsed
	findicator_reflistsrch.initSearchPanel = true;
	loadjs.done("findicator_reflistsrch");
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
<?php if (!$indicator_ref_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($indicator_ref_list->TotalRecords > 0 && $indicator_ref_list->ExportOptions->visible()) { ?>
<?php $indicator_ref_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_ref_list->ImportOptions->visible()) { ?>
<?php $indicator_ref_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_ref_list->SearchOptions->visible()) { ?>
<?php $indicator_ref_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($indicator_ref_list->FilterOptions->visible()) { ?>
<?php $indicator_ref_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$indicator_ref_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$indicator_ref_list->isExport() && !$indicator_ref->CurrentAction) { ?>
<form name="findicator_reflistsrch" id="findicator_reflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="findicator_reflistsrch-search-panel" class="<?php echo $indicator_ref_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="indicator_ref">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $indicator_ref_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($indicator_ref_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($indicator_ref_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $indicator_ref_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($indicator_ref_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($indicator_ref_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($indicator_ref_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($indicator_ref_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $indicator_ref_list->showPageHeader(); ?>
<?php
$indicator_ref_list->showMessage();
?>
<?php if ($indicator_ref_list->TotalRecords > 0 || $indicator_ref->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($indicator_ref_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> indicator_ref">
<?php if (!$indicator_ref_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$indicator_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="findicator_reflist" id="findicator_reflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="indicator_ref">
<div id="gmp_indicator_ref" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($indicator_ref_list->TotalRecords > 0 || $indicator_ref_list->isGridEdit()) { ?>
<table id="tbl_indicator_reflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$indicator_ref->RowType = ROWTYPE_HEADER;

// Render list options
$indicator_ref_list->renderListOptions();

// Render list options (header, left)
$indicator_ref_list->ListOptions->render("header", "left");
?>
<?php if ($indicator_ref_list->indicator_code->Visible) { // indicator_code ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->indicator_code) == "") { ?>
		<th data-name="indicator_code" class="<?php echo $indicator_ref_list->indicator_code->headerCellClass() ?>"><div id="elh_indicator_ref_indicator_code" class="indicator_ref_indicator_code"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_code" class="<?php echo $indicator_ref_list->indicator_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->indicator_code) ?>', 1);"><div id="elh_indicator_ref_indicator_code" class="indicator_ref_indicator_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->indicator_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->indicator_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->indicator_name->Visible) { // indicator_name ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->indicator_name) == "") { ?>
		<th data-name="indicator_name" class="<?php echo $indicator_ref_list->indicator_name->headerCellClass() ?>"><div id="elh_indicator_ref_indicator_name" class="indicator_ref_indicator_name"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_name" class="<?php echo $indicator_ref_list->indicator_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->indicator_name) ?>', 1);"><div id="elh_indicator_ref_indicator_name" class="indicator_ref_indicator_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->indicator_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->indicator_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->indicator_desc->Visible) { // indicator_desc ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->indicator_desc) == "") { ?>
		<th data-name="indicator_desc" class="<?php echo $indicator_ref_list->indicator_desc->headerCellClass() ?>"><div id="elh_indicator_ref_indicator_desc" class="indicator_ref_indicator_desc"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_desc" class="<?php echo $indicator_ref_list->indicator_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->indicator_desc) ?>', 1);"><div id="elh_indicator_ref_indicator_desc" class="indicator_ref_indicator_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->indicator_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->indicator_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->formula_ref->Visible) { // formula_ref ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->formula_ref) == "") { ?>
		<th data-name="formula_ref" class="<?php echo $indicator_ref_list->formula_ref->headerCellClass() ?>"><div id="elh_indicator_ref_formula_ref" class="indicator_ref_formula_ref"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->formula_ref->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="formula_ref" class="<?php echo $indicator_ref_list->formula_ref->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->formula_ref) ?>', 1);"><div id="elh_indicator_ref_formula_ref" class="indicator_ref_formula_ref">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->formula_ref->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->formula_ref->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->formula_ref->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->direction->Visible) { // direction ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->direction) == "") { ?>
		<th data-name="direction" class="<?php echo $indicator_ref_list->direction->headerCellClass() ?>"><div id="elh_indicator_ref_direction" class="indicator_ref_direction"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->direction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="direction" class="<?php echo $indicator_ref_list->direction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->direction) ?>', 1);"><div id="elh_indicator_ref_direction" class="indicator_ref_direction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->direction->caption() ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->direction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->direction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->target->Visible) { // target ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->target) == "") { ?>
		<th data-name="target" class="<?php echo $indicator_ref_list->target->headerCellClass() ?>"><div id="elh_indicator_ref_target" class="indicator_ref_target"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->target->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="target" class="<?php echo $indicator_ref_list->target->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->target) ?>', 1);"><div id="elh_indicator_ref_target" class="indicator_ref_target">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->target->caption() ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->target->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->target->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->indicator_measure->Visible) { // indicator_measure ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->indicator_measure) == "") { ?>
		<th data-name="indicator_measure" class="<?php echo $indicator_ref_list->indicator_measure->headerCellClass() ?>"><div id="elh_indicator_ref_indicator_measure" class="indicator_ref_indicator_measure"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_measure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_measure" class="<?php echo $indicator_ref_list->indicator_measure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->indicator_measure) ?>', 1);"><div id="elh_indicator_ref_indicator_measure" class="indicator_ref_indicator_measure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_measure->caption() ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->indicator_measure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->indicator_measure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($indicator_ref_list->indicator_frequency->Visible) { // indicator_frequency ?>
	<?php if ($indicator_ref_list->SortUrl($indicator_ref_list->indicator_frequency) == "") { ?>
		<th data-name="indicator_frequency" class="<?php echo $indicator_ref_list->indicator_frequency->headerCellClass() ?>"><div id="elh_indicator_ref_indicator_frequency" class="indicator_ref_indicator_frequency"><div class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="indicator_frequency" class="<?php echo $indicator_ref_list->indicator_frequency->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $indicator_ref_list->SortUrl($indicator_ref_list->indicator_frequency) ?>', 1);"><div id="elh_indicator_ref_indicator_frequency" class="indicator_ref_indicator_frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $indicator_ref_list->indicator_frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($indicator_ref_list->indicator_frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($indicator_ref_list->indicator_frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$indicator_ref_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($indicator_ref_list->ExportAll && $indicator_ref_list->isExport()) {
	$indicator_ref_list->StopRecord = $indicator_ref_list->TotalRecords;
} else {

	// Set the last record to display
	if ($indicator_ref_list->TotalRecords > $indicator_ref_list->StartRecord + $indicator_ref_list->DisplayRecords - 1)
		$indicator_ref_list->StopRecord = $indicator_ref_list->StartRecord + $indicator_ref_list->DisplayRecords - 1;
	else
		$indicator_ref_list->StopRecord = $indicator_ref_list->TotalRecords;
}
$indicator_ref_list->RecordCount = $indicator_ref_list->StartRecord - 1;
if ($indicator_ref_list->Recordset && !$indicator_ref_list->Recordset->EOF) {
	$indicator_ref_list->Recordset->moveFirst();
	$selectLimit = $indicator_ref_list->UseSelectLimit;
	if (!$selectLimit && $indicator_ref_list->StartRecord > 1)
		$indicator_ref_list->Recordset->move($indicator_ref_list->StartRecord - 1);
} elseif (!$indicator_ref->AllowAddDeleteRow && $indicator_ref_list->StopRecord == 0) {
	$indicator_ref_list->StopRecord = $indicator_ref->GridAddRowCount;
}

// Initialize aggregate
$indicator_ref->RowType = ROWTYPE_AGGREGATEINIT;
$indicator_ref->resetAttributes();
$indicator_ref_list->renderRow();
while ($indicator_ref_list->RecordCount < $indicator_ref_list->StopRecord) {
	$indicator_ref_list->RecordCount++;
	if ($indicator_ref_list->RecordCount >= $indicator_ref_list->StartRecord) {
		$indicator_ref_list->RowCount++;

		// Set up key count
		$indicator_ref_list->KeyCount = $indicator_ref_list->RowIndex;

		// Init row class and style
		$indicator_ref->resetAttributes();
		$indicator_ref->CssClass = "";
		if ($indicator_ref_list->isGridAdd()) {
		} else {
			$indicator_ref_list->loadRowValues($indicator_ref_list->Recordset); // Load row values
		}
		$indicator_ref->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$indicator_ref->RowAttrs->merge(["data-rowindex" => $indicator_ref_list->RowCount, "id" => "r" . $indicator_ref_list->RowCount . "_indicator_ref", "data-rowtype" => $indicator_ref->RowType]);

		// Render row
		$indicator_ref_list->renderRow();

		// Render list options
		$indicator_ref_list->renderListOptions();
?>
	<tr <?php echo $indicator_ref->rowAttributes() ?>>
<?php

// Render list options (body, left)
$indicator_ref_list->ListOptions->render("body", "left", $indicator_ref_list->RowCount);
?>
	<?php if ($indicator_ref_list->indicator_code->Visible) { // indicator_code ?>
		<td data-name="indicator_code" <?php echo $indicator_ref_list->indicator_code->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_indicator_code">
<span<?php echo $indicator_ref_list->indicator_code->viewAttributes() ?>><?php echo $indicator_ref_list->indicator_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->indicator_name->Visible) { // indicator_name ?>
		<td data-name="indicator_name" <?php echo $indicator_ref_list->indicator_name->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_indicator_name">
<span<?php echo $indicator_ref_list->indicator_name->viewAttributes() ?>><?php echo $indicator_ref_list->indicator_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->indicator_desc->Visible) { // indicator_desc ?>
		<td data-name="indicator_desc" <?php echo $indicator_ref_list->indicator_desc->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_indicator_desc">
<span<?php echo $indicator_ref_list->indicator_desc->viewAttributes() ?>><?php echo $indicator_ref_list->indicator_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->formula_ref->Visible) { // formula_ref ?>
		<td data-name="formula_ref" <?php echo $indicator_ref_list->formula_ref->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_formula_ref">
<span<?php echo $indicator_ref_list->formula_ref->viewAttributes() ?>><?php echo $indicator_ref_list->formula_ref->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->direction->Visible) { // direction ?>
		<td data-name="direction" <?php echo $indicator_ref_list->direction->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_direction">
<span<?php echo $indicator_ref_list->direction->viewAttributes() ?>><?php echo $indicator_ref_list->direction->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->target->Visible) { // target ?>
		<td data-name="target" <?php echo $indicator_ref_list->target->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_target">
<span<?php echo $indicator_ref_list->target->viewAttributes() ?>><?php echo $indicator_ref_list->target->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->indicator_measure->Visible) { // indicator_measure ?>
		<td data-name="indicator_measure" <?php echo $indicator_ref_list->indicator_measure->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_indicator_measure">
<span<?php echo $indicator_ref_list->indicator_measure->viewAttributes() ?>><?php echo $indicator_ref_list->indicator_measure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($indicator_ref_list->indicator_frequency->Visible) { // indicator_frequency ?>
		<td data-name="indicator_frequency" <?php echo $indicator_ref_list->indicator_frequency->cellAttributes() ?>>
<span id="el<?php echo $indicator_ref_list->RowCount ?>_indicator_ref_indicator_frequency">
<span<?php echo $indicator_ref_list->indicator_frequency->viewAttributes() ?>><?php echo $indicator_ref_list->indicator_frequency->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$indicator_ref_list->ListOptions->render("body", "right", $indicator_ref_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$indicator_ref_list->isGridAdd())
		$indicator_ref_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$indicator_ref->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($indicator_ref_list->Recordset)
	$indicator_ref_list->Recordset->Close();
?>
<?php if (!$indicator_ref_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$indicator_ref_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $indicator_ref_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $indicator_ref_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($indicator_ref_list->TotalRecords == 0 && !$indicator_ref->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $indicator_ref_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$indicator_ref_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$indicator_ref_list->isExport()) { ?>
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
$indicator_ref_list->terminate();
?>