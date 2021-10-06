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
$cashier_eod_view_list = new cashier_eod_view_list();

// Run the page
$cashier_eod_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$cashier_eod_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$cashier_eod_view_list->isExport()) { ?>
<script>
var fcashier_eod_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcashier_eod_viewlist = currentForm = new ew.Form("fcashier_eod_viewlist", "list");
	fcashier_eod_viewlist.formKeyCountName = '<?php echo $cashier_eod_view_list->FormKeyCountName ?>';
	loadjs.done("fcashier_eod_viewlist");
});
var fcashier_eod_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcashier_eod_viewlistsrch = currentSearchForm = new ew.Form("fcashier_eod_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fcashier_eod_viewlistsrch.filterList = <?php echo $cashier_eod_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcashier_eod_viewlistsrch.initSearchPanel = true;
	loadjs.done("fcashier_eod_viewlistsrch");
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
<?php if (!$cashier_eod_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($cashier_eod_view_list->TotalRecords > 0 && $cashier_eod_view_list->ExportOptions->visible()) { ?>
<?php $cashier_eod_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($cashier_eod_view_list->ImportOptions->visible()) { ?>
<?php $cashier_eod_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($cashier_eod_view_list->SearchOptions->visible()) { ?>
<?php $cashier_eod_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($cashier_eod_view_list->FilterOptions->visible()) { ?>
<?php $cashier_eod_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$cashier_eod_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$cashier_eod_view_list->isExport() && !$cashier_eod_view->CurrentAction) { ?>
<form name="fcashier_eod_viewlistsrch" id="fcashier_eod_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcashier_eod_viewlistsrch-search-panel" class="<?php echo $cashier_eod_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="cashier_eod_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $cashier_eod_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($cashier_eod_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($cashier_eod_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $cashier_eod_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($cashier_eod_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($cashier_eod_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($cashier_eod_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($cashier_eod_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $cashier_eod_view_list->showPageHeader(); ?>
<?php
$cashier_eod_view_list->showMessage();
?>
<?php if ($cashier_eod_view_list->TotalRecords > 0 || $cashier_eod_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($cashier_eod_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> cashier_eod_view">
<?php if (!$cashier_eod_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$cashier_eod_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cashier_eod_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cashier_eod_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcashier_eod_viewlist" id="fcashier_eod_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="cashier_eod_view">
<div id="gmp_cashier_eod_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($cashier_eod_view_list->TotalRecords > 0 || $cashier_eod_view_list->isGridEdit()) { ?>
<table id="tbl_cashier_eod_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$cashier_eod_view->RowType = ROWTYPE_HEADER;

// Render list options
$cashier_eod_view_list->renderListOptions();

// Render list options (header, left)
$cashier_eod_view_list->ListOptions->render("header", "left");
?>
<?php if ($cashier_eod_view_list->ReceiptedTotalAmount->Visible) { // ReceiptedTotalAmount ?>
	<?php if ($cashier_eod_view_list->SortUrl($cashier_eod_view_list->ReceiptedTotalAmount) == "") { ?>
		<th data-name="ReceiptedTotalAmount" class="<?php echo $cashier_eod_view_list->ReceiptedTotalAmount->headerCellClass() ?>"><div id="elh_cashier_eod_view_ReceiptedTotalAmount" class="cashier_eod_view_ReceiptedTotalAmount"><div class="ew-table-header-caption"><?php echo $cashier_eod_view_list->ReceiptedTotalAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptedTotalAmount" class="<?php echo $cashier_eod_view_list->ReceiptedTotalAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_eod_view_list->SortUrl($cashier_eod_view_list->ReceiptedTotalAmount) ?>', 1);"><div id="elh_cashier_eod_view_ReceiptedTotalAmount" class="cashier_eod_view_ReceiptedTotalAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_eod_view_list->ReceiptedTotalAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_eod_view_list->ReceiptedTotalAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_eod_view_list->ReceiptedTotalAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_eod_view_list->NoOfReceipts->Visible) { // NoOfReceipts ?>
	<?php if ($cashier_eod_view_list->SortUrl($cashier_eod_view_list->NoOfReceipts) == "") { ?>
		<th data-name="NoOfReceipts" class="<?php echo $cashier_eod_view_list->NoOfReceipts->headerCellClass() ?>"><div id="elh_cashier_eod_view_NoOfReceipts" class="cashier_eod_view_NoOfReceipts"><div class="ew-table-header-caption"><?php echo $cashier_eod_view_list->NoOfReceipts->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NoOfReceipts" class="<?php echo $cashier_eod_view_list->NoOfReceipts->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_eod_view_list->SortUrl($cashier_eod_view_list->NoOfReceipts) ?>', 1);"><div id="elh_cashier_eod_view_NoOfReceipts" class="cashier_eod_view_NoOfReceipts">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_eod_view_list->NoOfReceipts->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_eod_view_list->NoOfReceipts->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_eod_view_list->NoOfReceipts->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_eod_view_list->PaymentDesc->Visible) { // PaymentDesc ?>
	<?php if ($cashier_eod_view_list->SortUrl($cashier_eod_view_list->PaymentDesc) == "") { ?>
		<th data-name="PaymentDesc" class="<?php echo $cashier_eod_view_list->PaymentDesc->headerCellClass() ?>"><div id="elh_cashier_eod_view_PaymentDesc" class="cashier_eod_view_PaymentDesc"><div class="ew-table-header-caption"><?php echo $cashier_eod_view_list->PaymentDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentDesc" class="<?php echo $cashier_eod_view_list->PaymentDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_eod_view_list->SortUrl($cashier_eod_view_list->PaymentDesc) ?>', 1);"><div id="elh_cashier_eod_view_PaymentDesc" class="cashier_eod_view_PaymentDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_eod_view_list->PaymentDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cashier_eod_view_list->PaymentDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_eod_view_list->PaymentDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_eod_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($cashier_eod_view_list->SortUrl($cashier_eod_view_list->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $cashier_eod_view_list->ReceiptDate->headerCellClass() ?>"><div id="elh_cashier_eod_view_ReceiptDate" class="cashier_eod_view_ReceiptDate"><div class="ew-table-header-caption"><?php echo $cashier_eod_view_list->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $cashier_eod_view_list->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_eod_view_list->SortUrl($cashier_eod_view_list->ReceiptDate) ?>', 1);"><div id="elh_cashier_eod_view_ReceiptDate" class="cashier_eod_view_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_eod_view_list->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($cashier_eod_view_list->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_eod_view_list->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($cashier_eod_view_list->CashierNo->Visible) { // CashierNo ?>
	<?php if ($cashier_eod_view_list->SortUrl($cashier_eod_view_list->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $cashier_eod_view_list->CashierNo->headerCellClass() ?>"><div id="elh_cashier_eod_view_CashierNo" class="cashier_eod_view_CashierNo"><div class="ew-table-header-caption"><?php echo $cashier_eod_view_list->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $cashier_eod_view_list->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $cashier_eod_view_list->SortUrl($cashier_eod_view_list->CashierNo) ?>', 1);"><div id="elh_cashier_eod_view_CashierNo" class="cashier_eod_view_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $cashier_eod_view_list->CashierNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($cashier_eod_view_list->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($cashier_eod_view_list->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$cashier_eod_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($cashier_eod_view_list->ExportAll && $cashier_eod_view_list->isExport()) {
	$cashier_eod_view_list->StopRecord = $cashier_eod_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($cashier_eod_view_list->TotalRecords > $cashier_eod_view_list->StartRecord + $cashier_eod_view_list->DisplayRecords - 1)
		$cashier_eod_view_list->StopRecord = $cashier_eod_view_list->StartRecord + $cashier_eod_view_list->DisplayRecords - 1;
	else
		$cashier_eod_view_list->StopRecord = $cashier_eod_view_list->TotalRecords;
}
$cashier_eod_view_list->RecordCount = $cashier_eod_view_list->StartRecord - 1;
if ($cashier_eod_view_list->Recordset && !$cashier_eod_view_list->Recordset->EOF) {
	$cashier_eod_view_list->Recordset->moveFirst();
	$selectLimit = $cashier_eod_view_list->UseSelectLimit;
	if (!$selectLimit && $cashier_eod_view_list->StartRecord > 1)
		$cashier_eod_view_list->Recordset->move($cashier_eod_view_list->StartRecord - 1);
} elseif (!$cashier_eod_view->AllowAddDeleteRow && $cashier_eod_view_list->StopRecord == 0) {
	$cashier_eod_view_list->StopRecord = $cashier_eod_view->GridAddRowCount;
}

// Initialize aggregate
$cashier_eod_view->RowType = ROWTYPE_AGGREGATEINIT;
$cashier_eod_view->resetAttributes();
$cashier_eod_view_list->renderRow();
while ($cashier_eod_view_list->RecordCount < $cashier_eod_view_list->StopRecord) {
	$cashier_eod_view_list->RecordCount++;
	if ($cashier_eod_view_list->RecordCount >= $cashier_eod_view_list->StartRecord) {
		$cashier_eod_view_list->RowCount++;

		// Set up key count
		$cashier_eod_view_list->KeyCount = $cashier_eod_view_list->RowIndex;

		// Init row class and style
		$cashier_eod_view->resetAttributes();
		$cashier_eod_view->CssClass = "";
		if ($cashier_eod_view_list->isGridAdd()) {
		} else {
			$cashier_eod_view_list->loadRowValues($cashier_eod_view_list->Recordset); // Load row values
		}
		$cashier_eod_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$cashier_eod_view->RowAttrs->merge(["data-rowindex" => $cashier_eod_view_list->RowCount, "id" => "r" . $cashier_eod_view_list->RowCount . "_cashier_eod_view", "data-rowtype" => $cashier_eod_view->RowType]);

		// Render row
		$cashier_eod_view_list->renderRow();

		// Render list options
		$cashier_eod_view_list->renderListOptions();
?>
	<tr <?php echo $cashier_eod_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$cashier_eod_view_list->ListOptions->render("body", "left", $cashier_eod_view_list->RowCount);
?>
	<?php if ($cashier_eod_view_list->ReceiptedTotalAmount->Visible) { // ReceiptedTotalAmount ?>
		<td data-name="ReceiptedTotalAmount" <?php echo $cashier_eod_view_list->ReceiptedTotalAmount->cellAttributes() ?>>
<span id="el<?php echo $cashier_eod_view_list->RowCount ?>_cashier_eod_view_ReceiptedTotalAmount">
<span<?php echo $cashier_eod_view_list->ReceiptedTotalAmount->viewAttributes() ?>><?php echo $cashier_eod_view_list->ReceiptedTotalAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_eod_view_list->NoOfReceipts->Visible) { // NoOfReceipts ?>
		<td data-name="NoOfReceipts" <?php echo $cashier_eod_view_list->NoOfReceipts->cellAttributes() ?>>
<span id="el<?php echo $cashier_eod_view_list->RowCount ?>_cashier_eod_view_NoOfReceipts">
<span<?php echo $cashier_eod_view_list->NoOfReceipts->viewAttributes() ?>><?php echo $cashier_eod_view_list->NoOfReceipts->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_eod_view_list->PaymentDesc->Visible) { // PaymentDesc ?>
		<td data-name="PaymentDesc" <?php echo $cashier_eod_view_list->PaymentDesc->cellAttributes() ?>>
<span id="el<?php echo $cashier_eod_view_list->RowCount ?>_cashier_eod_view_PaymentDesc">
<span<?php echo $cashier_eod_view_list->PaymentDesc->viewAttributes() ?>><?php echo $cashier_eod_view_list->PaymentDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_eod_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $cashier_eod_view_list->ReceiptDate->cellAttributes() ?>>
<span id="el<?php echo $cashier_eod_view_list->RowCount ?>_cashier_eod_view_ReceiptDate">
<span<?php echo $cashier_eod_view_list->ReceiptDate->viewAttributes() ?>><?php echo $cashier_eod_view_list->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($cashier_eod_view_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $cashier_eod_view_list->CashierNo->cellAttributes() ?>>
<span id="el<?php echo $cashier_eod_view_list->RowCount ?>_cashier_eod_view_CashierNo">
<span<?php echo $cashier_eod_view_list->CashierNo->viewAttributes() ?>><?php echo $cashier_eod_view_list->CashierNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$cashier_eod_view_list->ListOptions->render("body", "right", $cashier_eod_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$cashier_eod_view_list->isGridAdd())
		$cashier_eod_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$cashier_eod_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($cashier_eod_view_list->Recordset)
	$cashier_eod_view_list->Recordset->Close();
?>
<?php if (!$cashier_eod_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$cashier_eod_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $cashier_eod_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $cashier_eod_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($cashier_eod_view_list->TotalRecords == 0 && !$cashier_eod_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $cashier_eod_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$cashier_eod_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$cashier_eod_view_list->isExport()) { ?>
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
$cashier_eod_view_list->terminate();
?>