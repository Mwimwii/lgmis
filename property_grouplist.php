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
$property_group_list = new property_group_list();

// Run the page
$property_group_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_group_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_group_list->isExport()) { ?>
<script>
var fproperty_grouplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_grouplist = currentForm = new ew.Form("fproperty_grouplist", "list");
	fproperty_grouplist.formKeyCountName = '<?php echo $property_group_list->FormKeyCountName ?>';
	loadjs.done("fproperty_grouplist");
});
var fproperty_grouplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_grouplistsrch = currentSearchForm = new ew.Form("fproperty_grouplistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_grouplistsrch.filterList = <?php echo $property_group_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_grouplistsrch.initSearchPanel = true;
	loadjs.done("fproperty_grouplistsrch");
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
<?php if (!$property_group_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_group_list->TotalRecords > 0 && $property_group_list->ExportOptions->visible()) { ?>
<?php $property_group_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_group_list->ImportOptions->visible()) { ?>
<?php $property_group_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_group_list->SearchOptions->visible()) { ?>
<?php $property_group_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_group_list->FilterOptions->visible()) { ?>
<?php $property_group_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_group_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_group_list->isExport() && !$property_group->CurrentAction) { ?>
<form name="fproperty_grouplistsrch" id="fproperty_grouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_grouplistsrch-search-panel" class="<?php echo $property_group_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_group">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_group_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_group_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_group_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_group_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_group_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_group_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_group_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_group_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_group_list->showPageHeader(); ?>
<?php
$property_group_list->showMessage();
?>
<?php if ($property_group_list->TotalRecords > 0 || $property_group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_group_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_group">
<?php if (!$property_group_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_grouplist" id="fproperty_grouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_group">
<div id="gmp_property_group" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_group_list->TotalRecords > 0 || $property_group_list->isGridEdit()) { ?>
<table id="tbl_property_grouplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_group->RowType = ROWTYPE_HEADER;

// Render list options
$property_group_list->renderListOptions();

// Render list options (header, left)
$property_group_list->ListOptions->render("header", "left");
?>
<?php if ($property_group_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($property_group_list->SortUrl($property_group_list->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_group_list->PropertyGroup->headerCellClass() ?>"><div id="elh_property_group_PropertyGroup" class="property_group_PropertyGroup"><div class="ew-table-header-caption"><?php echo $property_group_list->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_group_list->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_group_list->SortUrl($property_group_list->PropertyGroup) ?>', 1);"><div id="elh_property_group_PropertyGroup" class="property_group_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_group_list->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_group_list->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_group_list->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_group_list->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
	<?php if ($property_group_list->SortUrl($property_group_list->PropertyGroupDesc) == "") { ?>
		<th data-name="PropertyGroupDesc" class="<?php echo $property_group_list->PropertyGroupDesc->headerCellClass() ?>"><div id="elh_property_group_PropertyGroupDesc" class="property_group_PropertyGroupDesc"><div class="ew-table-header-caption"><?php echo $property_group_list->PropertyGroupDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroupDesc" class="<?php echo $property_group_list->PropertyGroupDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_group_list->SortUrl($property_group_list->PropertyGroupDesc) ?>', 1);"><div id="elh_property_group_PropertyGroupDesc" class="property_group_PropertyGroupDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_group_list->PropertyGroupDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_group_list->PropertyGroupDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_group_list->PropertyGroupDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_group_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_group_list->ExportAll && $property_group_list->isExport()) {
	$property_group_list->StopRecord = $property_group_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_group_list->TotalRecords > $property_group_list->StartRecord + $property_group_list->DisplayRecords - 1)
		$property_group_list->StopRecord = $property_group_list->StartRecord + $property_group_list->DisplayRecords - 1;
	else
		$property_group_list->StopRecord = $property_group_list->TotalRecords;
}
$property_group_list->RecordCount = $property_group_list->StartRecord - 1;
if ($property_group_list->Recordset && !$property_group_list->Recordset->EOF) {
	$property_group_list->Recordset->moveFirst();
	$selectLimit = $property_group_list->UseSelectLimit;
	if (!$selectLimit && $property_group_list->StartRecord > 1)
		$property_group_list->Recordset->move($property_group_list->StartRecord - 1);
} elseif (!$property_group->AllowAddDeleteRow && $property_group_list->StopRecord == 0) {
	$property_group_list->StopRecord = $property_group->GridAddRowCount;
}

// Initialize aggregate
$property_group->RowType = ROWTYPE_AGGREGATEINIT;
$property_group->resetAttributes();
$property_group_list->renderRow();
while ($property_group_list->RecordCount < $property_group_list->StopRecord) {
	$property_group_list->RecordCount++;
	if ($property_group_list->RecordCount >= $property_group_list->StartRecord) {
		$property_group_list->RowCount++;

		// Set up key count
		$property_group_list->KeyCount = $property_group_list->RowIndex;

		// Init row class and style
		$property_group->resetAttributes();
		$property_group->CssClass = "";
		if ($property_group_list->isGridAdd()) {
		} else {
			$property_group_list->loadRowValues($property_group_list->Recordset); // Load row values
		}
		$property_group->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_group->RowAttrs->merge(["data-rowindex" => $property_group_list->RowCount, "id" => "r" . $property_group_list->RowCount . "_property_group", "data-rowtype" => $property_group->RowType]);

		// Render row
		$property_group_list->renderRow();

		// Render list options
		$property_group_list->renderListOptions();
?>
	<tr <?php echo $property_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_group_list->ListOptions->render("body", "left", $property_group_list->RowCount);
?>
	<?php if ($property_group_list->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $property_group_list->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_group_list->RowCount ?>_property_group_PropertyGroup">
<span<?php echo $property_group_list->PropertyGroup->viewAttributes() ?>><?php echo $property_group_list->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_group_list->PropertyGroupDesc->Visible) { // PropertyGroupDesc ?>
		<td data-name="PropertyGroupDesc" <?php echo $property_group_list->PropertyGroupDesc->cellAttributes() ?>>
<span id="el<?php echo $property_group_list->RowCount ?>_property_group_PropertyGroupDesc">
<span<?php echo $property_group_list->PropertyGroupDesc->viewAttributes() ?>><?php echo $property_group_list->PropertyGroupDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_group_list->ListOptions->render("body", "right", $property_group_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_group_list->isGridAdd())
		$property_group_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_group->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_group_list->Recordset)
	$property_group_list->Recordset->Close();
?>
<?php if (!$property_group_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_group_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_group_list->TotalRecords == 0 && !$property_group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_group_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_group_list->isExport()) { ?>
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
$property_group_list->terminate();
?>