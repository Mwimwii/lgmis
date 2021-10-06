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
$equipment_type_list = new equipment_type_list();

// Run the page
$equipment_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$equipment_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$equipment_type_list->isExport()) { ?>
<script>
var fequipment_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fequipment_typelist = currentForm = new ew.Form("fequipment_typelist", "list");
	fequipment_typelist.formKeyCountName = '<?php echo $equipment_type_list->FormKeyCountName ?>';
	loadjs.done("fequipment_typelist");
});
var fequipment_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fequipment_typelistsrch = currentSearchForm = new ew.Form("fequipment_typelistsrch");

	// Dynamic selection lists
	// Filters

	fequipment_typelistsrch.filterList = <?php echo $equipment_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fequipment_typelistsrch.initSearchPanel = true;
	loadjs.done("fequipment_typelistsrch");
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
<?php if (!$equipment_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($equipment_type_list->TotalRecords > 0 && $equipment_type_list->ExportOptions->visible()) { ?>
<?php $equipment_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($equipment_type_list->ImportOptions->visible()) { ?>
<?php $equipment_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($equipment_type_list->SearchOptions->visible()) { ?>
<?php $equipment_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($equipment_type_list->FilterOptions->visible()) { ?>
<?php $equipment_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$equipment_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$equipment_type_list->isExport() && !$equipment_type->CurrentAction) { ?>
<form name="fequipment_typelistsrch" id="fequipment_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fequipment_typelistsrch-search-panel" class="<?php echo $equipment_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="equipment_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $equipment_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($equipment_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($equipment_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $equipment_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($equipment_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($equipment_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($equipment_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($equipment_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $equipment_type_list->showPageHeader(); ?>
<?php
$equipment_type_list->showMessage();
?>
<?php if ($equipment_type_list->TotalRecords > 0 || $equipment_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($equipment_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> equipment_type">
<?php if (!$equipment_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$equipment_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $equipment_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $equipment_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fequipment_typelist" id="fequipment_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="equipment_type">
<div id="gmp_equipment_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($equipment_type_list->TotalRecords > 0 || $equipment_type_list->isGridEdit()) { ?>
<table id="tbl_equipment_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$equipment_type->RowType = ROWTYPE_HEADER;

// Render list options
$equipment_type_list->renderListOptions();

// Render list options (header, left)
$equipment_type_list->ListOptions->render("header", "left");
?>
<?php if ($equipment_type_list->EquipmentType->Visible) { // EquipmentType ?>
	<?php if ($equipment_type_list->SortUrl($equipment_type_list->EquipmentType) == "") { ?>
		<th data-name="EquipmentType" class="<?php echo $equipment_type_list->EquipmentType->headerCellClass() ?>"><div id="elh_equipment_type_EquipmentType" class="equipment_type_EquipmentType"><div class="ew-table-header-caption"><?php echo $equipment_type_list->EquipmentType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EquipmentType" class="<?php echo $equipment_type_list->EquipmentType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $equipment_type_list->SortUrl($equipment_type_list->EquipmentType) ?>', 1);"><div id="elh_equipment_type_EquipmentType" class="equipment_type_EquipmentType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $equipment_type_list->EquipmentType->caption() ?></span><span class="ew-table-header-sort"><?php if ($equipment_type_list->EquipmentType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($equipment_type_list->EquipmentType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($equipment_type_list->EquipmentName->Visible) { // EquipmentName ?>
	<?php if ($equipment_type_list->SortUrl($equipment_type_list->EquipmentName) == "") { ?>
		<th data-name="EquipmentName" class="<?php echo $equipment_type_list->EquipmentName->headerCellClass() ?>"><div id="elh_equipment_type_EquipmentName" class="equipment_type_EquipmentName"><div class="ew-table-header-caption"><?php echo $equipment_type_list->EquipmentName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EquipmentName" class="<?php echo $equipment_type_list->EquipmentName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $equipment_type_list->SortUrl($equipment_type_list->EquipmentName) ?>', 1);"><div id="elh_equipment_type_EquipmentName" class="equipment_type_EquipmentName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $equipment_type_list->EquipmentName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($equipment_type_list->EquipmentName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($equipment_type_list->EquipmentName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($equipment_type_list->EquipmentDesc->Visible) { // EquipmentDesc ?>
	<?php if ($equipment_type_list->SortUrl($equipment_type_list->EquipmentDesc) == "") { ?>
		<th data-name="EquipmentDesc" class="<?php echo $equipment_type_list->EquipmentDesc->headerCellClass() ?>"><div id="elh_equipment_type_EquipmentDesc" class="equipment_type_EquipmentDesc"><div class="ew-table-header-caption"><?php echo $equipment_type_list->EquipmentDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EquipmentDesc" class="<?php echo $equipment_type_list->EquipmentDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $equipment_type_list->SortUrl($equipment_type_list->EquipmentDesc) ?>', 1);"><div id="elh_equipment_type_EquipmentDesc" class="equipment_type_EquipmentDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $equipment_type_list->EquipmentDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($equipment_type_list->EquipmentDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($equipment_type_list->EquipmentDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$equipment_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($equipment_type_list->ExportAll && $equipment_type_list->isExport()) {
	$equipment_type_list->StopRecord = $equipment_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($equipment_type_list->TotalRecords > $equipment_type_list->StartRecord + $equipment_type_list->DisplayRecords - 1)
		$equipment_type_list->StopRecord = $equipment_type_list->StartRecord + $equipment_type_list->DisplayRecords - 1;
	else
		$equipment_type_list->StopRecord = $equipment_type_list->TotalRecords;
}
$equipment_type_list->RecordCount = $equipment_type_list->StartRecord - 1;
if ($equipment_type_list->Recordset && !$equipment_type_list->Recordset->EOF) {
	$equipment_type_list->Recordset->moveFirst();
	$selectLimit = $equipment_type_list->UseSelectLimit;
	if (!$selectLimit && $equipment_type_list->StartRecord > 1)
		$equipment_type_list->Recordset->move($equipment_type_list->StartRecord - 1);
} elseif (!$equipment_type->AllowAddDeleteRow && $equipment_type_list->StopRecord == 0) {
	$equipment_type_list->StopRecord = $equipment_type->GridAddRowCount;
}

// Initialize aggregate
$equipment_type->RowType = ROWTYPE_AGGREGATEINIT;
$equipment_type->resetAttributes();
$equipment_type_list->renderRow();
while ($equipment_type_list->RecordCount < $equipment_type_list->StopRecord) {
	$equipment_type_list->RecordCount++;
	if ($equipment_type_list->RecordCount >= $equipment_type_list->StartRecord) {
		$equipment_type_list->RowCount++;

		// Set up key count
		$equipment_type_list->KeyCount = $equipment_type_list->RowIndex;

		// Init row class and style
		$equipment_type->resetAttributes();
		$equipment_type->CssClass = "";
		if ($equipment_type_list->isGridAdd()) {
		} else {
			$equipment_type_list->loadRowValues($equipment_type_list->Recordset); // Load row values
		}
		$equipment_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$equipment_type->RowAttrs->merge(["data-rowindex" => $equipment_type_list->RowCount, "id" => "r" . $equipment_type_list->RowCount . "_equipment_type", "data-rowtype" => $equipment_type->RowType]);

		// Render row
		$equipment_type_list->renderRow();

		// Render list options
		$equipment_type_list->renderListOptions();
?>
	<tr <?php echo $equipment_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$equipment_type_list->ListOptions->render("body", "left", $equipment_type_list->RowCount);
?>
	<?php if ($equipment_type_list->EquipmentType->Visible) { // EquipmentType ?>
		<td data-name="EquipmentType" <?php echo $equipment_type_list->EquipmentType->cellAttributes() ?>>
<span id="el<?php echo $equipment_type_list->RowCount ?>_equipment_type_EquipmentType">
<span<?php echo $equipment_type_list->EquipmentType->viewAttributes() ?>><?php echo $equipment_type_list->EquipmentType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($equipment_type_list->EquipmentName->Visible) { // EquipmentName ?>
		<td data-name="EquipmentName" <?php echo $equipment_type_list->EquipmentName->cellAttributes() ?>>
<span id="el<?php echo $equipment_type_list->RowCount ?>_equipment_type_EquipmentName">
<span<?php echo $equipment_type_list->EquipmentName->viewAttributes() ?>><?php echo $equipment_type_list->EquipmentName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($equipment_type_list->EquipmentDesc->Visible) { // EquipmentDesc ?>
		<td data-name="EquipmentDesc" <?php echo $equipment_type_list->EquipmentDesc->cellAttributes() ?>>
<span id="el<?php echo $equipment_type_list->RowCount ?>_equipment_type_EquipmentDesc">
<span<?php echo $equipment_type_list->EquipmentDesc->viewAttributes() ?>><?php echo $equipment_type_list->EquipmentDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$equipment_type_list->ListOptions->render("body", "right", $equipment_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$equipment_type_list->isGridAdd())
		$equipment_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$equipment_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($equipment_type_list->Recordset)
	$equipment_type_list->Recordset->Close();
?>
<?php if (!$equipment_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$equipment_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $equipment_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $equipment_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($equipment_type_list->TotalRecords == 0 && !$equipment_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $equipment_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$equipment_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$equipment_type_list->isExport()) { ?>
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
$equipment_type_list->terminate();
?>