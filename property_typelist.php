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
$property_type_list = new property_type_list();

// Run the page
$property_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_type_list->isExport()) { ?>
<script>
var fproperty_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_typelist = currentForm = new ew.Form("fproperty_typelist", "list");
	fproperty_typelist.formKeyCountName = '<?php echo $property_type_list->FormKeyCountName ?>';
	loadjs.done("fproperty_typelist");
});
var fproperty_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_typelistsrch = currentSearchForm = new ew.Form("fproperty_typelistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_typelistsrch.filterList = <?php echo $property_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_typelistsrch.initSearchPanel = true;
	loadjs.done("fproperty_typelistsrch");
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
<?php if (!$property_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_type_list->TotalRecords > 0 && $property_type_list->ExportOptions->visible()) { ?>
<?php $property_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_type_list->ImportOptions->visible()) { ?>
<?php $property_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_type_list->SearchOptions->visible()) { ?>
<?php $property_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_type_list->FilterOptions->visible()) { ?>
<?php $property_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_type_list->isExport() && !$property_type->CurrentAction) { ?>
<form name="fproperty_typelistsrch" id="fproperty_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_typelistsrch-search-panel" class="<?php echo $property_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_type_list->showPageHeader(); ?>
<?php
$property_type_list->showMessage();
?>
<?php if ($property_type_list->TotalRecords > 0 || $property_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_type">
<?php if (!$property_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_typelist" id="fproperty_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_type">
<div id="gmp_property_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_type_list->TotalRecords > 0 || $property_type_list->isGridEdit()) { ?>
<table id="tbl_property_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_type->RowType = ROWTYPE_HEADER;

// Render list options
$property_type_list->renderListOptions();

// Render list options (header, left)
$property_type_list->ListOptions->render("header", "left");
?>
<?php if ($property_type_list->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property_type_list->SortUrl($property_type_list->PropertyType) == "") { ?>
		<th data-name="PropertyType" class="<?php echo $property_type_list->PropertyType->headerCellClass() ?>"><div id="elh_property_type_PropertyType" class="property_type_PropertyType"><div class="ew-table-header-caption"><?php echo $property_type_list->PropertyType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyType" class="<?php echo $property_type_list->PropertyType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_type_list->SortUrl($property_type_list->PropertyType) ?>', 1);"><div id="elh_property_type_PropertyType" class="property_type_PropertyType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_type_list->PropertyType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_type_list->PropertyType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_type_list->PropertyType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_type_list->PropertyTypeDesc->Visible) { // PropertyTypeDesc ?>
	<?php if ($property_type_list->SortUrl($property_type_list->PropertyTypeDesc) == "") { ?>
		<th data-name="PropertyTypeDesc" class="<?php echo $property_type_list->PropertyTypeDesc->headerCellClass() ?>"><div id="elh_property_type_PropertyTypeDesc" class="property_type_PropertyTypeDesc"><div class="ew-table-header-caption"><?php echo $property_type_list->PropertyTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyTypeDesc" class="<?php echo $property_type_list->PropertyTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_type_list->SortUrl($property_type_list->PropertyTypeDesc) ?>', 1);"><div id="elh_property_type_PropertyTypeDesc" class="property_type_PropertyTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_type_list->PropertyTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_type_list->PropertyTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_type_list->PropertyTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_type_list->ExportAll && $property_type_list->isExport()) {
	$property_type_list->StopRecord = $property_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_type_list->TotalRecords > $property_type_list->StartRecord + $property_type_list->DisplayRecords - 1)
		$property_type_list->StopRecord = $property_type_list->StartRecord + $property_type_list->DisplayRecords - 1;
	else
		$property_type_list->StopRecord = $property_type_list->TotalRecords;
}
$property_type_list->RecordCount = $property_type_list->StartRecord - 1;
if ($property_type_list->Recordset && !$property_type_list->Recordset->EOF) {
	$property_type_list->Recordset->moveFirst();
	$selectLimit = $property_type_list->UseSelectLimit;
	if (!$selectLimit && $property_type_list->StartRecord > 1)
		$property_type_list->Recordset->move($property_type_list->StartRecord - 1);
} elseif (!$property_type->AllowAddDeleteRow && $property_type_list->StopRecord == 0) {
	$property_type_list->StopRecord = $property_type->GridAddRowCount;
}

// Initialize aggregate
$property_type->RowType = ROWTYPE_AGGREGATEINIT;
$property_type->resetAttributes();
$property_type_list->renderRow();
while ($property_type_list->RecordCount < $property_type_list->StopRecord) {
	$property_type_list->RecordCount++;
	if ($property_type_list->RecordCount >= $property_type_list->StartRecord) {
		$property_type_list->RowCount++;

		// Set up key count
		$property_type_list->KeyCount = $property_type_list->RowIndex;

		// Init row class and style
		$property_type->resetAttributes();
		$property_type->CssClass = "";
		if ($property_type_list->isGridAdd()) {
		} else {
			$property_type_list->loadRowValues($property_type_list->Recordset); // Load row values
		}
		$property_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_type->RowAttrs->merge(["data-rowindex" => $property_type_list->RowCount, "id" => "r" . $property_type_list->RowCount . "_property_type", "data-rowtype" => $property_type->RowType]);

		// Render row
		$property_type_list->renderRow();

		// Render list options
		$property_type_list->renderListOptions();
?>
	<tr <?php echo $property_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_type_list->ListOptions->render("body", "left", $property_type_list->RowCount);
?>
	<?php if ($property_type_list->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType" <?php echo $property_type_list->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyType">
<span<?php echo $property_type_list->PropertyType->viewAttributes() ?>><?php echo $property_type_list->PropertyType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_type_list->PropertyTypeDesc->Visible) { // PropertyTypeDesc ?>
		<td data-name="PropertyTypeDesc" <?php echo $property_type_list->PropertyTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $property_type_list->RowCount ?>_property_type_PropertyTypeDesc">
<span<?php echo $property_type_list->PropertyTypeDesc->viewAttributes() ?>><?php echo $property_type_list->PropertyTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_type_list->ListOptions->render("body", "right", $property_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_type_list->isGridAdd())
		$property_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_type_list->Recordset)
	$property_type_list->Recordset->Close();
?>
<?php if (!$property_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_type_list->TotalRecords == 0 && !$property_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_type_list->isExport()) { ?>
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
$property_type_list->terminate();
?>