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
$contractor_type_list = new contractor_type_list();

// Run the page
$contractor_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contractor_type_list->isExport()) { ?>
<script>
var fcontractor_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontractor_typelist = currentForm = new ew.Form("fcontractor_typelist", "list");
	fcontractor_typelist.formKeyCountName = '<?php echo $contractor_type_list->FormKeyCountName ?>';
	loadjs.done("fcontractor_typelist");
});
var fcontractor_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontractor_typelistsrch = currentSearchForm = new ew.Form("fcontractor_typelistsrch");

	// Dynamic selection lists
	// Filters

	fcontractor_typelistsrch.filterList = <?php echo $contractor_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcontractor_typelistsrch.initSearchPanel = true;
	loadjs.done("fcontractor_typelistsrch");
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
<?php if (!$contractor_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contractor_type_list->TotalRecords > 0 && $contractor_type_list->ExportOptions->visible()) { ?>
<?php $contractor_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contractor_type_list->ImportOptions->visible()) { ?>
<?php $contractor_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contractor_type_list->SearchOptions->visible()) { ?>
<?php $contractor_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contractor_type_list->FilterOptions->visible()) { ?>
<?php $contractor_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contractor_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contractor_type_list->isExport() && !$contractor_type->CurrentAction) { ?>
<form name="fcontractor_typelistsrch" id="fcontractor_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontractor_typelistsrch-search-panel" class="<?php echo $contractor_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contractor_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $contractor_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contractor_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contractor_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contractor_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contractor_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contractor_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contractor_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contractor_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contractor_type_list->showPageHeader(); ?>
<?php
$contractor_type_list->showMessage();
?>
<?php if ($contractor_type_list->TotalRecords > 0 || $contractor_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contractor_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contractor_type">
<?php if (!$contractor_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contractor_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contractor_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontractor_typelist" id="fcontractor_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor_type">
<div id="gmp_contractor_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contractor_type_list->TotalRecords > 0 || $contractor_type_list->isGridEdit()) { ?>
<table id="tbl_contractor_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contractor_type->RowType = ROWTYPE_HEADER;

// Render list options
$contractor_type_list->renderListOptions();

// Render list options (header, left)
$contractor_type_list->ListOptions->render("header", "left");
?>
<?php if ($contractor_type_list->ContractorTypeCode->Visible) { // ContractorTypeCode ?>
	<?php if ($contractor_type_list->SortUrl($contractor_type_list->ContractorTypeCode) == "") { ?>
		<th data-name="ContractorTypeCode" class="<?php echo $contractor_type_list->ContractorTypeCode->headerCellClass() ?>"><div id="elh_contractor_type_ContractorTypeCode" class="contractor_type_ContractorTypeCode"><div class="ew-table-header-caption"><?php echo $contractor_type_list->ContractorTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractorTypeCode" class="<?php echo $contractor_type_list->ContractorTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_type_list->SortUrl($contractor_type_list->ContractorTypeCode) ?>', 1);"><div id="elh_contractor_type_ContractorTypeCode" class="contractor_type_ContractorTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_type_list->ContractorTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_type_list->ContractorTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_type_list->ContractorTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_type_list->ContractortypeName->Visible) { // ContractortypeName ?>
	<?php if ($contractor_type_list->SortUrl($contractor_type_list->ContractortypeName) == "") { ?>
		<th data-name="ContractortypeName" class="<?php echo $contractor_type_list->ContractortypeName->headerCellClass() ?>"><div id="elh_contractor_type_ContractortypeName" class="contractor_type_ContractortypeName"><div class="ew-table-header-caption"><?php echo $contractor_type_list->ContractortypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractortypeName" class="<?php echo $contractor_type_list->ContractortypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_type_list->SortUrl($contractor_type_list->ContractortypeName) ?>', 1);"><div id="elh_contractor_type_ContractortypeName" class="contractor_type_ContractortypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_type_list->ContractortypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_type_list->ContractortypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_type_list->ContractortypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_type_list->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
	<?php if ($contractor_type_list->SortUrl($contractor_type_list->ContractorTypeDesc) == "") { ?>
		<th data-name="ContractorTypeDesc" class="<?php echo $contractor_type_list->ContractorTypeDesc->headerCellClass() ?>"><div id="elh_contractor_type_ContractorTypeDesc" class="contractor_type_ContractorTypeDesc"><div class="ew-table-header-caption"><?php echo $contractor_type_list->ContractorTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractorTypeDesc" class="<?php echo $contractor_type_list->ContractorTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_type_list->SortUrl($contractor_type_list->ContractorTypeDesc) ?>', 1);"><div id="elh_contractor_type_ContractorTypeDesc" class="contractor_type_ContractorTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_type_list->ContractorTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_type_list->ContractorTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_type_list->ContractorTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contractor_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contractor_type_list->ExportAll && $contractor_type_list->isExport()) {
	$contractor_type_list->StopRecord = $contractor_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contractor_type_list->TotalRecords > $contractor_type_list->StartRecord + $contractor_type_list->DisplayRecords - 1)
		$contractor_type_list->StopRecord = $contractor_type_list->StartRecord + $contractor_type_list->DisplayRecords - 1;
	else
		$contractor_type_list->StopRecord = $contractor_type_list->TotalRecords;
}
$contractor_type_list->RecordCount = $contractor_type_list->StartRecord - 1;
if ($contractor_type_list->Recordset && !$contractor_type_list->Recordset->EOF) {
	$contractor_type_list->Recordset->moveFirst();
	$selectLimit = $contractor_type_list->UseSelectLimit;
	if (!$selectLimit && $contractor_type_list->StartRecord > 1)
		$contractor_type_list->Recordset->move($contractor_type_list->StartRecord - 1);
} elseif (!$contractor_type->AllowAddDeleteRow && $contractor_type_list->StopRecord == 0) {
	$contractor_type_list->StopRecord = $contractor_type->GridAddRowCount;
}

// Initialize aggregate
$contractor_type->RowType = ROWTYPE_AGGREGATEINIT;
$contractor_type->resetAttributes();
$contractor_type_list->renderRow();
while ($contractor_type_list->RecordCount < $contractor_type_list->StopRecord) {
	$contractor_type_list->RecordCount++;
	if ($contractor_type_list->RecordCount >= $contractor_type_list->StartRecord) {
		$contractor_type_list->RowCount++;

		// Set up key count
		$contractor_type_list->KeyCount = $contractor_type_list->RowIndex;

		// Init row class and style
		$contractor_type->resetAttributes();
		$contractor_type->CssClass = "";
		if ($contractor_type_list->isGridAdd()) {
		} else {
			$contractor_type_list->loadRowValues($contractor_type_list->Recordset); // Load row values
		}
		$contractor_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contractor_type->RowAttrs->merge(["data-rowindex" => $contractor_type_list->RowCount, "id" => "r" . $contractor_type_list->RowCount . "_contractor_type", "data-rowtype" => $contractor_type->RowType]);

		// Render row
		$contractor_type_list->renderRow();

		// Render list options
		$contractor_type_list->renderListOptions();
?>
	<tr <?php echo $contractor_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contractor_type_list->ListOptions->render("body", "left", $contractor_type_list->RowCount);
?>
	<?php if ($contractor_type_list->ContractorTypeCode->Visible) { // ContractorTypeCode ?>
		<td data-name="ContractorTypeCode" <?php echo $contractor_type_list->ContractorTypeCode->cellAttributes() ?>>
<span id="el<?php echo $contractor_type_list->RowCount ?>_contractor_type_ContractorTypeCode">
<span<?php echo $contractor_type_list->ContractorTypeCode->viewAttributes() ?>><?php echo $contractor_type_list->ContractorTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_type_list->ContractortypeName->Visible) { // ContractortypeName ?>
		<td data-name="ContractortypeName" <?php echo $contractor_type_list->ContractortypeName->cellAttributes() ?>>
<span id="el<?php echo $contractor_type_list->RowCount ?>_contractor_type_ContractortypeName">
<span<?php echo $contractor_type_list->ContractortypeName->viewAttributes() ?>><?php echo $contractor_type_list->ContractortypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_type_list->ContractorTypeDesc->Visible) { // ContractorTypeDesc ?>
		<td data-name="ContractorTypeDesc" <?php echo $contractor_type_list->ContractorTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $contractor_type_list->RowCount ?>_contractor_type_ContractorTypeDesc">
<span<?php echo $contractor_type_list->ContractorTypeDesc->viewAttributes() ?>><?php echo $contractor_type_list->ContractorTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contractor_type_list->ListOptions->render("body", "right", $contractor_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$contractor_type_list->isGridAdd())
		$contractor_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$contractor_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contractor_type_list->Recordset)
	$contractor_type_list->Recordset->Close();
?>
<?php if (!$contractor_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contractor_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contractor_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contractor_type_list->TotalRecords == 0 && !$contractor_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contractor_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contractor_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contractor_type_list->isExport()) { ?>
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
$contractor_type_list->terminate();
?>