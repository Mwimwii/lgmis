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
$acting_type_list = new acting_type_list();

// Run the page
$acting_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$acting_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$acting_type_list->isExport()) { ?>
<script>
var facting_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	facting_typelist = currentForm = new ew.Form("facting_typelist", "list");
	facting_typelist.formKeyCountName = '<?php echo $acting_type_list->FormKeyCountName ?>';
	loadjs.done("facting_typelist");
});
var facting_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	facting_typelistsrch = currentSearchForm = new ew.Form("facting_typelistsrch");

	// Dynamic selection lists
	// Filters

	facting_typelistsrch.filterList = <?php echo $acting_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	facting_typelistsrch.initSearchPanel = true;
	loadjs.done("facting_typelistsrch");
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
<?php if (!$acting_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($acting_type_list->TotalRecords > 0 && $acting_type_list->ExportOptions->visible()) { ?>
<?php $acting_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($acting_type_list->ImportOptions->visible()) { ?>
<?php $acting_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($acting_type_list->SearchOptions->visible()) { ?>
<?php $acting_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($acting_type_list->FilterOptions->visible()) { ?>
<?php $acting_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$acting_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$acting_type_list->isExport() && !$acting_type->CurrentAction) { ?>
<form name="facting_typelistsrch" id="facting_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="facting_typelistsrch-search-panel" class="<?php echo $acting_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="acting_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $acting_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($acting_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($acting_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $acting_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($acting_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($acting_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($acting_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($acting_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $acting_type_list->showPageHeader(); ?>
<?php
$acting_type_list->showMessage();
?>
<?php if ($acting_type_list->TotalRecords > 0 || $acting_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($acting_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> acting_type">
<?php if (!$acting_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$acting_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acting_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="facting_typelist" id="facting_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="acting_type">
<div id="gmp_acting_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($acting_type_list->TotalRecords > 0 || $acting_type_list->isGridEdit()) { ?>
<table id="tbl_acting_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$acting_type->RowType = ROWTYPE_HEADER;

// Render list options
$acting_type_list->renderListOptions();

// Render list options (header, left)
$acting_type_list->ListOptions->render("header", "left");
?>
<?php if ($acting_type_list->ActingType->Visible) { // ActingType ?>
	<?php if ($acting_type_list->SortUrl($acting_type_list->ActingType) == "") { ?>
		<th data-name="ActingType" class="<?php echo $acting_type_list->ActingType->headerCellClass() ?>"><div id="elh_acting_type_ActingType" class="acting_type_ActingType"><div class="ew-table-header-caption"><?php echo $acting_type_list->ActingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingType" class="<?php echo $acting_type_list->ActingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acting_type_list->SortUrl($acting_type_list->ActingType) ?>', 1);"><div id="elh_acting_type_ActingType" class="acting_type_ActingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acting_type_list->ActingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($acting_type_list->ActingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acting_type_list->ActingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($acting_type_list->ActingTypeDesc->Visible) { // ActingTypeDesc ?>
	<?php if ($acting_type_list->SortUrl($acting_type_list->ActingTypeDesc) == "") { ?>
		<th data-name="ActingTypeDesc" class="<?php echo $acting_type_list->ActingTypeDesc->headerCellClass() ?>"><div id="elh_acting_type_ActingTypeDesc" class="acting_type_ActingTypeDesc"><div class="ew-table-header-caption"><?php echo $acting_type_list->ActingTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActingTypeDesc" class="<?php echo $acting_type_list->ActingTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $acting_type_list->SortUrl($acting_type_list->ActingTypeDesc) ?>', 1);"><div id="elh_acting_type_ActingTypeDesc" class="acting_type_ActingTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $acting_type_list->ActingTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($acting_type_list->ActingTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($acting_type_list->ActingTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$acting_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($acting_type_list->ExportAll && $acting_type_list->isExport()) {
	$acting_type_list->StopRecord = $acting_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($acting_type_list->TotalRecords > $acting_type_list->StartRecord + $acting_type_list->DisplayRecords - 1)
		$acting_type_list->StopRecord = $acting_type_list->StartRecord + $acting_type_list->DisplayRecords - 1;
	else
		$acting_type_list->StopRecord = $acting_type_list->TotalRecords;
}
$acting_type_list->RecordCount = $acting_type_list->StartRecord - 1;
if ($acting_type_list->Recordset && !$acting_type_list->Recordset->EOF) {
	$acting_type_list->Recordset->moveFirst();
	$selectLimit = $acting_type_list->UseSelectLimit;
	if (!$selectLimit && $acting_type_list->StartRecord > 1)
		$acting_type_list->Recordset->move($acting_type_list->StartRecord - 1);
} elseif (!$acting_type->AllowAddDeleteRow && $acting_type_list->StopRecord == 0) {
	$acting_type_list->StopRecord = $acting_type->GridAddRowCount;
}

// Initialize aggregate
$acting_type->RowType = ROWTYPE_AGGREGATEINIT;
$acting_type->resetAttributes();
$acting_type_list->renderRow();
while ($acting_type_list->RecordCount < $acting_type_list->StopRecord) {
	$acting_type_list->RecordCount++;
	if ($acting_type_list->RecordCount >= $acting_type_list->StartRecord) {
		$acting_type_list->RowCount++;

		// Set up key count
		$acting_type_list->KeyCount = $acting_type_list->RowIndex;

		// Init row class and style
		$acting_type->resetAttributes();
		$acting_type->CssClass = "";
		if ($acting_type_list->isGridAdd()) {
		} else {
			$acting_type_list->loadRowValues($acting_type_list->Recordset); // Load row values
		}
		$acting_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$acting_type->RowAttrs->merge(["data-rowindex" => $acting_type_list->RowCount, "id" => "r" . $acting_type_list->RowCount . "_acting_type", "data-rowtype" => $acting_type->RowType]);

		// Render row
		$acting_type_list->renderRow();

		// Render list options
		$acting_type_list->renderListOptions();
?>
	<tr <?php echo $acting_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$acting_type_list->ListOptions->render("body", "left", $acting_type_list->RowCount);
?>
	<?php if ($acting_type_list->ActingType->Visible) { // ActingType ?>
		<td data-name="ActingType" <?php echo $acting_type_list->ActingType->cellAttributes() ?>>
<span id="el<?php echo $acting_type_list->RowCount ?>_acting_type_ActingType">
<span<?php echo $acting_type_list->ActingType->viewAttributes() ?>><?php echo $acting_type_list->ActingType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($acting_type_list->ActingTypeDesc->Visible) { // ActingTypeDesc ?>
		<td data-name="ActingTypeDesc" <?php echo $acting_type_list->ActingTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $acting_type_list->RowCount ?>_acting_type_ActingTypeDesc">
<span<?php echo $acting_type_list->ActingTypeDesc->viewAttributes() ?>><?php echo $acting_type_list->ActingTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$acting_type_list->ListOptions->render("body", "right", $acting_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$acting_type_list->isGridAdd())
		$acting_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$acting_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($acting_type_list->Recordset)
	$acting_type_list->Recordset->Close();
?>
<?php if (!$acting_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$acting_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $acting_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $acting_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($acting_type_list->TotalRecords == 0 && !$acting_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $acting_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$acting_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$acting_type_list->isExport()) { ?>
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
$acting_type_list->terminate();
?>