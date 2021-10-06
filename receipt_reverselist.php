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
$receipt_reverse_list = new receipt_reverse_list();

// Run the page
$receipt_reverse_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$receipt_reverse_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$receipt_reverse_list->isExport()) { ?>
<script>
var freceipt_reverselist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	freceipt_reverselist = currentForm = new ew.Form("freceipt_reverselist", "list");
	freceipt_reverselist.formKeyCountName = '<?php echo $receipt_reverse_list->FormKeyCountName ?>';
	loadjs.done("freceipt_reverselist");
});
var freceipt_reverselistsrch;
loadjs.ready("head", function() {

	// Form object for search
	freceipt_reverselistsrch = currentSearchForm = new ew.Form("freceipt_reverselistsrch");

	// Dynamic selection lists
	// Filters

	freceipt_reverselistsrch.filterList = <?php echo $receipt_reverse_list->getFilterList() ?>;

	// Init search panel as collapsed
	freceipt_reverselistsrch.initSearchPanel = true;
	loadjs.done("freceipt_reverselistsrch");
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
<?php if (!$receipt_reverse_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($receipt_reverse_list->TotalRecords > 0 && $receipt_reverse_list->ExportOptions->visible()) { ?>
<?php $receipt_reverse_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_reverse_list->ImportOptions->visible()) { ?>
<?php $receipt_reverse_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_reverse_list->SearchOptions->visible()) { ?>
<?php $receipt_reverse_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($receipt_reverse_list->FilterOptions->visible()) { ?>
<?php $receipt_reverse_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$receipt_reverse_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$receipt_reverse_list->isExport() && !$receipt_reverse->CurrentAction) { ?>
<form name="freceipt_reverselistsrch" id="freceipt_reverselistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="freceipt_reverselistsrch-search-panel" class="<?php echo $receipt_reverse_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="receipt_reverse">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $receipt_reverse_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($receipt_reverse_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($receipt_reverse_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $receipt_reverse_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($receipt_reverse_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($receipt_reverse_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($receipt_reverse_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($receipt_reverse_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $receipt_reverse_list->showPageHeader(); ?>
<?php
$receipt_reverse_list->showMessage();
?>
<?php if ($receipt_reverse_list->TotalRecords > 0 || $receipt_reverse->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($receipt_reverse_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> receipt_reverse">
<?php if (!$receipt_reverse_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$receipt_reverse_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_reverse_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipt_reverse_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="freceipt_reverselist" id="freceipt_reverselist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="receipt_reverse">
<div id="gmp_receipt_reverse" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($receipt_reverse_list->TotalRecords > 0 || $receipt_reverse_list->isGridEdit()) { ?>
<table id="tbl_receipt_reverselist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$receipt_reverse->RowType = ROWTYPE_HEADER;

// Render list options
$receipt_reverse_list->renderListOptions();

// Render list options (header, left)
$receipt_reverse_list->ListOptions->render("header", "left");
?>
<?php if ($receipt_reverse_list->ReversalRef->Visible) { // ReversalRef ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ReversalRef) == "") { ?>
		<th data-name="ReversalRef" class="<?php echo $receipt_reverse_list->ReversalRef->headerCellClass() ?>"><div id="elh_receipt_reverse_ReversalRef" class="receipt_reverse_ReversalRef"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ReversalRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReversalRef" class="<?php echo $receipt_reverse_list->ReversalRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ReversalRef) ?>', 1);"><div id="elh_receipt_reverse_ReversalRef" class="receipt_reverse_ReversalRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ReversalRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ReversalRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ReversalRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_reverse_list->ReceiptNo->headerCellClass() ?>"><div id="elh_receipt_reverse_ReceiptNo" class="receipt_reverse_ReceiptNo"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $receipt_reverse_list->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ReceiptNo) ?>', 1);"><div id="elh_receipt_reverse_ReceiptNo" class="receipt_reverse_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ReceiptNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_reverse_list->ClientSerNo->headerCellClass() ?>"><div id="elh_receipt_reverse_ClientSerNo" class="receipt_reverse_ClientSerNo"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $receipt_reverse_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ClientSerNo) ?>', 1);"><div id="elh_receipt_reverse_ClientSerNo" class="receipt_reverse_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $receipt_reverse_list->ChargeCode->headerCellClass() ?>"><div id="elh_receipt_reverse_ChargeCode" class="receipt_reverse_ChargeCode"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $receipt_reverse_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ChargeCode) ?>', 1);"><div id="elh_receipt_reverse_ChargeCode" class="receipt_reverse_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->ReceiptDate->Visible) { // ReceiptDate ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ReceiptDate) == "") { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_reverse_list->ReceiptDate->headerCellClass() ?>"><div id="elh_receipt_reverse_ReceiptDate" class="receipt_reverse_ReceiptDate"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ReceiptDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptDate" class="<?php echo $receipt_reverse_list->ReceiptDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ReceiptDate) ?>', 1);"><div id="elh_receipt_reverse_ReceiptDate" class="receipt_reverse_ReceiptDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ReceiptDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ReceiptDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ReceiptDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->ItemID->Visible) { // ItemID ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ItemID) == "") { ?>
		<th data-name="ItemID" class="<?php echo $receipt_reverse_list->ItemID->headerCellClass() ?>"><div id="elh_receipt_reverse_ItemID" class="receipt_reverse_ItemID"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ItemID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ItemID" class="<?php echo $receipt_reverse_list->ItemID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ItemID) ?>', 1);"><div id="elh_receipt_reverse_ItemID" class="receipt_reverse_ItemID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ItemID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ItemID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ItemID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->UnitCost->Visible) { // UnitCost ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->UnitCost) == "") { ?>
		<th data-name="UnitCost" class="<?php echo $receipt_reverse_list->UnitCost->headerCellClass() ?>"><div id="elh_receipt_reverse_UnitCost" class="receipt_reverse_UnitCost"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->UnitCost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitCost" class="<?php echo $receipt_reverse_list->UnitCost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->UnitCost) ?>', 1);"><div id="elh_receipt_reverse_UnitCost" class="receipt_reverse_UnitCost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->UnitCost->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->UnitCost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->UnitCost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->Quantity->Visible) { // Quantity ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->Quantity) == "") { ?>
		<th data-name="Quantity" class="<?php echo $receipt_reverse_list->Quantity->headerCellClass() ?>"><div id="elh_receipt_reverse_Quantity" class="receipt_reverse_Quantity"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->Quantity->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Quantity" class="<?php echo $receipt_reverse_list->Quantity->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->Quantity) ?>', 1);"><div id="elh_receipt_reverse_Quantity" class="receipt_reverse_Quantity">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->Quantity->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->Quantity->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->Quantity->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipt_reverse_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_receipt_reverse_UnitOfMeasure" class="receipt_reverse_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $receipt_reverse_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->UnitOfMeasure) ?>', 1);"><div id="elh_receipt_reverse_UnitOfMeasure" class="receipt_reverse_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $receipt_reverse_list->AmountPaid->headerCellClass() ?>"><div id="elh_receipt_reverse_AmountPaid" class="receipt_reverse_AmountPaid"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $receipt_reverse_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->AmountPaid) ?>', 1);"><div id="elh_receipt_reverse_AmountPaid" class="receipt_reverse_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_reverse_list->PaymentMethod->headerCellClass() ?>"><div id="elh_receipt_reverse_PaymentMethod" class="receipt_reverse_PaymentMethod"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $receipt_reverse_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->PaymentMethod) ?>', 1);"><div id="elh_receipt_reverse_PaymentMethod" class="receipt_reverse_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->PaymentRef->Visible) { // PaymentRef ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->PaymentRef) == "") { ?>
		<th data-name="PaymentRef" class="<?php echo $receipt_reverse_list->PaymentRef->headerCellClass() ?>"><div id="elh_receipt_reverse_PaymentRef" class="receipt_reverse_PaymentRef"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->PaymentRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentRef" class="<?php echo $receipt_reverse_list->PaymentRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->PaymentRef) ?>', 1);"><div id="elh_receipt_reverse_PaymentRef" class="receipt_reverse_PaymentRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->PaymentRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->PaymentRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->PaymentRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->CashierNo->Visible) { // CashierNo ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->CashierNo) == "") { ?>
		<th data-name="CashierNo" class="<?php echo $receipt_reverse_list->CashierNo->headerCellClass() ?>"><div id="elh_receipt_reverse_CashierNo" class="receipt_reverse_CashierNo"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->CashierNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CashierNo" class="<?php echo $receipt_reverse_list->CashierNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->CashierNo) ?>', 1);"><div id="elh_receipt_reverse_CashierNo" class="receipt_reverse_CashierNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->CashierNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->CashierNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->CashierNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $receipt_reverse_list->BillPeriod->headerCellClass() ?>"><div id="elh_receipt_reverse_BillPeriod" class="receipt_reverse_BillPeriod"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $receipt_reverse_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->BillPeriod) ?>', 1);"><div id="elh_receipt_reverse_BillPeriod" class="receipt_reverse_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->BillYear->Visible) { // BillYear ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $receipt_reverse_list->BillYear->headerCellClass() ?>"><div id="elh_receipt_reverse_BillYear" class="receipt_reverse_BillYear"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $receipt_reverse_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->BillYear) ?>', 1);"><div id="elh_receipt_reverse_BillYear" class="receipt_reverse_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->PaymentFor->Visible) { // PaymentFor ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->PaymentFor) == "") { ?>
		<th data-name="PaymentFor" class="<?php echo $receipt_reverse_list->PaymentFor->headerCellClass() ?>"><div id="elh_receipt_reverse_PaymentFor" class="receipt_reverse_PaymentFor"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->PaymentFor->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentFor" class="<?php echo $receipt_reverse_list->PaymentFor->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->PaymentFor) ?>', 1);"><div id="elh_receipt_reverse_PaymentFor" class="receipt_reverse_PaymentFor">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->PaymentFor->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->PaymentFor->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->PaymentFor->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $receipt_reverse_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_receipt_reverse_LastUpdatedBy" class="receipt_reverse_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $receipt_reverse_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->LastUpdatedBy) ?>', 1);"><div id="elh_receipt_reverse_LastUpdatedBy" class="receipt_reverse_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $receipt_reverse_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_receipt_reverse_LastUpdateDate" class="receipt_reverse_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $receipt_reverse_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->LastUpdateDate) ?>', 1);"><div id="elh_receipt_reverse_LastUpdateDate" class="receipt_reverse_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($receipt_reverse_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($receipt_reverse_list->SortUrl($receipt_reverse_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_reverse_list->ChargeGroup->headerCellClass() ?>"><div id="elh_receipt_reverse_ChargeGroup" class="receipt_reverse_ChargeGroup"><div class="ew-table-header-caption"><?php echo $receipt_reverse_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $receipt_reverse_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $receipt_reverse_list->SortUrl($receipt_reverse_list->ChargeGroup) ?>', 1);"><div id="elh_receipt_reverse_ChargeGroup" class="receipt_reverse_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $receipt_reverse_list->ChargeGroup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($receipt_reverse_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($receipt_reverse_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$receipt_reverse_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($receipt_reverse_list->ExportAll && $receipt_reverse_list->isExport()) {
	$receipt_reverse_list->StopRecord = $receipt_reverse_list->TotalRecords;
} else {

	// Set the last record to display
	if ($receipt_reverse_list->TotalRecords > $receipt_reverse_list->StartRecord + $receipt_reverse_list->DisplayRecords - 1)
		$receipt_reverse_list->StopRecord = $receipt_reverse_list->StartRecord + $receipt_reverse_list->DisplayRecords - 1;
	else
		$receipt_reverse_list->StopRecord = $receipt_reverse_list->TotalRecords;
}
$receipt_reverse_list->RecordCount = $receipt_reverse_list->StartRecord - 1;
if ($receipt_reverse_list->Recordset && !$receipt_reverse_list->Recordset->EOF) {
	$receipt_reverse_list->Recordset->moveFirst();
	$selectLimit = $receipt_reverse_list->UseSelectLimit;
	if (!$selectLimit && $receipt_reverse_list->StartRecord > 1)
		$receipt_reverse_list->Recordset->move($receipt_reverse_list->StartRecord - 1);
} elseif (!$receipt_reverse->AllowAddDeleteRow && $receipt_reverse_list->StopRecord == 0) {
	$receipt_reverse_list->StopRecord = $receipt_reverse->GridAddRowCount;
}

// Initialize aggregate
$receipt_reverse->RowType = ROWTYPE_AGGREGATEINIT;
$receipt_reverse->resetAttributes();
$receipt_reverse_list->renderRow();
while ($receipt_reverse_list->RecordCount < $receipt_reverse_list->StopRecord) {
	$receipt_reverse_list->RecordCount++;
	if ($receipt_reverse_list->RecordCount >= $receipt_reverse_list->StartRecord) {
		$receipt_reverse_list->RowCount++;

		// Set up key count
		$receipt_reverse_list->KeyCount = $receipt_reverse_list->RowIndex;

		// Init row class and style
		$receipt_reverse->resetAttributes();
		$receipt_reverse->CssClass = "";
		if ($receipt_reverse_list->isGridAdd()) {
		} else {
			$receipt_reverse_list->loadRowValues($receipt_reverse_list->Recordset); // Load row values
		}
		$receipt_reverse->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$receipt_reverse->RowAttrs->merge(["data-rowindex" => $receipt_reverse_list->RowCount, "id" => "r" . $receipt_reverse_list->RowCount . "_receipt_reverse", "data-rowtype" => $receipt_reverse->RowType]);

		// Render row
		$receipt_reverse_list->renderRow();

		// Render list options
		$receipt_reverse_list->renderListOptions();
?>
	<tr <?php echo $receipt_reverse->rowAttributes() ?>>
<?php

// Render list options (body, left)
$receipt_reverse_list->ListOptions->render("body", "left", $receipt_reverse_list->RowCount);
?>
	<?php if ($receipt_reverse_list->ReversalRef->Visible) { // ReversalRef ?>
		<td data-name="ReversalRef" <?php echo $receipt_reverse_list->ReversalRef->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ReversalRef">
<span<?php echo $receipt_reverse_list->ReversalRef->viewAttributes() ?>><?php echo $receipt_reverse_list->ReversalRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $receipt_reverse_list->ReceiptNo->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ReceiptNo">
<span<?php echo $receipt_reverse_list->ReceiptNo->viewAttributes() ?>><?php echo $receipt_reverse_list->ReceiptNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $receipt_reverse_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ClientSerNo">
<span<?php echo $receipt_reverse_list->ClientSerNo->viewAttributes() ?>><?php echo $receipt_reverse_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $receipt_reverse_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ChargeCode">
<span<?php echo $receipt_reverse_list->ChargeCode->viewAttributes() ?>><?php echo $receipt_reverse_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->ReceiptDate->Visible) { // ReceiptDate ?>
		<td data-name="ReceiptDate" <?php echo $receipt_reverse_list->ReceiptDate->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ReceiptDate">
<span<?php echo $receipt_reverse_list->ReceiptDate->viewAttributes() ?>><?php echo $receipt_reverse_list->ReceiptDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->ItemID->Visible) { // ItemID ?>
		<td data-name="ItemID" <?php echo $receipt_reverse_list->ItemID->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ItemID">
<span<?php echo $receipt_reverse_list->ItemID->viewAttributes() ?>><?php echo $receipt_reverse_list->ItemID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->UnitCost->Visible) { // UnitCost ?>
		<td data-name="UnitCost" <?php echo $receipt_reverse_list->UnitCost->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_UnitCost">
<span<?php echo $receipt_reverse_list->UnitCost->viewAttributes() ?>><?php echo $receipt_reverse_list->UnitCost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->Quantity->Visible) { // Quantity ?>
		<td data-name="Quantity" <?php echo $receipt_reverse_list->Quantity->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_Quantity">
<span<?php echo $receipt_reverse_list->Quantity->viewAttributes() ?>><?php echo $receipt_reverse_list->Quantity->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $receipt_reverse_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_UnitOfMeasure">
<span<?php echo $receipt_reverse_list->UnitOfMeasure->viewAttributes() ?>><?php echo $receipt_reverse_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $receipt_reverse_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_AmountPaid">
<span<?php echo $receipt_reverse_list->AmountPaid->viewAttributes() ?>><?php echo $receipt_reverse_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $receipt_reverse_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_PaymentMethod">
<span<?php echo $receipt_reverse_list->PaymentMethod->viewAttributes() ?>><?php echo $receipt_reverse_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->PaymentRef->Visible) { // PaymentRef ?>
		<td data-name="PaymentRef" <?php echo $receipt_reverse_list->PaymentRef->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_PaymentRef">
<span<?php echo $receipt_reverse_list->PaymentRef->viewAttributes() ?>><?php echo $receipt_reverse_list->PaymentRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->CashierNo->Visible) { // CashierNo ?>
		<td data-name="CashierNo" <?php echo $receipt_reverse_list->CashierNo->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_CashierNo">
<span<?php echo $receipt_reverse_list->CashierNo->viewAttributes() ?>><?php echo $receipt_reverse_list->CashierNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $receipt_reverse_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_BillPeriod">
<span<?php echo $receipt_reverse_list->BillPeriod->viewAttributes() ?>><?php echo $receipt_reverse_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $receipt_reverse_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_BillYear">
<span<?php echo $receipt_reverse_list->BillYear->viewAttributes() ?>><?php echo $receipt_reverse_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->PaymentFor->Visible) { // PaymentFor ?>
		<td data-name="PaymentFor" <?php echo $receipt_reverse_list->PaymentFor->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_PaymentFor">
<span<?php echo $receipt_reverse_list->PaymentFor->viewAttributes() ?>><?php echo $receipt_reverse_list->PaymentFor->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $receipt_reverse_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_LastUpdatedBy">
<span<?php echo $receipt_reverse_list->LastUpdatedBy->viewAttributes() ?>><?php echo $receipt_reverse_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $receipt_reverse_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_LastUpdateDate">
<span<?php echo $receipt_reverse_list->LastUpdateDate->viewAttributes() ?>><?php echo $receipt_reverse_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($receipt_reverse_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $receipt_reverse_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $receipt_reverse_list->RowCount ?>_receipt_reverse_ChargeGroup">
<span<?php echo $receipt_reverse_list->ChargeGroup->viewAttributes() ?>><?php echo $receipt_reverse_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$receipt_reverse_list->ListOptions->render("body", "right", $receipt_reverse_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$receipt_reverse_list->isGridAdd())
		$receipt_reverse_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$receipt_reverse->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($receipt_reverse_list->Recordset)
	$receipt_reverse_list->Recordset->Close();
?>
<?php if (!$receipt_reverse_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$receipt_reverse_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $receipt_reverse_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $receipt_reverse_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($receipt_reverse_list->TotalRecords == 0 && !$receipt_reverse->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $receipt_reverse_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$receipt_reverse_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$receipt_reverse_list->isExport()) { ?>
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
$receipt_reverse_list->terminate();
?>