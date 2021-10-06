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
$property_use_list = new property_use_list();

// Run the page
$property_use_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_use_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_use_list->isExport()) { ?>
<script>
var fproperty_uselist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_uselist = currentForm = new ew.Form("fproperty_uselist", "list");
	fproperty_uselist.formKeyCountName = '<?php echo $property_use_list->FormKeyCountName ?>';
	loadjs.done("fproperty_uselist");
});
var fproperty_uselistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_uselistsrch = currentSearchForm = new ew.Form("fproperty_uselistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_uselistsrch.filterList = <?php echo $property_use_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_uselistsrch.initSearchPanel = true;
	loadjs.done("fproperty_uselistsrch");
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
<?php if (!$property_use_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_use_list->TotalRecords > 0 && $property_use_list->ExportOptions->visible()) { ?>
<?php $property_use_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_use_list->ImportOptions->visible()) { ?>
<?php $property_use_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_use_list->SearchOptions->visible()) { ?>
<?php $property_use_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_use_list->FilterOptions->visible()) { ?>
<?php $property_use_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_use_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_use_list->isExport() && !$property_use->CurrentAction) { ?>
<form name="fproperty_uselistsrch" id="fproperty_uselistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_uselistsrch-search-panel" class="<?php echo $property_use_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_use">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_use_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_use_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_use_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_use_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_use_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_use_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_use_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_use_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_use_list->showPageHeader(); ?>
<?php
$property_use_list->showMessage();
?>
<?php if ($property_use_list->TotalRecords > 0 || $property_use->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_use_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_use">
<?php if (!$property_use_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_use_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_use_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_use_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_uselist" id="fproperty_uselist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_use">
<div id="gmp_property_use" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_use_list->TotalRecords > 0 || $property_use_list->isGridEdit()) { ?>
<table id="tbl_property_uselist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_use->RowType = ROWTYPE_HEADER;

// Render list options
$property_use_list->renderListOptions();

// Render list options (header, left)
$property_use_list->ListOptions->render("header", "left");
?>
<?php if ($property_use_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_use_list->SortUrl($property_use_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_use_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_use_PropertyUse" class="property_use_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_use_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_use_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_use_list->SortUrl($property_use_list->PropertyUse) ?>', 1);"><div id="elh_property_use_PropertyUse" class="property_use_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_use_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_use_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_use_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_use_list->UseDesc->Visible) { // UseDesc ?>
	<?php if ($property_use_list->SortUrl($property_use_list->UseDesc) == "") { ?>
		<th data-name="UseDesc" class="<?php echo $property_use_list->UseDesc->headerCellClass() ?>"><div id="elh_property_use_UseDesc" class="property_use_UseDesc"><div class="ew-table-header-caption"><?php echo $property_use_list->UseDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UseDesc" class="<?php echo $property_use_list->UseDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_use_list->SortUrl($property_use_list->UseDesc) ?>', 1);"><div id="elh_property_use_UseDesc" class="property_use_UseDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_use_list->UseDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_use_list->UseDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_use_list->UseDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_use_list->RatesLevy->Visible) { // RatesLevy ?>
	<?php if ($property_use_list->SortUrl($property_use_list->RatesLevy) == "") { ?>
		<th data-name="RatesLevy" class="<?php echo $property_use_list->RatesLevy->headerCellClass() ?>"><div id="elh_property_use_RatesLevy" class="property_use_RatesLevy"><div class="ew-table-header-caption"><?php echo $property_use_list->RatesLevy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RatesLevy" class="<?php echo $property_use_list->RatesLevy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_use_list->SortUrl($property_use_list->RatesLevy) ?>', 1);"><div id="elh_property_use_RatesLevy" class="property_use_RatesLevy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_use_list->RatesLevy->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_use_list->RatesLevy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_use_list->RatesLevy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_use_list->DFactor->Visible) { // DFactor ?>
	<?php if ($property_use_list->SortUrl($property_use_list->DFactor) == "") { ?>
		<th data-name="DFactor" class="<?php echo $property_use_list->DFactor->headerCellClass() ?>"><div id="elh_property_use_DFactor" class="property_use_DFactor"><div class="ew-table-header-caption"><?php echo $property_use_list->DFactor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DFactor" class="<?php echo $property_use_list->DFactor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_use_list->SortUrl($property_use_list->DFactor) ?>', 1);"><div id="elh_property_use_DFactor" class="property_use_DFactor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_use_list->DFactor->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_use_list->DFactor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_use_list->DFactor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_use_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_use_list->ExportAll && $property_use_list->isExport()) {
	$property_use_list->StopRecord = $property_use_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_use_list->TotalRecords > $property_use_list->StartRecord + $property_use_list->DisplayRecords - 1)
		$property_use_list->StopRecord = $property_use_list->StartRecord + $property_use_list->DisplayRecords - 1;
	else
		$property_use_list->StopRecord = $property_use_list->TotalRecords;
}
$property_use_list->RecordCount = $property_use_list->StartRecord - 1;
if ($property_use_list->Recordset && !$property_use_list->Recordset->EOF) {
	$property_use_list->Recordset->moveFirst();
	$selectLimit = $property_use_list->UseSelectLimit;
	if (!$selectLimit && $property_use_list->StartRecord > 1)
		$property_use_list->Recordset->move($property_use_list->StartRecord - 1);
} elseif (!$property_use->AllowAddDeleteRow && $property_use_list->StopRecord == 0) {
	$property_use_list->StopRecord = $property_use->GridAddRowCount;
}

// Initialize aggregate
$property_use->RowType = ROWTYPE_AGGREGATEINIT;
$property_use->resetAttributes();
$property_use_list->renderRow();
while ($property_use_list->RecordCount < $property_use_list->StopRecord) {
	$property_use_list->RecordCount++;
	if ($property_use_list->RecordCount >= $property_use_list->StartRecord) {
		$property_use_list->RowCount++;

		// Set up key count
		$property_use_list->KeyCount = $property_use_list->RowIndex;

		// Init row class and style
		$property_use->resetAttributes();
		$property_use->CssClass = "";
		if ($property_use_list->isGridAdd()) {
		} else {
			$property_use_list->loadRowValues($property_use_list->Recordset); // Load row values
		}
		$property_use->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_use->RowAttrs->merge(["data-rowindex" => $property_use_list->RowCount, "id" => "r" . $property_use_list->RowCount . "_property_use", "data-rowtype" => $property_use->RowType]);

		// Render row
		$property_use_list->renderRow();

		// Render list options
		$property_use_list->renderListOptions();
?>
	<tr <?php echo $property_use->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_use_list->ListOptions->render("body", "left", $property_use_list->RowCount);
?>
	<?php if ($property_use_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_use_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_use_list->RowCount ?>_property_use_PropertyUse">
<span<?php echo $property_use_list->PropertyUse->viewAttributes() ?>><?php echo $property_use_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_use_list->UseDesc->Visible) { // UseDesc ?>
		<td data-name="UseDesc" <?php echo $property_use_list->UseDesc->cellAttributes() ?>>
<span id="el<?php echo $property_use_list->RowCount ?>_property_use_UseDesc">
<span<?php echo $property_use_list->UseDesc->viewAttributes() ?>><?php echo $property_use_list->UseDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_use_list->RatesLevy->Visible) { // RatesLevy ?>
		<td data-name="RatesLevy" <?php echo $property_use_list->RatesLevy->cellAttributes() ?>>
<span id="el<?php echo $property_use_list->RowCount ?>_property_use_RatesLevy">
<span<?php echo $property_use_list->RatesLevy->viewAttributes() ?>><?php echo $property_use_list->RatesLevy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_use_list->DFactor->Visible) { // DFactor ?>
		<td data-name="DFactor" <?php echo $property_use_list->DFactor->cellAttributes() ?>>
<span id="el<?php echo $property_use_list->RowCount ?>_property_use_DFactor">
<span<?php echo $property_use_list->DFactor->viewAttributes() ?>><?php echo $property_use_list->DFactor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_use_list->ListOptions->render("body", "right", $property_use_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_use_list->isGridAdd())
		$property_use_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_use->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_use_list->Recordset)
	$property_use_list->Recordset->Close();
?>
<?php if (!$property_use_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_use_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_use_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_use_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_use_list->TotalRecords == 0 && !$property_use->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_use_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_use_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_use_list->isExport()) { ?>
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
$property_use_list->terminate();
?>