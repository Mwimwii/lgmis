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
$id_type_list = new id_type_list();

// Run the page
$id_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$id_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$id_type_list->isExport()) { ?>
<script>
var fid_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fid_typelist = currentForm = new ew.Form("fid_typelist", "list");
	fid_typelist.formKeyCountName = '<?php echo $id_type_list->FormKeyCountName ?>';
	loadjs.done("fid_typelist");
});
var fid_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fid_typelistsrch = currentSearchForm = new ew.Form("fid_typelistsrch");

	// Dynamic selection lists
	// Filters

	fid_typelistsrch.filterList = <?php echo $id_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fid_typelistsrch.initSearchPanel = true;
	loadjs.done("fid_typelistsrch");
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
<?php if (!$id_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($id_type_list->TotalRecords > 0 && $id_type_list->ExportOptions->visible()) { ?>
<?php $id_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($id_type_list->ImportOptions->visible()) { ?>
<?php $id_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($id_type_list->SearchOptions->visible()) { ?>
<?php $id_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($id_type_list->FilterOptions->visible()) { ?>
<?php $id_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$id_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$id_type_list->isExport() && !$id_type->CurrentAction) { ?>
<form name="fid_typelistsrch" id="fid_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fid_typelistsrch-search-panel" class="<?php echo $id_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="id_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $id_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($id_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($id_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $id_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($id_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($id_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($id_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($id_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $id_type_list->showPageHeader(); ?>
<?php
$id_type_list->showMessage();
?>
<?php if ($id_type_list->TotalRecords > 0 || $id_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($id_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> id_type">
<?php if (!$id_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$id_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $id_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $id_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fid_typelist" id="fid_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="id_type">
<div id="gmp_id_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($id_type_list->TotalRecords > 0 || $id_type_list->isGridEdit()) { ?>
<table id="tbl_id_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$id_type->RowType = ROWTYPE_HEADER;

// Render list options
$id_type_list->renderListOptions();

// Render list options (header, left)
$id_type_list->ListOptions->render("header", "left");
?>
<?php if ($id_type_list->IDType->Visible) { // IDType ?>
	<?php if ($id_type_list->SortUrl($id_type_list->IDType) == "") { ?>
		<th data-name="IDType" class="<?php echo $id_type_list->IDType->headerCellClass() ?>"><div id="elh_id_type_IDType" class="id_type_IDType"><div class="ew-table-header-caption"><?php echo $id_type_list->IDType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IDType" class="<?php echo $id_type_list->IDType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $id_type_list->SortUrl($id_type_list->IDType) ?>', 1);"><div id="elh_id_type_IDType" class="id_type_IDType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $id_type_list->IDType->caption() ?></span><span class="ew-table-header-sort"><?php if ($id_type_list->IDType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($id_type_list->IDType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($id_type_list->IDTypeName->Visible) { // IDTypeName ?>
	<?php if ($id_type_list->SortUrl($id_type_list->IDTypeName) == "") { ?>
		<th data-name="IDTypeName" class="<?php echo $id_type_list->IDTypeName->headerCellClass() ?>"><div id="elh_id_type_IDTypeName" class="id_type_IDTypeName"><div class="ew-table-header-caption"><?php echo $id_type_list->IDTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IDTypeName" class="<?php echo $id_type_list->IDTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $id_type_list->SortUrl($id_type_list->IDTypeName) ?>', 1);"><div id="elh_id_type_IDTypeName" class="id_type_IDTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $id_type_list->IDTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($id_type_list->IDTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($id_type_list->IDTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$id_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($id_type_list->ExportAll && $id_type_list->isExport()) {
	$id_type_list->StopRecord = $id_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($id_type_list->TotalRecords > $id_type_list->StartRecord + $id_type_list->DisplayRecords - 1)
		$id_type_list->StopRecord = $id_type_list->StartRecord + $id_type_list->DisplayRecords - 1;
	else
		$id_type_list->StopRecord = $id_type_list->TotalRecords;
}
$id_type_list->RecordCount = $id_type_list->StartRecord - 1;
if ($id_type_list->Recordset && !$id_type_list->Recordset->EOF) {
	$id_type_list->Recordset->moveFirst();
	$selectLimit = $id_type_list->UseSelectLimit;
	if (!$selectLimit && $id_type_list->StartRecord > 1)
		$id_type_list->Recordset->move($id_type_list->StartRecord - 1);
} elseif (!$id_type->AllowAddDeleteRow && $id_type_list->StopRecord == 0) {
	$id_type_list->StopRecord = $id_type->GridAddRowCount;
}

// Initialize aggregate
$id_type->RowType = ROWTYPE_AGGREGATEINIT;
$id_type->resetAttributes();
$id_type_list->renderRow();
while ($id_type_list->RecordCount < $id_type_list->StopRecord) {
	$id_type_list->RecordCount++;
	if ($id_type_list->RecordCount >= $id_type_list->StartRecord) {
		$id_type_list->RowCount++;

		// Set up key count
		$id_type_list->KeyCount = $id_type_list->RowIndex;

		// Init row class and style
		$id_type->resetAttributes();
		$id_type->CssClass = "";
		if ($id_type_list->isGridAdd()) {
		} else {
			$id_type_list->loadRowValues($id_type_list->Recordset); // Load row values
		}
		$id_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$id_type->RowAttrs->merge(["data-rowindex" => $id_type_list->RowCount, "id" => "r" . $id_type_list->RowCount . "_id_type", "data-rowtype" => $id_type->RowType]);

		// Render row
		$id_type_list->renderRow();

		// Render list options
		$id_type_list->renderListOptions();
?>
	<tr <?php echo $id_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$id_type_list->ListOptions->render("body", "left", $id_type_list->RowCount);
?>
	<?php if ($id_type_list->IDType->Visible) { // IDType ?>
		<td data-name="IDType" <?php echo $id_type_list->IDType->cellAttributes() ?>>
<span id="el<?php echo $id_type_list->RowCount ?>_id_type_IDType">
<span<?php echo $id_type_list->IDType->viewAttributes() ?>><?php echo $id_type_list->IDType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($id_type_list->IDTypeName->Visible) { // IDTypeName ?>
		<td data-name="IDTypeName" <?php echo $id_type_list->IDTypeName->cellAttributes() ?>>
<span id="el<?php echo $id_type_list->RowCount ?>_id_type_IDTypeName">
<span<?php echo $id_type_list->IDTypeName->viewAttributes() ?>><?php echo $id_type_list->IDTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$id_type_list->ListOptions->render("body", "right", $id_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$id_type_list->isGridAdd())
		$id_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$id_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($id_type_list->Recordset)
	$id_type_list->Recordset->Close();
?>
<?php if (!$id_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$id_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $id_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $id_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($id_type_list->TotalRecords == 0 && !$id_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $id_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$id_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$id_type_list->isExport()) { ?>
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
$id_type_list->terminate();
?>