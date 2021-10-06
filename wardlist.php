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
$ward_list = new ward_list();

// Run the page
$ward_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ward_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ward_list->isExport()) { ?>
<script>
var fwardlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fwardlist = currentForm = new ew.Form("fwardlist", "list");
	fwardlist.formKeyCountName = '<?php echo $ward_list->FormKeyCountName ?>';
	loadjs.done("fwardlist");
});
var fwardlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fwardlistsrch = currentSearchForm = new ew.Form("fwardlistsrch");

	// Dynamic selection lists
	// Filters

	fwardlistsrch.filterList = <?php echo $ward_list->getFilterList() ?>;

	// Init search panel as collapsed
	fwardlistsrch.initSearchPanel = true;
	loadjs.done("fwardlistsrch");
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
<?php if (!$ward_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ward_list->TotalRecords > 0 && $ward_list->ExportOptions->visible()) { ?>
<?php $ward_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ward_list->ImportOptions->visible()) { ?>
<?php $ward_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ward_list->SearchOptions->visible()) { ?>
<?php $ward_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ward_list->FilterOptions->visible()) { ?>
<?php $ward_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ward_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ward_list->isExport("print")) { ?>
<?php
if ($ward_list->DbMasterFilter != "" && $ward->getCurrentMasterTable() == "local_authority") {
	if ($ward_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$ward_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ward_list->isExport() && !$ward->CurrentAction) { ?>
<form name="fwardlistsrch" id="fwardlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fwardlistsrch-search-panel" class="<?php echo $ward_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ward">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ward_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ward_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ward_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ward_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ward_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ward_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ward_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ward_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ward_list->showPageHeader(); ?>
<?php
$ward_list->showMessage();
?>
<?php if ($ward_list->TotalRecords > 0 || $ward->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ward_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ward">
<?php if (!$ward_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ward_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ward_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ward_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fwardlist" id="fwardlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ward">
<?php if ($ward->getCurrentMasterTable() == "local_authority" && $ward->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($ward_list->ProvinceCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($ward_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ward" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ward_list->TotalRecords > 0 || $ward_list->isGridEdit()) { ?>
<table id="tbl_wardlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ward->RowType = ROWTYPE_HEADER;

// Render list options
$ward_list->renderListOptions();

// Render list options (header, left)
$ward_list->ListOptions->render("header", "left");
?>
<?php if ($ward_list->LACode->Visible) { // LACode ?>
	<?php if ($ward_list->SortUrl($ward_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $ward_list->LACode->headerCellClass() ?>"><div id="elh_ward_LACode" class="ward_LACode"><div class="ew-table-header-caption"><?php echo $ward_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $ward_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ward_list->SortUrl($ward_list->LACode) ?>', 1);"><div id="elh_ward_LACode" class="ward_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ward_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($ward_list->SortUrl($ward_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $ward_list->ProvinceCode->headerCellClass() ?>"><div id="elh_ward_ProvinceCode" class="ward_ProvinceCode"><div class="ew-table-header-caption"><?php echo $ward_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $ward_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ward_list->SortUrl($ward_list->ProvinceCode) ?>', 1);"><div id="elh_ward_ProvinceCode" class="ward_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_list->WardCode->Visible) { // WardCode ?>
	<?php if ($ward_list->SortUrl($ward_list->WardCode) == "") { ?>
		<th data-name="WardCode" class="<?php echo $ward_list->WardCode->headerCellClass() ?>"><div id="elh_ward_WardCode" class="ward_WardCode"><div class="ew-table-header-caption"><?php echo $ward_list->WardCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WardCode" class="<?php echo $ward_list->WardCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ward_list->SortUrl($ward_list->WardCode) ?>', 1);"><div id="elh_ward_WardCode" class="ward_WardCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_list->WardCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_list->WardCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_list->WardCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_list->WardName->Visible) { // WardName ?>
	<?php if ($ward_list->SortUrl($ward_list->WardName) == "") { ?>
		<th data-name="WardName" class="<?php echo $ward_list->WardName->headerCellClass() ?>"><div id="elh_ward_WardName" class="ward_WardName"><div class="ew-table-header-caption"><?php echo $ward_list->WardName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="WardName" class="<?php echo $ward_list->WardName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ward_list->SortUrl($ward_list->WardName) ?>', 1);"><div id="elh_ward_WardName" class="ward_WardName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_list->WardName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ward_list->WardName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_list->WardName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_list->Population->Visible) { // Population ?>
	<?php if ($ward_list->SortUrl($ward_list->Population) == "") { ?>
		<th data-name="Population" class="<?php echo $ward_list->Population->headerCellClass() ?>"><div id="elh_ward_Population" class="ward_Population"><div class="ew-table-header-caption"><?php echo $ward_list->Population->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Population" class="<?php echo $ward_list->Population->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ward_list->SortUrl($ward_list->Population) ?>', 1);"><div id="elh_ward_Population" class="ward_Population">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_list->Population->caption() ?></span><span class="ew-table-header-sort"><?php if ($ward_list->Population->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_list->Population->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ward_list->Areas->Visible) { // Areas ?>
	<?php if ($ward_list->SortUrl($ward_list->Areas) == "") { ?>
		<th data-name="Areas" class="<?php echo $ward_list->Areas->headerCellClass() ?>"><div id="elh_ward_Areas" class="ward_Areas"><div class="ew-table-header-caption"><?php echo $ward_list->Areas->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Areas" class="<?php echo $ward_list->Areas->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ward_list->SortUrl($ward_list->Areas) ?>', 1);"><div id="elh_ward_Areas" class="ward_Areas">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ward_list->Areas->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ward_list->Areas->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ward_list->Areas->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ward_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ward_list->ExportAll && $ward_list->isExport()) {
	$ward_list->StopRecord = $ward_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ward_list->TotalRecords > $ward_list->StartRecord + $ward_list->DisplayRecords - 1)
		$ward_list->StopRecord = $ward_list->StartRecord + $ward_list->DisplayRecords - 1;
	else
		$ward_list->StopRecord = $ward_list->TotalRecords;
}
$ward_list->RecordCount = $ward_list->StartRecord - 1;
if ($ward_list->Recordset && !$ward_list->Recordset->EOF) {
	$ward_list->Recordset->moveFirst();
	$selectLimit = $ward_list->UseSelectLimit;
	if (!$selectLimit && $ward_list->StartRecord > 1)
		$ward_list->Recordset->move($ward_list->StartRecord - 1);
} elseif (!$ward->AllowAddDeleteRow && $ward_list->StopRecord == 0) {
	$ward_list->StopRecord = $ward->GridAddRowCount;
}

// Initialize aggregate
$ward->RowType = ROWTYPE_AGGREGATEINIT;
$ward->resetAttributes();
$ward_list->renderRow();
while ($ward_list->RecordCount < $ward_list->StopRecord) {
	$ward_list->RecordCount++;
	if ($ward_list->RecordCount >= $ward_list->StartRecord) {
		$ward_list->RowCount++;

		// Set up key count
		$ward_list->KeyCount = $ward_list->RowIndex;

		// Init row class and style
		$ward->resetAttributes();
		$ward->CssClass = "";
		if ($ward_list->isGridAdd()) {
		} else {
			$ward_list->loadRowValues($ward_list->Recordset); // Load row values
		}
		$ward->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ward->RowAttrs->merge(["data-rowindex" => $ward_list->RowCount, "id" => "r" . $ward_list->RowCount . "_ward", "data-rowtype" => $ward->RowType]);

		// Render row
		$ward_list->renderRow();

		// Render list options
		$ward_list->renderListOptions();
?>
	<tr <?php echo $ward->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ward_list->ListOptions->render("body", "left", $ward_list->RowCount);
?>
	<?php if ($ward_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $ward_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $ward_list->RowCount ?>_ward_LACode">
<span<?php echo $ward_list->LACode->viewAttributes() ?>><?php echo $ward_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ward_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $ward_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $ward_list->RowCount ?>_ward_ProvinceCode">
<span<?php echo $ward_list->ProvinceCode->viewAttributes() ?>><?php echo $ward_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ward_list->WardCode->Visible) { // WardCode ?>
		<td data-name="WardCode" <?php echo $ward_list->WardCode->cellAttributes() ?>>
<span id="el<?php echo $ward_list->RowCount ?>_ward_WardCode">
<span<?php echo $ward_list->WardCode->viewAttributes() ?>><?php echo $ward_list->WardCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ward_list->WardName->Visible) { // WardName ?>
		<td data-name="WardName" <?php echo $ward_list->WardName->cellAttributes() ?>>
<span id="el<?php echo $ward_list->RowCount ?>_ward_WardName">
<span<?php echo $ward_list->WardName->viewAttributes() ?>><?php echo $ward_list->WardName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ward_list->Population->Visible) { // Population ?>
		<td data-name="Population" <?php echo $ward_list->Population->cellAttributes() ?>>
<span id="el<?php echo $ward_list->RowCount ?>_ward_Population">
<span<?php echo $ward_list->Population->viewAttributes() ?>><?php echo $ward_list->Population->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ward_list->Areas->Visible) { // Areas ?>
		<td data-name="Areas" <?php echo $ward_list->Areas->cellAttributes() ?>>
<span id="el<?php echo $ward_list->RowCount ?>_ward_Areas">
<span<?php echo $ward_list->Areas->viewAttributes() ?>><?php echo $ward_list->Areas->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ward_list->ListOptions->render("body", "right", $ward_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ward_list->isGridAdd())
		$ward_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ward->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ward_list->Recordset)
	$ward_list->Recordset->Close();
?>
<?php if (!$ward_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ward_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ward_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ward_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ward_list->TotalRecords == 0 && !$ward->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ward_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ward_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ward_list->isExport()) { ?>
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
$ward_list->terminate();
?>