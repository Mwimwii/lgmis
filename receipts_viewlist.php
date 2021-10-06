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
$receipts_view_list = new receipts_view_list();

// Run the page
$receipts_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipts_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$receipts_view_list->isExport()) { ?>
<script>
var freceipts_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freceipts_viewlist = currentForm = new ew.Form("freceipts_viewlist", "list");
	freceipts_viewlist.formKeyCountName = '<?php echo $receipts_view_list->FormKeyCountName ?>';
	loadjs.done("freceipts_viewlist");
});
var freceipts_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freceipts_viewlistsrch = currentSearchForm = new ew.Form("freceipts_viewlistsrch");

	// Dynamic selection lists
	// Filters

	freceipts_viewlistsrch.filterList = <?php echo $receipts_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	freceipts_viewlistsrch.initSearchPanel = true;
	loadjs.done("freceipts_viewlistsrch");
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
<?php if (!$receipts_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($receipts_view_list->TotalRecords > 0 && $receipts_view_list->ExportOptions->visible()) { ?>
<?php $receipts_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($receipts_view_list->ImportOptions->visible()) { ?>
<?php $receipts_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($receipts_view_list->SearchOptions->visible()) { ?>
<?php $receipts_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($receipts_view_list->FilterOptions->visible()) { ?>
<?php $receipts_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$receipts_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $receipts_view_list->isExport("print")) { ?>
<?php
if ($receipts_view_list->DbMasterFilter != "" && $receipts_view->getCurrentMasterTable() == "_property_account_view") {
	if ($receipts_view_list->MasterRecordExists) {
		include_once "_property_account_viewmaster.php";
	}
}
?>
<?php } ?>
<?php
$receipts_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$receipts_view_list->isExport() && !$receipts_view->CurrentAction) { ?>
<form name="freceipts_viewlistsrch" id="freceipts_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freceipts_viewlistsrch-search-panel" class="<?php echo $receipts_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="receipts_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $receipts_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($receipts_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($receipts_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $receipts_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($receipts_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($receipts_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($receipts_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($receipts_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $receipts_view_list->showPageHeader(); ?>
<?php
$receipts_view_list->showMessage();
?>
<?php if ($receipts_view_list->TotalRecords > 0 || $receipts_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($receipts_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> receipts_view">
<?php if (!$receipts_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$receipts_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipts_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipts_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freceipts_viewlist" id="freceipts_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipts_view">
<?php if ($receipts_view->getCurrentMasterTable() == "_property_account_view" && $receipts_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="_property_account_view">
<input type="hidden" name="fk_BillYear" value="<?php echo HtmlEncode($receipts_view_list->BillYear->getSessionValue()) ?>">
<input type="hidden" name="fk_BillPeriod" value="<?php echo HtmlEncode($receipts_view_list->BillPeriod->getSessionValue()) ?>">
<input type="hidden" name="fk_ValuationNo" value="<?php echo HtmlEncode($receipts_view_list->ItemID->getSessionValue()) ?>">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($receipts_view_list->ClientSerNo->getSessionValue()) ?>">
<input type="hidden" name="fk_ChargeCode" value="<?php echo HtmlEncode($receipts_view_list->ChargeCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_receipts_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($receipts_view_list->TotalRecords > 0 || $receipts_view_list->isGridEdit()) { ?>
<table id="tbl_receipts_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$receipts_view->RowType = ROWTYPE_HEADER;

// Render list options
$receipts_view_list->renderListOptions();

// Render list options (header, left)
$receipts_view_list->ListOptions->render("header", "left");
?>
<?php if ($receipts_view_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipts_view_list->ReceiptNo->headerCellClass() ?>"><div id="elh_receipts_view_ReceiptNo" class="receipts_view_ReceiptNo"><div class="ew-table-header-caption"><?php echo $receipts_view_list->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipts_view_list->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->ReceiptNo) ?>', 1);"><div id="elh_receipts_view_ReceiptNo" class="receipts_view_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipts_view_list->ClientSerNo->headerCellClass() ?>"><div id="elh_receipts_view_ClientSerNo" class="receipts_view_ClientSerNo"><div class="ew-table-header-caption"><?php echo $receipts_view_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipts_view_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->ClientSerNo) ?>', 1);"><div id="elh_receipts_view_ClientSerNo" class="receipts_view_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $receipts_view_list->ChargeCode->headerCellClass() ?>"><div id="elh_receipts_view_ChargeCode" class="receipts_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $receipts_view_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $receipts_view_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->ChargeCode) ?>', 1);"><div id="elh_receipts_view_ChargeCode" class="receipts_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipts_view_list->ReceiptDate->headerCellClass() ?>"><div id="elh_receipts_view_ReceiptDate" class="receipts_view_ReceiptDate"><div class="ew-table-header-caption"><?php echo $receipts_view_list->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipts_view_list->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->ReceiptDate) ?>', 1);"><div id="elh_receipts_view_ReceiptDate" class="receipts_view_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->ItemID->Visible) { // ItemID ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->ItemID) == "") { ?>
		<th data-name="ItemID" class="<?php echo $receipts_view_list->ItemID->headerCellClass() ?>"><div id="elh_receipts_view_ItemID" class="receipts_view_ItemID"><div class="ew-table-header-caption"><?php echo $receipts_view_list->ItemID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemID" class="<?php echo $receipts_view_list->ItemID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->ItemID) ?>', 1);"><div id="elh_receipts_view_ItemID" class="receipts_view_ItemID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->ItemID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->ItemID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->ItemID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $receipts_view_list->UnitCost->headerCellClass() ?>"><div id="elh_receipts_view_UnitCost" class="receipts_view_UnitCost"><div class="ew-table-header-caption"><?php echo $receipts_view_list->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $receipts_view_list->UnitCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->UnitCost) ?>', 1);"><div id="elh_receipts_view_UnitCost" class="receipts_view_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->Quantity->Visible) { // Quantity ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $receipts_view_list->Quantity->headerCellClass() ?>"><div id="elh_receipts_view_Quantity" class="receipts_view_Quantity"><div class="ew-table-header-caption"><?php echo $receipts_view_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $receipts_view_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->Quantity) ?>', 1);"><div id="elh_receipts_view_Quantity" class="receipts_view_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipts_view_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_receipts_view_UnitOfMeasure" class="receipts_view_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $receipts_view_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipts_view_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->UnitOfMeasure) ?>', 1);"><div id="elh_receipts_view_UnitOfMeasure" class="receipts_view_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $receipts_view_list->AmountPaid->headerCellClass() ?>"><div id="elh_receipts_view_AmountPaid" class="receipts_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $receipts_view_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $receipts_view_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->AmountPaid) ?>', 1);"><div id="elh_receipts_view_AmountPaid" class="receipts_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipts_view_list->PaymentMethod->headerCellClass() ?>"><div id="elh_receipts_view_PaymentMethod" class="receipts_view_PaymentMethod"><div class="ew-table-header-caption"><?php echo $receipts_view_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipts_view_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->PaymentMethod) ?>', 1);"><div id="elh_receipts_view_PaymentMethod" class="receipts_view_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->PaymentRef) == "") { ?>
		<th data-name="PaymentRef" class="<?php echo $receipts_view_list->PaymentRef->headerCellClass() ?>"><div id="elh_receipts_view_PaymentRef" class="receipts_view_PaymentRef"><div class="ew-table-header-caption"><?php echo $receipts_view_list->PaymentRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentRef" class="<?php echo $receipts_view_list->PaymentRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->PaymentRef) ?>', 1);"><div id="elh_receipts_view_PaymentRef" class="receipts_view_PaymentRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->PaymentRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->PaymentRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->PaymentRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $receipts_view_list->CashierNo->headerCellClass() ?>"><div id="elh_receipts_view_CashierNo" class="receipts_view_CashierNo"><div class="ew-table-header-caption"><?php echo $receipts_view_list->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $receipts_view_list->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->CashierNo) ?>', 1);"><div id="elh_receipts_view_CashierNo" class="receipts_view_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->CashierNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $receipts_view_list->BillPeriod->headerCellClass() ?>"><div id="elh_receipts_view_BillPeriod" class="receipts_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $receipts_view_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $receipts_view_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->BillPeriod) ?>', 1);"><div id="elh_receipts_view_BillPeriod" class="receipts_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->BillYear->Visible) { // BillYear ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $receipts_view_list->BillYear->headerCellClass() ?>"><div id="elh_receipts_view_BillYear" class="receipts_view_BillYear"><div class="ew-table-header-caption"><?php echo $receipts_view_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $receipts_view_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->BillYear) ?>', 1);"><div id="elh_receipts_view_BillYear" class="receipts_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->PaymentFor->Visible) { // PaymentFor ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->PaymentFor) == "") { ?>
		<th data-name="PaymentFor" class="<?php echo $receipts_view_list->PaymentFor->headerCellClass() ?>"><div id="elh_receipts_view_PaymentFor" class="receipts_view_PaymentFor"><div class="ew-table-header-caption"><?php echo $receipts_view_list->PaymentFor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentFor" class="<?php echo $receipts_view_list->PaymentFor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->PaymentFor) ?>', 1);"><div id="elh_receipts_view_PaymentFor" class="receipts_view_PaymentFor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->PaymentFor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->PaymentFor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->PaymentFor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipts_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipts_view_list->SortUrl($receipts_view_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipts_view_list->ChargeGroup->headerCellClass() ?>"><div id="elh_receipts_view_ChargeGroup" class="receipts_view_ChargeGroup"><div class="ew-table-header-caption"><?php echo $receipts_view_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipts_view_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipts_view_list->SortUrl($receipts_view_list->ChargeGroup) ?>', 1);"><div id="elh_receipts_view_ChargeGroup" class="receipts_view_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipts_view_list->ChargeGroup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipts_view_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipts_view_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipts_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($receipts_view_list->ExportAll && $receipts_view_list->isExport()) {
	$receipts_view_list->StopRecord = $receipts_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($receipts_view_list->TotalRecords > $receipts_view_list->StartRecord + $receipts_view_list->DisplayRecords - 1)
		$receipts_view_list->StopRecord = $receipts_view_list->StartRecord + $receipts_view_list->DisplayRecords - 1;
	else
		$receipts_view_list->StopRecord = $receipts_view_list->TotalRecords;
}
$receipts_view_list->RecordCount = $receipts_view_list->StartRecord - 1;
if ($receipts_view_list->Recordset && !$receipts_view_list->Recordset->EOF) {
	$receipts_view_list->Recordset->moveFirst();
	$selectLimit = $receipts_view_list->UseSelectLimit;
	if (!$selectLimit && $receipts_view_list->StartRecord > 1)
		$receipts_view_list->Recordset->move($receipts_view_list->StartRecord - 1);
} elseif (!$receipts_view->AllowAddDeleteRow && $receipts_view_list->StopRecord == 0) {
	$receipts_view_list->StopRecord = $receipts_view->GridAddRowCount;
}

// Initialize aggregate
$receipts_view->RowType = ROWTYPE_AGGREGATEINIT;
$receipts_view->resetAttributes();
$receipts_view_list->renderRow();
while ($receipts_view_list->RecordCount < $receipts_view_list->StopRecord) {
	$receipts_view_list->RecordCount++;
	if ($receipts_view_list->RecordCount >= $receipts_view_list->StartRecord) {
		$receipts_view_list->RowCount++;

		// Set up key count
		$receipts_view_list->KeyCount = $receipts_view_list->RowIndex;

		// Init row class and style
		$receipts_view->resetAttributes();
		$receipts_view->CssClass = "";
		if ($receipts_view_list->isGridAdd()) {
		} else {
			$receipts_view_list->loadRowValues($receipts_view_list->Recordset); // Load row values
		}
		$receipts_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$receipts_view->RowAttrs->merge(["data-rowindex" => $receipts_view_list->RowCount, "id" => "r" . $receipts_view_list->RowCount . "_receipts_view", "data-rowtype" => $receipts_view->RowType]);

		// Render row
		$receipts_view_list->renderRow();

		// Render list options
		$receipts_view_list->renderListOptions();
?>
	<tr <?php echo $receipts_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipts_view_list->ListOptions->render("body", "left", $receipts_view_list->RowCount);
?>
	<?php if ($receipts_view_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $receipts_view_list->ReceiptNo->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_ReceiptNo">
<span<?php echo $receipts_view_list->ReceiptNo->viewAttributes() ?>><?php echo $receipts_view_list->ReceiptNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $receipts_view_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_ClientSerNo">
<span<?php echo $receipts_view_list->ClientSerNo->viewAttributes() ?>><?php echo $receipts_view_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $receipts_view_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_ChargeCode">
<span<?php echo $receipts_view_list->ChargeCode->viewAttributes() ?>><?php echo $receipts_view_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $receipts_view_list->ReceiptDate->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_ReceiptDate">
<span<?php echo $receipts_view_list->ReceiptDate->viewAttributes() ?>><?php echo $receipts_view_list->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" <?php echo $receipts_view_list->ItemID->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_ItemID">
<span<?php echo $receipts_view_list->ItemID->viewAttributes() ?>><?php echo $receipts_view_list->ItemID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $receipts_view_list->UnitCost->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_UnitCost">
<span<?php echo $receipts_view_list->UnitCost->viewAttributes() ?>><?php echo $receipts_view_list->UnitCost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $receipts_view_list->Quantity->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_Quantity">
<span<?php echo $receipts_view_list->Quantity->viewAttributes() ?>><?php echo $receipts_view_list->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $receipts_view_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_UnitOfMeasure">
<span<?php echo $receipts_view_list->UnitOfMeasure->viewAttributes() ?>><?php echo $receipts_view_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $receipts_view_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_AmountPaid">
<span<?php echo $receipts_view_list->AmountPaid->viewAttributes() ?>><?php echo $receipts_view_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $receipts_view_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_PaymentMethod">
<span<?php echo $receipts_view_list->PaymentMethod->viewAttributes() ?>><?php echo $receipts_view_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" <?php echo $receipts_view_list->PaymentRef->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_PaymentRef">
<span<?php echo $receipts_view_list->PaymentRef->viewAttributes() ?>><?php echo $receipts_view_list->PaymentRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $receipts_view_list->CashierNo->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_CashierNo">
<span<?php echo $receipts_view_list->CashierNo->viewAttributes() ?>><?php echo $receipts_view_list->CashierNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $receipts_view_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_BillPeriod">
<span<?php echo $receipts_view_list->BillPeriod->viewAttributes() ?>><?php echo $receipts_view_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $receipts_view_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_BillYear">
<span<?php echo $receipts_view_list->BillYear->viewAttributes() ?>><?php echo $receipts_view_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->PaymentFor->Visible) { // PaymentFor ?>
		<td data-name="PaymentFor" <?php echo $receipts_view_list->PaymentFor->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_PaymentFor">
<span<?php echo $receipts_view_list->PaymentFor->viewAttributes() ?>><?php echo $receipts_view_list->PaymentFor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipts_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $receipts_view_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $receipts_view_list->RowCount ?>_receipts_view_ChargeGroup">
<span<?php echo $receipts_view_list->ChargeGroup->viewAttributes() ?>><?php echo $receipts_view_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipts_view_list->ListOptions->render("body", "right", $receipts_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$receipts_view_list->isGridAdd())
		$receipts_view_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$receipts_view->RowType = ROWTYPE_AGGREGATE;
$receipts_view->resetAttributes();
$receipts_view_list->renderRow();
?>
<?php if ($receipts_view_list->TotalRecords > 0 && !$receipts_view_list->isGridAdd() && !$receipts_view_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$receipts_view_list->renderListOptions();

// Render list options (footer, left)
$receipts_view_list->ListOptions->render("footer", "left");
?>
	<?php if ($receipts_view_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" class="<?php echo $receipts_view_list->ReceiptNo->footerCellClass() ?>"><span id="elf_receipts_view_ReceiptNo" class="receipts_view_ReceiptNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" class="<?php echo $receipts_view_list->ClientSerNo->footerCellClass() ?>"><span id="elf_receipts_view_ClientSerNo" class="receipts_view_ClientSerNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" class="<?php echo $receipts_view_list->ChargeCode->footerCellClass() ?>"><span id="elf_receipts_view_ChargeCode" class="receipts_view_ChargeCode">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" class="<?php echo $receipts_view_list->ReceiptDate->footerCellClass() ?>"><span id="elf_receipts_view_ReceiptDate" class="receipts_view_ReceiptDate">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" class="<?php echo $receipts_view_list->ItemID->footerCellClass() ?>"><span id="elf_receipts_view_ItemID" class="receipts_view_ItemID">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" class="<?php echo $receipts_view_list->UnitCost->footerCellClass() ?>"><span id="elf_receipts_view_UnitCost" class="receipts_view_UnitCost">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" class="<?php echo $receipts_view_list->Quantity->footerCellClass() ?>"><span id="elf_receipts_view_Quantity" class="receipts_view_Quantity">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" class="<?php echo $receipts_view_list->UnitOfMeasure->footerCellClass() ?>"><span id="elf_receipts_view_UnitOfMeasure" class="receipts_view_UnitOfMeasure">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $receipts_view_list->AmountPaid->footerCellClass() ?>"><span id="elf_receipts_view_AmountPaid" class="receipts_view_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $receipts_view_list->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" class="<?php echo $receipts_view_list->PaymentMethod->footerCellClass() ?>"><span id="elf_receipts_view_PaymentMethod" class="receipts_view_PaymentMethod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" class="<?php echo $receipts_view_list->PaymentRef->footerCellClass() ?>"><span id="elf_receipts_view_PaymentRef" class="receipts_view_PaymentRef">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" class="<?php echo $receipts_view_list->CashierNo->footerCellClass() ?>"><span id="elf_receipts_view_CashierNo" class="receipts_view_CashierNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" class="<?php echo $receipts_view_list->BillPeriod->footerCellClass() ?>"><span id="elf_receipts_view_BillPeriod" class="receipts_view_BillPeriod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" class="<?php echo $receipts_view_list->BillYear->footerCellClass() ?>"><span id="elf_receipts_view_BillYear" class="receipts_view_BillYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->PaymentFor->Visible) { // PaymentFor ?>
		<td data-name="PaymentFor" class="<?php echo $receipts_view_list->PaymentFor->footerCellClass() ?>"><span id="elf_receipts_view_PaymentFor" class="receipts_view_PaymentFor">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($receipts_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" class="<?php echo $receipts_view_list->ChargeGroup->footerCellClass() ?>"><span id="elf_receipts_view_ChargeGroup" class="receipts_view_ChargeGroup">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$receipts_view_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$receipts_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($receipts_view_list->Recordset)
	$receipts_view_list->Recordset->Close();
?>
<?php if (!$receipts_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$receipts_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipts_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipts_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($receipts_view_list->TotalRecords == 0 && !$receipts_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $receipts_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$receipts_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$receipts_view_list->isExport()) { ?>
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
$receipts_view_list->terminate();
?>