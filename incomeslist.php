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
$incomes_list = new incomes_list();

// Run the page
$incomes_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$incomes_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$incomes_list->isExport()) { ?>
<script>
var fincomeslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fincomeslist = currentForm = new ew.Form("fincomeslist", "list");
	fincomeslist.formKeyCountName = '<?php echo $incomes_list->FormKeyCountName ?>';
	loadjs.done("fincomeslist");
});
var fincomeslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fincomeslistsrch = currentSearchForm = new ew.Form("fincomeslistsrch");

	// Dynamic selection lists
	// Filters

	fincomeslistsrch.filterList = <?php echo $incomes_list->getFilterList() ?>;

	// Init search panel as collapsed
	fincomeslistsrch.initSearchPanel = true;
	loadjs.done("fincomeslistsrch");
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
<?php if (!$incomes_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($incomes_list->TotalRecords > 0 && $incomes_list->ExportOptions->visible()) { ?>
<?php $incomes_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($incomes_list->ImportOptions->visible()) { ?>
<?php $incomes_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($incomes_list->SearchOptions->visible()) { ?>
<?php $incomes_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($incomes_list->FilterOptions->visible()) { ?>
<?php $incomes_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$incomes_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$incomes_list->isExport() && !$incomes->CurrentAction) { ?>
<form name="fincomeslistsrch" id="fincomeslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fincomeslistsrch-search-panel" class="<?php echo $incomes_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="incomes">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $incomes_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($incomes_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($incomes_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $incomes_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($incomes_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($incomes_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($incomes_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($incomes_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $incomes_list->showPageHeader(); ?>
<?php
$incomes_list->showMessage();
?>
<?php if ($incomes_list->TotalRecords > 0 || $incomes->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($incomes_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> incomes">
<?php if (!$incomes_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$incomes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $incomes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $incomes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fincomeslist" id="fincomeslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="incomes">
<div id="gmp_incomes" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($incomes_list->TotalRecords > 0 || $incomes_list->isGridEdit()) { ?>
<table id="tbl_incomeslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$incomes->RowType = ROWTYPE_HEADER;

// Render list options
$incomes_list->renderListOptions();

// Render list options (header, left)
$incomes_list->ListOptions->render("header", "left");
?>
<?php if ($incomes_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($incomes_list->SortUrl($incomes_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $incomes_list->EmployeeID->headerCellClass() ?>"><div id="elh_incomes_EmployeeID" class="incomes_EmployeeID"><div class="ew-table-header-caption"><?php echo $incomes_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $incomes_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $incomes_list->SortUrl($incomes_list->EmployeeID) ?>', 1);"><div id="elh_incomes_EmployeeID" class="incomes_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $incomes_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($incomes_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($incomes_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($incomes_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($incomes_list->SortUrl($incomes_list->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $incomes_list->IncomeCode->headerCellClass() ?>"><div id="elh_incomes_IncomeCode" class="incomes_IncomeCode"><div class="ew-table-header-caption"><?php echo $incomes_list->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $incomes_list->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $incomes_list->SortUrl($incomes_list->IncomeCode) ?>', 1);"><div id="elh_incomes_IncomeCode" class="incomes_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $incomes_list->IncomeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($incomes_list->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($incomes_list->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($incomes_list->IncomeName->Visible) { // IncomeName ?>
	<?php if ($incomes_list->SortUrl($incomes_list->IncomeName) == "") { ?>
		<th data-name="IncomeName" class="<?php echo $incomes_list->IncomeName->headerCellClass() ?>"><div id="elh_incomes_IncomeName" class="incomes_IncomeName"><div class="ew-table-header-caption"><?php echo $incomes_list->IncomeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeName" class="<?php echo $incomes_list->IncomeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $incomes_list->SortUrl($incomes_list->IncomeName) ?>', 1);"><div id="elh_incomes_IncomeName" class="incomes_IncomeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $incomes_list->IncomeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($incomes_list->IncomeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($incomes_list->IncomeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($incomes_list->Income->Visible) { // Income ?>
	<?php if ($incomes_list->SortUrl($incomes_list->Income) == "") { ?>
		<th data-name="Income" class="<?php echo $incomes_list->Income->headerCellClass() ?>"><div id="elh_incomes_Income" class="incomes_Income"><div class="ew-table-header-caption"><?php echo $incomes_list->Income->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Income" class="<?php echo $incomes_list->Income->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $incomes_list->SortUrl($incomes_list->Income) ?>', 1);"><div id="elh_incomes_Income" class="incomes_Income">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $incomes_list->Income->caption() ?></span><span class="ew-table-header-sort"><?php if ($incomes_list->Income->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($incomes_list->Income->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$incomes_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($incomes_list->ExportAll && $incomes_list->isExport()) {
	$incomes_list->StopRecord = $incomes_list->TotalRecords;
} else {

	// Set the last record to display
	if ($incomes_list->TotalRecords > $incomes_list->StartRecord + $incomes_list->DisplayRecords - 1)
		$incomes_list->StopRecord = $incomes_list->StartRecord + $incomes_list->DisplayRecords - 1;
	else
		$incomes_list->StopRecord = $incomes_list->TotalRecords;
}
$incomes_list->RecordCount = $incomes_list->StartRecord - 1;
if ($incomes_list->Recordset && !$incomes_list->Recordset->EOF) {
	$incomes_list->Recordset->moveFirst();
	$selectLimit = $incomes_list->UseSelectLimit;
	if (!$selectLimit && $incomes_list->StartRecord > 1)
		$incomes_list->Recordset->move($incomes_list->StartRecord - 1);
} elseif (!$incomes->AllowAddDeleteRow && $incomes_list->StopRecord == 0) {
	$incomes_list->StopRecord = $incomes->GridAddRowCount;
}

// Initialize aggregate
$incomes->RowType = ROWTYPE_AGGREGATEINIT;
$incomes->resetAttributes();
$incomes_list->renderRow();
while ($incomes_list->RecordCount < $incomes_list->StopRecord) {
	$incomes_list->RecordCount++;
	if ($incomes_list->RecordCount >= $incomes_list->StartRecord) {
		$incomes_list->RowCount++;

		// Set up key count
		$incomes_list->KeyCount = $incomes_list->RowIndex;

		// Init row class and style
		$incomes->resetAttributes();
		$incomes->CssClass = "";
		if ($incomes_list->isGridAdd()) {
		} else {
			$incomes_list->loadRowValues($incomes_list->Recordset); // Load row values
		}
		$incomes->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$incomes->RowAttrs->merge(["data-rowindex" => $incomes_list->RowCount, "id" => "r" . $incomes_list->RowCount . "_incomes", "data-rowtype" => $incomes->RowType]);

		// Render row
		$incomes_list->renderRow();

		// Render list options
		$incomes_list->renderListOptions();
?>
	<tr <?php echo $incomes->rowAttributes() ?>>
<?php

// Render list options (body, left)
$incomes_list->ListOptions->render("body", "left", $incomes_list->RowCount);
?>
	<?php if ($incomes_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $incomes_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $incomes_list->RowCount ?>_incomes_EmployeeID">
<span<?php echo $incomes_list->EmployeeID->viewAttributes() ?>><?php echo $incomes_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($incomes_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $incomes_list->IncomeCode->cellAttributes() ?>>
<span id="el<?php echo $incomes_list->RowCount ?>_incomes_IncomeCode">
<span<?php echo $incomes_list->IncomeCode->viewAttributes() ?>><?php echo $incomes_list->IncomeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($incomes_list->IncomeName->Visible) { // IncomeName ?>
		<td data-name="IncomeName" <?php echo $incomes_list->IncomeName->cellAttributes() ?>>
<span id="el<?php echo $incomes_list->RowCount ?>_incomes_IncomeName">
<span<?php echo $incomes_list->IncomeName->viewAttributes() ?>><?php echo $incomes_list->IncomeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($incomes_list->Income->Visible) { // Income ?>
		<td data-name="Income" <?php echo $incomes_list->Income->cellAttributes() ?>>
<span id="el<?php echo $incomes_list->RowCount ?>_incomes_Income">
<span<?php echo $incomes_list->Income->viewAttributes() ?>><?php echo $incomes_list->Income->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$incomes_list->ListOptions->render("body", "right", $incomes_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$incomes_list->isGridAdd())
		$incomes_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$incomes->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($incomes_list->Recordset)
	$incomes_list->Recordset->Close();
?>
<?php if (!$incomes_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$incomes_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $incomes_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $incomes_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($incomes_list->TotalRecords == 0 && !$incomes->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $incomes_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$incomes_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$incomes_list->isExport()) { ?>
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
$incomes_list->terminate();
?>