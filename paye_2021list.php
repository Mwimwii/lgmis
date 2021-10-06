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
$paye_2021_list = new paye_2021_list();

// Run the page
$paye_2021_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_2021_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_2021_list->isExport()) { ?>
<script>
var fpaye_2021list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpaye_2021list = currentForm = new ew.Form("fpaye_2021list", "list");
	fpaye_2021list.formKeyCountName = '<?php echo $paye_2021_list->FormKeyCountName ?>';
	loadjs.done("fpaye_2021list");
});
var fpaye_2021listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpaye_2021listsrch = currentSearchForm = new ew.Form("fpaye_2021listsrch");

	// Dynamic selection lists
	// Filters

	fpaye_2021listsrch.filterList = <?php echo $paye_2021_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpaye_2021listsrch.initSearchPanel = true;
	loadjs.done("fpaye_2021listsrch");
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
<?php if (!$paye_2021_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paye_2021_list->TotalRecords > 0 && $paye_2021_list->ExportOptions->visible()) { ?>
<?php $paye_2021_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_2021_list->ImportOptions->visible()) { ?>
<?php $paye_2021_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_2021_list->SearchOptions->visible()) { ?>
<?php $paye_2021_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paye_2021_list->FilterOptions->visible()) { ?>
<?php $paye_2021_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paye_2021_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$paye_2021_list->isExport() && !$paye_2021->CurrentAction) { ?>
<form name="fpaye_2021listsrch" id="fpaye_2021listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpaye_2021listsrch-search-panel" class="<?php echo $paye_2021_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="paye_2021">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $paye_2021_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($paye_2021_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($paye_2021_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $paye_2021_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($paye_2021_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($paye_2021_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($paye_2021_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($paye_2021_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $paye_2021_list->showPageHeader(); ?>
<?php
$paye_2021_list->showMessage();
?>
<?php if ($paye_2021_list->TotalRecords > 0 || $paye_2021->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paye_2021_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paye_2021">
<?php if (!$paye_2021_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paye_2021_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_2021_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_2021_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpaye_2021list" id="fpaye_2021list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_2021">
<div id="gmp_paye_2021" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($paye_2021_list->TotalRecords > 0 || $paye_2021_list->isGridEdit()) { ?>
<table id="tbl_paye_2021list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paye_2021->RowType = ROWTYPE_HEADER;

// Render list options
$paye_2021_list->renderListOptions();

// Render list options (header, left)
$paye_2021_list->ListOptions->render("header", "left");
?>
<?php if ($paye_2021_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($paye_2021_list->SortUrl($paye_2021_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_2021_list->EmployeeID->headerCellClass() ?>"><div id="elh_paye_2021_EmployeeID" class="paye_2021_EmployeeID"><div class="ew-table-header-caption"><?php echo $paye_2021_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_2021_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_2021_list->SortUrl($paye_2021_list->EmployeeID) ?>', 1);"><div id="elh_paye_2021_EmployeeID" class="paye_2021_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_2021_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_2021_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_2021_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_2021_list->FirstName->Visible) { // FirstName ?>
	<?php if ($paye_2021_list->SortUrl($paye_2021_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $paye_2021_list->FirstName->headerCellClass() ?>"><div id="elh_paye_2021_FirstName" class="paye_2021_FirstName"><div class="ew-table-header-caption"><?php echo $paye_2021_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $paye_2021_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_2021_list->SortUrl($paye_2021_list->FirstName) ?>', 1);"><div id="elh_paye_2021_FirstName" class="paye_2021_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_2021_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_2021_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_2021_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_2021_list->MiddleName->Visible) { // MiddleName ?>
	<?php if ($paye_2021_list->SortUrl($paye_2021_list->MiddleName) == "") { ?>
		<th data-name="MiddleName" class="<?php echo $paye_2021_list->MiddleName->headerCellClass() ?>"><div id="elh_paye_2021_MiddleName" class="paye_2021_MiddleName"><div class="ew-table-header-caption"><?php echo $paye_2021_list->MiddleName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MiddleName" class="<?php echo $paye_2021_list->MiddleName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_2021_list->SortUrl($paye_2021_list->MiddleName) ?>', 1);"><div id="elh_paye_2021_MiddleName" class="paye_2021_MiddleName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_2021_list->MiddleName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_2021_list->MiddleName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_2021_list->MiddleName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_2021_list->Surname->Visible) { // Surname ?>
	<?php if ($paye_2021_list->SortUrl($paye_2021_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $paye_2021_list->Surname->headerCellClass() ?>"><div id="elh_paye_2021_Surname" class="paye_2021_Surname"><div class="ew-table-header-caption"><?php echo $paye_2021_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $paye_2021_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_2021_list->SortUrl($paye_2021_list->Surname) ?>', 1);"><div id="elh_paye_2021_Surname" class="paye_2021_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_2021_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_2021_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_2021_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_2021_list->TotalIncome->Visible) { // TotalIncome ?>
	<?php if ($paye_2021_list->SortUrl($paye_2021_list->TotalIncome) == "") { ?>
		<th data-name="TotalIncome" class="<?php echo $paye_2021_list->TotalIncome->headerCellClass() ?>"><div id="elh_paye_2021_TotalIncome" class="paye_2021_TotalIncome"><div class="ew-table-header-caption"><?php echo $paye_2021_list->TotalIncome->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalIncome" class="<?php echo $paye_2021_list->TotalIncome->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_2021_list->SortUrl($paye_2021_list->TotalIncome) ?>', 1);"><div id="elh_paye_2021_TotalIncome" class="paye_2021_TotalIncome">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_2021_list->TotalIncome->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_2021_list->TotalIncome->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_2021_list->TotalIncome->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_2021_list->PAYE->Visible) { // PAYE ?>
	<?php if ($paye_2021_list->SortUrl($paye_2021_list->PAYE) == "") { ?>
		<th data-name="PAYE" class="<?php echo $paye_2021_list->PAYE->headerCellClass() ?>"><div id="elh_paye_2021_PAYE" class="paye_2021_PAYE"><div class="ew-table-header-caption"><?php echo $paye_2021_list->PAYE->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PAYE" class="<?php echo $paye_2021_list->PAYE->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_2021_list->SortUrl($paye_2021_list->PAYE) ?>', 1);"><div id="elh_paye_2021_PAYE" class="paye_2021_PAYE">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_2021_list->PAYE->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_2021_list->PAYE->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_2021_list->PAYE->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paye_2021_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paye_2021_list->ExportAll && $paye_2021_list->isExport()) {
	$paye_2021_list->StopRecord = $paye_2021_list->TotalRecords;
} else {

	// Set the last record to display
	if ($paye_2021_list->TotalRecords > $paye_2021_list->StartRecord + $paye_2021_list->DisplayRecords - 1)
		$paye_2021_list->StopRecord = $paye_2021_list->StartRecord + $paye_2021_list->DisplayRecords - 1;
	else
		$paye_2021_list->StopRecord = $paye_2021_list->TotalRecords;
}
$paye_2021_list->RecordCount = $paye_2021_list->StartRecord - 1;
if ($paye_2021_list->Recordset && !$paye_2021_list->Recordset->EOF) {
	$paye_2021_list->Recordset->moveFirst();
	$selectLimit = $paye_2021_list->UseSelectLimit;
	if (!$selectLimit && $paye_2021_list->StartRecord > 1)
		$paye_2021_list->Recordset->move($paye_2021_list->StartRecord - 1);
} elseif (!$paye_2021->AllowAddDeleteRow && $paye_2021_list->StopRecord == 0) {
	$paye_2021_list->StopRecord = $paye_2021->GridAddRowCount;
}

// Initialize aggregate
$paye_2021->RowType = ROWTYPE_AGGREGATEINIT;
$paye_2021->resetAttributes();
$paye_2021_list->renderRow();
while ($paye_2021_list->RecordCount < $paye_2021_list->StopRecord) {
	$paye_2021_list->RecordCount++;
	if ($paye_2021_list->RecordCount >= $paye_2021_list->StartRecord) {
		$paye_2021_list->RowCount++;

		// Set up key count
		$paye_2021_list->KeyCount = $paye_2021_list->RowIndex;

		// Init row class and style
		$paye_2021->resetAttributes();
		$paye_2021->CssClass = "";
		if ($paye_2021_list->isGridAdd()) {
		} else {
			$paye_2021_list->loadRowValues($paye_2021_list->Recordset); // Load row values
		}
		$paye_2021->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$paye_2021->RowAttrs->merge(["data-rowindex" => $paye_2021_list->RowCount, "id" => "r" . $paye_2021_list->RowCount . "_paye_2021", "data-rowtype" => $paye_2021->RowType]);

		// Render row
		$paye_2021_list->renderRow();

		// Render list options
		$paye_2021_list->renderListOptions();
?>
	<tr <?php echo $paye_2021->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_2021_list->ListOptions->render("body", "left", $paye_2021_list->RowCount);
?>
	<?php if ($paye_2021_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $paye_2021_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $paye_2021_list->RowCount ?>_paye_2021_EmployeeID">
<span<?php echo $paye_2021_list->EmployeeID->viewAttributes() ?>><?php echo $paye_2021_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_2021_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $paye_2021_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $paye_2021_list->RowCount ?>_paye_2021_FirstName">
<span<?php echo $paye_2021_list->FirstName->viewAttributes() ?>><?php echo $paye_2021_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_2021_list->MiddleName->Visible) { // MiddleName ?>
		<td data-name="MiddleName" <?php echo $paye_2021_list->MiddleName->cellAttributes() ?>>
<span id="el<?php echo $paye_2021_list->RowCount ?>_paye_2021_MiddleName">
<span<?php echo $paye_2021_list->MiddleName->viewAttributes() ?>><?php echo $paye_2021_list->MiddleName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_2021_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $paye_2021_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $paye_2021_list->RowCount ?>_paye_2021_Surname">
<span<?php echo $paye_2021_list->Surname->viewAttributes() ?>><?php echo $paye_2021_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_2021_list->TotalIncome->Visible) { // TotalIncome ?>
		<td data-name="TotalIncome" <?php echo $paye_2021_list->TotalIncome->cellAttributes() ?>>
<span id="el<?php echo $paye_2021_list->RowCount ?>_paye_2021_TotalIncome">
<span<?php echo $paye_2021_list->TotalIncome->viewAttributes() ?>><?php echo $paye_2021_list->TotalIncome->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_2021_list->PAYE->Visible) { // PAYE ?>
		<td data-name="PAYE" <?php echo $paye_2021_list->PAYE->cellAttributes() ?>>
<span id="el<?php echo $paye_2021_list->RowCount ?>_paye_2021_PAYE">
<span<?php echo $paye_2021_list->PAYE->viewAttributes() ?>><?php echo $paye_2021_list->PAYE->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_2021_list->ListOptions->render("body", "right", $paye_2021_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$paye_2021_list->isGridAdd())
		$paye_2021_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$paye_2021->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paye_2021_list->Recordset)
	$paye_2021_list->Recordset->Close();
?>
<?php if (!$paye_2021_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paye_2021_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_2021_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_2021_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paye_2021_list->TotalRecords == 0 && !$paye_2021->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paye_2021_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paye_2021_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_2021_list->isExport()) { ?>
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
$paye_2021_list->terminate();
?>