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
$credit_list = new credit_list();

// Run the page
$credit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$credit_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$credit_list->isExport()) { ?>
<script>
var fcreditlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcreditlist = currentForm = new ew.Form("fcreditlist", "list");
	fcreditlist.formKeyCountName = '<?php echo $credit_list->FormKeyCountName ?>';
	loadjs.done("fcreditlist");
});
var fcreditlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcreditlistsrch = currentSearchForm = new ew.Form("fcreditlistsrch");

	// Dynamic selection lists
	// Filters

	fcreditlistsrch.filterList = <?php echo $credit_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcreditlistsrch.initSearchPanel = true;
	loadjs.done("fcreditlistsrch");
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
<?php if (!$credit_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($credit_list->TotalRecords > 0 && $credit_list->ExportOptions->visible()) { ?>
<?php $credit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($credit_list->ImportOptions->visible()) { ?>
<?php $credit_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($credit_list->SearchOptions->visible()) { ?>
<?php $credit_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($credit_list->FilterOptions->visible()) { ?>
<?php $credit_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$credit_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$credit_list->isExport() && !$credit->CurrentAction) { ?>
<form name="fcreditlistsrch" id="fcreditlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcreditlistsrch-search-panel" class="<?php echo $credit_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="credit">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $credit_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($credit_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($credit_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $credit_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($credit_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($credit_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($credit_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($credit_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $credit_list->showPageHeader(); ?>
<?php
$credit_list->showMessage();
?>
<?php if ($credit_list->TotalRecords > 0 || $credit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($credit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> credit">
<?php if (!$credit_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$credit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $credit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $credit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcreditlist" id="fcreditlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="credit">
<div id="gmp_credit" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($credit_list->TotalRecords > 0 || $credit_list->isGridEdit()) { ?>
<table id="tbl_creditlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$credit->RowType = ROWTYPE_HEADER;

// Render list options
$credit_list->renderListOptions();

// Render list options (header, left)
$credit_list->ListOptions->render("header", "left");
?>
<?php if ($credit_list->IncomeCode->Visible) { // IncomeCode ?>
	<?php if ($credit_list->SortUrl($credit_list->IncomeCode) == "") { ?>
		<th data-name="IncomeCode" class="<?php echo $credit_list->IncomeCode->headerCellClass() ?>"><div id="elh_credit_IncomeCode" class="credit_IncomeCode"><div class="ew-table-header-caption"><?php echo $credit_list->IncomeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeCode" class="<?php echo $credit_list->IncomeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_list->SortUrl($credit_list->IncomeCode) ?>', 1);"><div id="elh_credit_IncomeCode" class="credit_IncomeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_list->IncomeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($credit_list->IncomeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_list->IncomeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($credit_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($credit_list->SortUrl($credit_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $credit_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_credit_PayrollPeriod" class="credit_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $credit_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $credit_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_list->SortUrl($credit_list->PayrollPeriod) ?>', 1);"><div id="elh_credit_PayrollPeriod" class="credit_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_list->PayrollPeriod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($credit_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($credit_list->TotalIncomes->Visible) { // TotalIncomes ?>
	<?php if ($credit_list->SortUrl($credit_list->TotalIncomes) == "") { ?>
		<th data-name="TotalIncomes" class="<?php echo $credit_list->TotalIncomes->headerCellClass() ?>"><div id="elh_credit_TotalIncomes" class="credit_TotalIncomes"><div class="ew-table-header-caption"><?php echo $credit_list->TotalIncomes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalIncomes" class="<?php echo $credit_list->TotalIncomes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_list->SortUrl($credit_list->TotalIncomes) ?>', 1);"><div id="elh_credit_TotalIncomes" class="credit_TotalIncomes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_list->TotalIncomes->caption() ?></span><span class="ew-table-header-sort"><?php if ($credit_list->TotalIncomes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_list->TotalIncomes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$credit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($credit_list->ExportAll && $credit_list->isExport()) {
	$credit_list->StopRecord = $credit_list->TotalRecords;
} else {

	// Set the last record to display
	if ($credit_list->TotalRecords > $credit_list->StartRecord + $credit_list->DisplayRecords - 1)
		$credit_list->StopRecord = $credit_list->StartRecord + $credit_list->DisplayRecords - 1;
	else
		$credit_list->StopRecord = $credit_list->TotalRecords;
}
$credit_list->RecordCount = $credit_list->StartRecord - 1;
if ($credit_list->Recordset && !$credit_list->Recordset->EOF) {
	$credit_list->Recordset->moveFirst();
	$selectLimit = $credit_list->UseSelectLimit;
	if (!$selectLimit && $credit_list->StartRecord > 1)
		$credit_list->Recordset->move($credit_list->StartRecord - 1);
} elseif (!$credit->AllowAddDeleteRow && $credit_list->StopRecord == 0) {
	$credit_list->StopRecord = $credit->GridAddRowCount;
}

// Initialize aggregate
$credit->RowType = ROWTYPE_AGGREGATEINIT;
$credit->resetAttributes();
$credit_list->renderRow();
while ($credit_list->RecordCount < $credit_list->StopRecord) {
	$credit_list->RecordCount++;
	if ($credit_list->RecordCount >= $credit_list->StartRecord) {
		$credit_list->RowCount++;

		// Set up key count
		$credit_list->KeyCount = $credit_list->RowIndex;

		// Init row class and style
		$credit->resetAttributes();
		$credit->CssClass = "";
		if ($credit_list->isGridAdd()) {
		} else {
			$credit_list->loadRowValues($credit_list->Recordset); // Load row values
		}
		$credit->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$credit->RowAttrs->merge(["data-rowindex" => $credit_list->RowCount, "id" => "r" . $credit_list->RowCount . "_credit", "data-rowtype" => $credit->RowType]);

		// Render row
		$credit_list->renderRow();

		// Render list options
		$credit_list->renderListOptions();
?>
	<tr <?php echo $credit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$credit_list->ListOptions->render("body", "left", $credit_list->RowCount);
?>
	<?php if ($credit_list->IncomeCode->Visible) { // IncomeCode ?>
		<td data-name="IncomeCode" <?php echo $credit_list->IncomeCode->cellAttributes() ?>>
<span id="el<?php echo $credit_list->RowCount ?>_credit_IncomeCode">
<span<?php echo $credit_list->IncomeCode->viewAttributes() ?>><?php echo $credit_list->IncomeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($credit_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $credit_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $credit_list->RowCount ?>_credit_PayrollPeriod">
<span<?php echo $credit_list->PayrollPeriod->viewAttributes() ?>><?php echo $credit_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($credit_list->TotalIncomes->Visible) { // TotalIncomes ?>
		<td data-name="TotalIncomes" <?php echo $credit_list->TotalIncomes->cellAttributes() ?>>
<span id="el<?php echo $credit_list->RowCount ?>_credit_TotalIncomes">
<span<?php echo $credit_list->TotalIncomes->viewAttributes() ?>><?php echo $credit_list->TotalIncomes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$credit_list->ListOptions->render("body", "right", $credit_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$credit_list->isGridAdd())
		$credit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$credit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($credit_list->Recordset)
	$credit_list->Recordset->Close();
?>
<?php if (!$credit_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$credit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $credit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $credit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($credit_list->TotalRecords == 0 && !$credit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $credit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$credit_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$credit_list->isExport()) { ?>
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
$credit_list->terminate();
?>