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
$basic_salaries_list = new basic_salaries_list();

// Run the page
$basic_salaries_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$basic_salaries_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$basic_salaries_list->isExport()) { ?>
<script>
var fbasic_salarieslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbasic_salarieslist = currentForm = new ew.Form("fbasic_salarieslist", "list");
	fbasic_salarieslist.formKeyCountName = '<?php echo $basic_salaries_list->FormKeyCountName ?>';
	loadjs.done("fbasic_salarieslist");
});
var fbasic_salarieslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbasic_salarieslistsrch = currentSearchForm = new ew.Form("fbasic_salarieslistsrch");

	// Dynamic selection lists
	// Filters

	fbasic_salarieslistsrch.filterList = <?php echo $basic_salaries_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbasic_salarieslistsrch.initSearchPanel = true;
	loadjs.done("fbasic_salarieslistsrch");
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
<?php if (!$basic_salaries_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($basic_salaries_list->TotalRecords > 0 && $basic_salaries_list->ExportOptions->visible()) { ?>
<?php $basic_salaries_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($basic_salaries_list->ImportOptions->visible()) { ?>
<?php $basic_salaries_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($basic_salaries_list->SearchOptions->visible()) { ?>
<?php $basic_salaries_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($basic_salaries_list->FilterOptions->visible()) { ?>
<?php $basic_salaries_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$basic_salaries_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$basic_salaries_list->isExport() && !$basic_salaries->CurrentAction) { ?>
<form name="fbasic_salarieslistsrch" id="fbasic_salarieslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbasic_salarieslistsrch-search-panel" class="<?php echo $basic_salaries_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="basic_salaries">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $basic_salaries_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($basic_salaries_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($basic_salaries_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $basic_salaries_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($basic_salaries_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($basic_salaries_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($basic_salaries_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($basic_salaries_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $basic_salaries_list->showPageHeader(); ?>
<?php
$basic_salaries_list->showMessage();
?>
<?php if ($basic_salaries_list->TotalRecords > 0 || $basic_salaries->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($basic_salaries_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> basic_salaries">
<?php if (!$basic_salaries_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$basic_salaries_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $basic_salaries_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $basic_salaries_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbasic_salarieslist" id="fbasic_salarieslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="basic_salaries">
<div id="gmp_basic_salaries" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($basic_salaries_list->TotalRecords > 0 || $basic_salaries_list->isGridEdit()) { ?>
<table id="tbl_basic_salarieslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$basic_salaries->RowType = ROWTYPE_HEADER;

// Render list options
$basic_salaries_list->renderListOptions();

// Render list options (header, left)
$basic_salaries_list->ListOptions->render("header", "left");
?>
<?php if ($basic_salaries_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($basic_salaries_list->SortUrl($basic_salaries_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $basic_salaries_list->EmployeeID->headerCellClass() ?>"><div id="elh_basic_salaries_EmployeeID" class="basic_salaries_EmployeeID"><div class="ew-table-header-caption"><?php echo $basic_salaries_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $basic_salaries_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $basic_salaries_list->SortUrl($basic_salaries_list->EmployeeID) ?>', 1);"><div id="elh_basic_salaries_EmployeeID" class="basic_salaries_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $basic_salaries_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($basic_salaries_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($basic_salaries_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($basic_salaries_list->Name->Visible) { // Name ?>
	<?php if ($basic_salaries_list->SortUrl($basic_salaries_list->Name) == "") { ?>
		<th data-name="Name" class="<?php echo $basic_salaries_list->Name->headerCellClass() ?>"><div id="elh_basic_salaries_Name" class="basic_salaries_Name"><div class="ew-table-header-caption"><?php echo $basic_salaries_list->Name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Name" class="<?php echo $basic_salaries_list->Name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $basic_salaries_list->SortUrl($basic_salaries_list->Name) ?>', 1);"><div id="elh_basic_salaries_Name" class="basic_salaries_Name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $basic_salaries_list->Name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($basic_salaries_list->Name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($basic_salaries_list->Name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($basic_salaries_list->BasicSalary->Visible) { // BasicSalary ?>
	<?php if ($basic_salaries_list->SortUrl($basic_salaries_list->BasicSalary) == "") { ?>
		<th data-name="BasicSalary" class="<?php echo $basic_salaries_list->BasicSalary->headerCellClass() ?>"><div id="elh_basic_salaries_BasicSalary" class="basic_salaries_BasicSalary"><div class="ew-table-header-caption"><?php echo $basic_salaries_list->BasicSalary->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BasicSalary" class="<?php echo $basic_salaries_list->BasicSalary->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $basic_salaries_list->SortUrl($basic_salaries_list->BasicSalary) ?>', 1);"><div id="elh_basic_salaries_BasicSalary" class="basic_salaries_BasicSalary">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $basic_salaries_list->BasicSalary->caption() ?></span><span class="ew-table-header-sort"><?php if ($basic_salaries_list->BasicSalary->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($basic_salaries_list->BasicSalary->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$basic_salaries_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($basic_salaries_list->ExportAll && $basic_salaries_list->isExport()) {
	$basic_salaries_list->StopRecord = $basic_salaries_list->TotalRecords;
} else {

	// Set the last record to display
	if ($basic_salaries_list->TotalRecords > $basic_salaries_list->StartRecord + $basic_salaries_list->DisplayRecords - 1)
		$basic_salaries_list->StopRecord = $basic_salaries_list->StartRecord + $basic_salaries_list->DisplayRecords - 1;
	else
		$basic_salaries_list->StopRecord = $basic_salaries_list->TotalRecords;
}
$basic_salaries_list->RecordCount = $basic_salaries_list->StartRecord - 1;
if ($basic_salaries_list->Recordset && !$basic_salaries_list->Recordset->EOF) {
	$basic_salaries_list->Recordset->moveFirst();
	$selectLimit = $basic_salaries_list->UseSelectLimit;
	if (!$selectLimit && $basic_salaries_list->StartRecord > 1)
		$basic_salaries_list->Recordset->move($basic_salaries_list->StartRecord - 1);
} elseif (!$basic_salaries->AllowAddDeleteRow && $basic_salaries_list->StopRecord == 0) {
	$basic_salaries_list->StopRecord = $basic_salaries->GridAddRowCount;
}

// Initialize aggregate
$basic_salaries->RowType = ROWTYPE_AGGREGATEINIT;
$basic_salaries->resetAttributes();
$basic_salaries_list->renderRow();
while ($basic_salaries_list->RecordCount < $basic_salaries_list->StopRecord) {
	$basic_salaries_list->RecordCount++;
	if ($basic_salaries_list->RecordCount >= $basic_salaries_list->StartRecord) {
		$basic_salaries_list->RowCount++;

		// Set up key count
		$basic_salaries_list->KeyCount = $basic_salaries_list->RowIndex;

		// Init row class and style
		$basic_salaries->resetAttributes();
		$basic_salaries->CssClass = "";
		if ($basic_salaries_list->isGridAdd()) {
		} else {
			$basic_salaries_list->loadRowValues($basic_salaries_list->Recordset); // Load row values
		}
		$basic_salaries->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$basic_salaries->RowAttrs->merge(["data-rowindex" => $basic_salaries_list->RowCount, "id" => "r" . $basic_salaries_list->RowCount . "_basic_salaries", "data-rowtype" => $basic_salaries->RowType]);

		// Render row
		$basic_salaries_list->renderRow();

		// Render list options
		$basic_salaries_list->renderListOptions();
?>
	<tr <?php echo $basic_salaries->rowAttributes() ?>>
<?php

// Render list options (body, left)
$basic_salaries_list->ListOptions->render("body", "left", $basic_salaries_list->RowCount);
?>
	<?php if ($basic_salaries_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $basic_salaries_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $basic_salaries_list->RowCount ?>_basic_salaries_EmployeeID">
<span<?php echo $basic_salaries_list->EmployeeID->viewAttributes() ?>><?php echo $basic_salaries_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($basic_salaries_list->Name->Visible) { // Name ?>
		<td data-name="Name" <?php echo $basic_salaries_list->Name->cellAttributes() ?>>
<span id="el<?php echo $basic_salaries_list->RowCount ?>_basic_salaries_Name">
<span<?php echo $basic_salaries_list->Name->viewAttributes() ?>><?php echo $basic_salaries_list->Name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($basic_salaries_list->BasicSalary->Visible) { // BasicSalary ?>
		<td data-name="BasicSalary" <?php echo $basic_salaries_list->BasicSalary->cellAttributes() ?>>
<span id="el<?php echo $basic_salaries_list->RowCount ?>_basic_salaries_BasicSalary">
<span<?php echo $basic_salaries_list->BasicSalary->viewAttributes() ?>><?php echo $basic_salaries_list->BasicSalary->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$basic_salaries_list->ListOptions->render("body", "right", $basic_salaries_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$basic_salaries_list->isGridAdd())
		$basic_salaries_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$basic_salaries->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($basic_salaries_list->Recordset)
	$basic_salaries_list->Recordset->Close();
?>
<?php if (!$basic_salaries_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$basic_salaries_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $basic_salaries_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $basic_salaries_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($basic_salaries_list->TotalRecords == 0 && !$basic_salaries->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $basic_salaries_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$basic_salaries_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$basic_salaries_list->isExport()) { ?>
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
$basic_salaries_list->terminate();
?>