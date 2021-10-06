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
$currently_employed_staff_list = new currently_employed_staff_list();

// Run the page
$currently_employed_staff_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$currently_employed_staff_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$currently_employed_staff_list->isExport()) { ?>
<script>
var fcurrently_employed_stafflist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcurrently_employed_stafflist = currentForm = new ew.Form("fcurrently_employed_stafflist", "list");
	fcurrently_employed_stafflist.formKeyCountName = '<?php echo $currently_employed_staff_list->FormKeyCountName ?>';
	loadjs.done("fcurrently_employed_stafflist");
});
var fcurrently_employed_stafflistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcurrently_employed_stafflistsrch = currentSearchForm = new ew.Form("fcurrently_employed_stafflistsrch");

	// Dynamic selection lists
	// Filters

	fcurrently_employed_stafflistsrch.filterList = <?php echo $currently_employed_staff_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcurrently_employed_stafflistsrch.initSearchPanel = true;
	loadjs.done("fcurrently_employed_stafflistsrch");
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
<?php if (!$currently_employed_staff_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($currently_employed_staff_list->TotalRecords > 0 && $currently_employed_staff_list->ExportOptions->visible()) { ?>
<?php $currently_employed_staff_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($currently_employed_staff_list->ImportOptions->visible()) { ?>
<?php $currently_employed_staff_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($currently_employed_staff_list->SearchOptions->visible()) { ?>
<?php $currently_employed_staff_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($currently_employed_staff_list->FilterOptions->visible()) { ?>
<?php $currently_employed_staff_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$currently_employed_staff_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$currently_employed_staff_list->isExport() && !$currently_employed_staff->CurrentAction) { ?>
<form name="fcurrently_employed_stafflistsrch" id="fcurrently_employed_stafflistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcurrently_employed_stafflistsrch-search-panel" class="<?php echo $currently_employed_staff_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="currently_employed_staff">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $currently_employed_staff_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($currently_employed_staff_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($currently_employed_staff_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $currently_employed_staff_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($currently_employed_staff_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($currently_employed_staff_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($currently_employed_staff_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($currently_employed_staff_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $currently_employed_staff_list->showPageHeader(); ?>
<?php
$currently_employed_staff_list->showMessage();
?>
<?php if ($currently_employed_staff_list->TotalRecords > 0 || $currently_employed_staff->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($currently_employed_staff_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> currently_employed_staff">
<?php if (!$currently_employed_staff_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$currently_employed_staff_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $currently_employed_staff_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $currently_employed_staff_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcurrently_employed_stafflist" id="fcurrently_employed_stafflist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="currently_employed_staff">
<div id="gmp_currently_employed_staff" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($currently_employed_staff_list->TotalRecords > 0 || $currently_employed_staff_list->isGridEdit()) { ?>
<table id="tbl_currently_employed_stafflist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$currently_employed_staff->RowType = ROWTYPE_HEADER;

// Render list options
$currently_employed_staff_list->renderListOptions();

// Render list options (header, left)
$currently_employed_staff_list->ListOptions->render("header", "left");
?>
<?php if ($currently_employed_staff_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($currently_employed_staff_list->SortUrl($currently_employed_staff_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $currently_employed_staff_list->EmployeeID->headerCellClass() ?>"><div id="elh_currently_employed_staff_EmployeeID" class="currently_employed_staff_EmployeeID"><div class="ew-table-header-caption"><?php echo $currently_employed_staff_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $currently_employed_staff_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $currently_employed_staff_list->SortUrl($currently_employed_staff_list->EmployeeID) ?>', 1);"><div id="elh_currently_employed_staff_EmployeeID" class="currently_employed_staff_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $currently_employed_staff_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($currently_employed_staff_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($currently_employed_staff_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($currently_employed_staff_list->FirstName->Visible) { // FirstName ?>
	<?php if ($currently_employed_staff_list->SortUrl($currently_employed_staff_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $currently_employed_staff_list->FirstName->headerCellClass() ?>"><div id="elh_currently_employed_staff_FirstName" class="currently_employed_staff_FirstName"><div class="ew-table-header-caption"><?php echo $currently_employed_staff_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $currently_employed_staff_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $currently_employed_staff_list->SortUrl($currently_employed_staff_list->FirstName) ?>', 1);"><div id="elh_currently_employed_staff_FirstName" class="currently_employed_staff_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $currently_employed_staff_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($currently_employed_staff_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($currently_employed_staff_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($currently_employed_staff_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($currently_employed_staff_list->SortUrl($currently_employed_staff_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $currently_employed_staff_list->MiddleName->headerCellClass() ?>"><div id="elh_currently_employed_staff_MiddleName" class="currently_employed_staff_MiddleName"><div class="ew-table-header-caption"><?php echo $currently_employed_staff_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $currently_employed_staff_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $currently_employed_staff_list->SortUrl($currently_employed_staff_list->MiddleName) ?>', 1);"><div id="elh_currently_employed_staff_MiddleName" class="currently_employed_staff_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $currently_employed_staff_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($currently_employed_staff_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($currently_employed_staff_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($currently_employed_staff_list->Surname->Visible) { // Surname ?>
	<?php if ($currently_employed_staff_list->SortUrl($currently_employed_staff_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $currently_employed_staff_list->Surname->headerCellClass() ?>"><div id="elh_currently_employed_staff_Surname" class="currently_employed_staff_Surname"><div class="ew-table-header-caption"><?php echo $currently_employed_staff_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $currently_employed_staff_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $currently_employed_staff_list->SortUrl($currently_employed_staff_list->Surname) ?>', 1);"><div id="elh_currently_employed_staff_Surname" class="currently_employed_staff_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $currently_employed_staff_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($currently_employed_staff_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($currently_employed_staff_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$currently_employed_staff_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($currently_employed_staff_list->ExportAll && $currently_employed_staff_list->isExport()) {
	$currently_employed_staff_list->StopRecord = $currently_employed_staff_list->TotalRecords;
} else {

	// Set the last record to display
	if ($currently_employed_staff_list->TotalRecords > $currently_employed_staff_list->StartRecord + $currently_employed_staff_list->DisplayRecords - 1)
		$currently_employed_staff_list->StopRecord = $currently_employed_staff_list->StartRecord + $currently_employed_staff_list->DisplayRecords - 1;
	else
		$currently_employed_staff_list->StopRecord = $currently_employed_staff_list->TotalRecords;
}
$currently_employed_staff_list->RecordCount = $currently_employed_staff_list->StartRecord - 1;
if ($currently_employed_staff_list->Recordset && !$currently_employed_staff_list->Recordset->EOF) {
	$currently_employed_staff_list->Recordset->moveFirst();
	$selectLimit = $currently_employed_staff_list->UseSelectLimit;
	if (!$selectLimit && $currently_employed_staff_list->StartRecord > 1)
		$currently_employed_staff_list->Recordset->move($currently_employed_staff_list->StartRecord - 1);
} elseif (!$currently_employed_staff->AllowAddDeleteRow && $currently_employed_staff_list->StopRecord == 0) {
	$currently_employed_staff_list->StopRecord = $currently_employed_staff->GridAddRowCount;
}

// Initialize aggregate
$currently_employed_staff->RowType = ROWTYPE_AGGREGATEINIT;
$currently_employed_staff->resetAttributes();
$currently_employed_staff_list->renderRow();
while ($currently_employed_staff_list->RecordCount < $currently_employed_staff_list->StopRecord) {
	$currently_employed_staff_list->RecordCount++;
	if ($currently_employed_staff_list->RecordCount >= $currently_employed_staff_list->StartRecord) {
		$currently_employed_staff_list->RowCount++;

		// Set up key count
		$currently_employed_staff_list->KeyCount = $currently_employed_staff_list->RowIndex;

		// Init row class and style
		$currently_employed_staff->resetAttributes();
		$currently_employed_staff->CssClass = "";
		if ($currently_employed_staff_list->isGridAdd()) {
		} else {
			$currently_employed_staff_list->loadRowValues($currently_employed_staff_list->Recordset); // Load row values
		}
		$currently_employed_staff->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$currently_employed_staff->RowAttrs->merge(["data-rowindex" => $currently_employed_staff_list->RowCount, "id" => "r" . $currently_employed_staff_list->RowCount . "_currently_employed_staff", "data-rowtype" => $currently_employed_staff->RowType]);

		// Render row
		$currently_employed_staff_list->renderRow();

		// Render list options
		$currently_employed_staff_list->renderListOptions();
?>
	<tr <?php echo $currently_employed_staff->rowAttributes() ?>>
<?php

// Render list options (body, left)
$currently_employed_staff_list->ListOptions->render("body", "left", $currently_employed_staff_list->RowCount);
?>
	<?php if ($currently_employed_staff_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $currently_employed_staff_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $currently_employed_staff_list->RowCount ?>_currently_employed_staff_EmployeeID">
<span<?php echo $currently_employed_staff_list->EmployeeID->viewAttributes() ?>><?php echo $currently_employed_staff_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($currently_employed_staff_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $currently_employed_staff_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $currently_employed_staff_list->RowCount ?>_currently_employed_staff_FirstName">
<span<?php echo $currently_employed_staff_list->FirstName->viewAttributes() ?>><?php echo $currently_employed_staff_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($currently_employed_staff_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $currently_employed_staff_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $currently_employed_staff_list->RowCount ?>_currently_employed_staff_MiddleName">
<span<?php echo $currently_employed_staff_list->MiddleName->viewAttributes() ?>><?php echo $currently_employed_staff_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($currently_employed_staff_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $currently_employed_staff_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $currently_employed_staff_list->RowCount ?>_currently_employed_staff_Surname">
<span<?php echo $currently_employed_staff_list->Surname->viewAttributes() ?>><?php echo $currently_employed_staff_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$currently_employed_staff_list->ListOptions->render("body", "right", $currently_employed_staff_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$currently_employed_staff_list->isGridAdd())
		$currently_employed_staff_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$currently_employed_staff->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($currently_employed_staff_list->Recordset)
	$currently_employed_staff_list->Recordset->Close();
?>
<?php if (!$currently_employed_staff_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$currently_employed_staff_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $currently_employed_staff_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $currently_employed_staff_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($currently_employed_staff_list->TotalRecords == 0 && !$currently_employed_staff->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $currently_employed_staff_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$currently_employed_staff_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$currently_employed_staff_list->isExport()) { ?>
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
$currently_employed_staff_list->terminate();
?>