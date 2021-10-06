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
$credit_debit_list = new credit_debit_list();

// Run the page
$credit_debit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$credit_debit_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$credit_debit_list->isExport()) { ?>
<script>
var fcredit_debitlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcredit_debitlist = currentForm = new ew.Form("fcredit_debitlist", "list");
	fcredit_debitlist.formKeyCountName = '<?php echo $credit_debit_list->FormKeyCountName ?>';
	loadjs.done("fcredit_debitlist");
});
var fcredit_debitlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcredit_debitlistsrch = currentSearchForm = new ew.Form("fcredit_debitlistsrch");

	// Dynamic selection lists
	// Filters

	fcredit_debitlistsrch.filterList = <?php echo $credit_debit_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcredit_debitlistsrch.initSearchPanel = true;
	loadjs.done("fcredit_debitlistsrch");
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
<?php if (!$credit_debit_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($credit_debit_list->TotalRecords > 0 && $credit_debit_list->ExportOptions->visible()) { ?>
<?php $credit_debit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($credit_debit_list->ImportOptions->visible()) { ?>
<?php $credit_debit_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($credit_debit_list->SearchOptions->visible()) { ?>
<?php $credit_debit_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($credit_debit_list->FilterOptions->visible()) { ?>
<?php $credit_debit_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$credit_debit_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$credit_debit_list->isExport() && !$credit_debit->CurrentAction) { ?>
<form name="fcredit_debitlistsrch" id="fcredit_debitlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcredit_debitlistsrch-search-panel" class="<?php echo $credit_debit_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="credit_debit">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $credit_debit_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($credit_debit_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($credit_debit_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $credit_debit_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($credit_debit_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($credit_debit_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($credit_debit_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($credit_debit_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $credit_debit_list->showPageHeader(); ?>
<?php
$credit_debit_list->showMessage();
?>
<?php if ($credit_debit_list->TotalRecords > 0 || $credit_debit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($credit_debit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> credit_debit">
<?php if (!$credit_debit_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$credit_debit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $credit_debit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $credit_debit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcredit_debitlist" id="fcredit_debitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="credit_debit">
<div id="gmp_credit_debit" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($credit_debit_list->TotalRecords > 0 || $credit_debit_list->isGridEdit()) { ?>
<table id="tbl_credit_debitlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$credit_debit->RowType = ROWTYPE_HEADER;

// Render list options
$credit_debit_list->renderListOptions();

// Render list options (header, left)
$credit_debit_list->ListOptions->render("header", "left");
?>
<?php if ($credit_debit_list->CREDIT->Visible) { // CREDIT ?>
	<?php if ($credit_debit_list->SortUrl($credit_debit_list->CREDIT) == "") { ?>
		<th data-name="CREDIT" class="<?php echo $credit_debit_list->CREDIT->headerCellClass() ?>"><div id="elh_credit_debit_CREDIT" class="credit_debit_CREDIT"><div class="ew-table-header-caption"><?php echo $credit_debit_list->CREDIT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CREDIT" class="<?php echo $credit_debit_list->CREDIT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_debit_list->SortUrl($credit_debit_list->CREDIT) ?>', 1);"><div id="elh_credit_debit_CREDIT" class="credit_debit_CREDIT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_debit_list->CREDIT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($credit_debit_list->CREDIT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_debit_list->CREDIT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($credit_debit_list->TotalIncomes->Visible) { // TotalIncomes ?>
	<?php if ($credit_debit_list->SortUrl($credit_debit_list->TotalIncomes) == "") { ?>
		<th data-name="TotalIncomes" class="<?php echo $credit_debit_list->TotalIncomes->headerCellClass() ?>"><div id="elh_credit_debit_TotalIncomes" class="credit_debit_TotalIncomes"><div class="ew-table-header-caption"><?php echo $credit_debit_list->TotalIncomes->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalIncomes" class="<?php echo $credit_debit_list->TotalIncomes->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_debit_list->SortUrl($credit_debit_list->TotalIncomes) ?>', 1);"><div id="elh_credit_debit_TotalIncomes" class="credit_debit_TotalIncomes">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_debit_list->TotalIncomes->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($credit_debit_list->TotalIncomes->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_debit_list->TotalIncomes->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($credit_debit_list->DEBIT->Visible) { // DEBIT ?>
	<?php if ($credit_debit_list->SortUrl($credit_debit_list->DEBIT) == "") { ?>
		<th data-name="DEBIT" class="<?php echo $credit_debit_list->DEBIT->headerCellClass() ?>"><div id="elh_credit_debit_DEBIT" class="credit_debit_DEBIT"><div class="ew-table-header-caption"><?php echo $credit_debit_list->DEBIT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DEBIT" class="<?php echo $credit_debit_list->DEBIT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_debit_list->SortUrl($credit_debit_list->DEBIT) ?>', 1);"><div id="elh_credit_debit_DEBIT" class="credit_debit_DEBIT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_debit_list->DEBIT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($credit_debit_list->DEBIT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_debit_list->DEBIT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($credit_debit_list->TotalDeductions->Visible) { // TotalDeductions ?>
	<?php if ($credit_debit_list->SortUrl($credit_debit_list->TotalDeductions) == "") { ?>
		<th data-name="TotalDeductions" class="<?php echo $credit_debit_list->TotalDeductions->headerCellClass() ?>"><div id="elh_credit_debit_TotalDeductions" class="credit_debit_TotalDeductions"><div class="ew-table-header-caption"><?php echo $credit_debit_list->TotalDeductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDeductions" class="<?php echo $credit_debit_list->TotalDeductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $credit_debit_list->SortUrl($credit_debit_list->TotalDeductions) ?>', 1);"><div id="elh_credit_debit_TotalDeductions" class="credit_debit_TotalDeductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $credit_debit_list->TotalDeductions->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($credit_debit_list->TotalDeductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($credit_debit_list->TotalDeductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$credit_debit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($credit_debit_list->ExportAll && $credit_debit_list->isExport()) {
	$credit_debit_list->StopRecord = $credit_debit_list->TotalRecords;
} else {

	// Set the last record to display
	if ($credit_debit_list->TotalRecords > $credit_debit_list->StartRecord + $credit_debit_list->DisplayRecords - 1)
		$credit_debit_list->StopRecord = $credit_debit_list->StartRecord + $credit_debit_list->DisplayRecords - 1;
	else
		$credit_debit_list->StopRecord = $credit_debit_list->TotalRecords;
}
$credit_debit_list->RecordCount = $credit_debit_list->StartRecord - 1;
if ($credit_debit_list->Recordset && !$credit_debit_list->Recordset->EOF) {
	$credit_debit_list->Recordset->moveFirst();
	$selectLimit = $credit_debit_list->UseSelectLimit;
	if (!$selectLimit && $credit_debit_list->StartRecord > 1)
		$credit_debit_list->Recordset->move($credit_debit_list->StartRecord - 1);
} elseif (!$credit_debit->AllowAddDeleteRow && $credit_debit_list->StopRecord == 0) {
	$credit_debit_list->StopRecord = $credit_debit->GridAddRowCount;
}

// Initialize aggregate
$credit_debit->RowType = ROWTYPE_AGGREGATEINIT;
$credit_debit->resetAttributes();
$credit_debit_list->renderRow();
while ($credit_debit_list->RecordCount < $credit_debit_list->StopRecord) {
	$credit_debit_list->RecordCount++;
	if ($credit_debit_list->RecordCount >= $credit_debit_list->StartRecord) {
		$credit_debit_list->RowCount++;

		// Set up key count
		$credit_debit_list->KeyCount = $credit_debit_list->RowIndex;

		// Init row class and style
		$credit_debit->resetAttributes();
		$credit_debit->CssClass = "";
		if ($credit_debit_list->isGridAdd()) {
		} else {
			$credit_debit_list->loadRowValues($credit_debit_list->Recordset); // Load row values
		}
		$credit_debit->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$credit_debit->RowAttrs->merge(["data-rowindex" => $credit_debit_list->RowCount, "id" => "r" . $credit_debit_list->RowCount . "_credit_debit", "data-rowtype" => $credit_debit->RowType]);

		// Render row
		$credit_debit_list->renderRow();

		// Render list options
		$credit_debit_list->renderListOptions();
?>
	<tr <?php echo $credit_debit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$credit_debit_list->ListOptions->render("body", "left", $credit_debit_list->RowCount);
?>
	<?php if ($credit_debit_list->CREDIT->Visible) { // CREDIT ?>
		<td data-name="CREDIT" <?php echo $credit_debit_list->CREDIT->cellAttributes() ?>>
<span id="el<?php echo $credit_debit_list->RowCount ?>_credit_debit_CREDIT">
<span<?php echo $credit_debit_list->CREDIT->viewAttributes() ?>><?php echo $credit_debit_list->CREDIT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($credit_debit_list->TotalIncomes->Visible) { // TotalIncomes ?>
		<td data-name="TotalIncomes" <?php echo $credit_debit_list->TotalIncomes->cellAttributes() ?>>
<span id="el<?php echo $credit_debit_list->RowCount ?>_credit_debit_TotalIncomes">
<span<?php echo $credit_debit_list->TotalIncomes->viewAttributes() ?>><?php echo $credit_debit_list->TotalIncomes->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($credit_debit_list->DEBIT->Visible) { // DEBIT ?>
		<td data-name="DEBIT" <?php echo $credit_debit_list->DEBIT->cellAttributes() ?>>
<span id="el<?php echo $credit_debit_list->RowCount ?>_credit_debit_DEBIT">
<span<?php echo $credit_debit_list->DEBIT->viewAttributes() ?>><?php echo $credit_debit_list->DEBIT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($credit_debit_list->TotalDeductions->Visible) { // TotalDeductions ?>
		<td data-name="TotalDeductions" <?php echo $credit_debit_list->TotalDeductions->cellAttributes() ?>>
<span id="el<?php echo $credit_debit_list->RowCount ?>_credit_debit_TotalDeductions">
<span<?php echo $credit_debit_list->TotalDeductions->viewAttributes() ?>><?php echo $credit_debit_list->TotalDeductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$credit_debit_list->ListOptions->render("body", "right", $credit_debit_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$credit_debit_list->isGridAdd())
		$credit_debit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$credit_debit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($credit_debit_list->Recordset)
	$credit_debit_list->Recordset->Close();
?>
<?php if (!$credit_debit_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$credit_debit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $credit_debit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $credit_debit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($credit_debit_list->TotalRecords == 0 && !$credit_debit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $credit_debit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$credit_debit_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$credit_debit_list->isExport()) { ?>
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
$credit_debit_list->terminate();
?>