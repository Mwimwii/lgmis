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
$market_trans_list = new market_trans_list();

// Run the page
$market_trans_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$market_trans_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$market_trans_list->isExport()) { ?>
<script>
var fmarket_translist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmarket_translist = currentForm = new ew.Form("fmarket_translist", "list");
	fmarket_translist.formKeyCountName = '<?php echo $market_trans_list->FormKeyCountName ?>';
	loadjs.done("fmarket_translist");
});
var fmarket_translistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmarket_translistsrch = currentSearchForm = new ew.Form("fmarket_translistsrch");

	// Dynamic selection lists
	// Filters

	fmarket_translistsrch.filterList = <?php echo $market_trans_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmarket_translistsrch.initSearchPanel = true;
	loadjs.done("fmarket_translistsrch");
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
<?php if (!$market_trans_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($market_trans_list->TotalRecords > 0 && $market_trans_list->ExportOptions->visible()) { ?>
<?php $market_trans_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($market_trans_list->ImportOptions->visible()) { ?>
<?php $market_trans_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($market_trans_list->SearchOptions->visible()) { ?>
<?php $market_trans_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($market_trans_list->FilterOptions->visible()) { ?>
<?php $market_trans_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$market_trans_list->isExport() || Config("EXPORT_MASTER_RECORD") && $market_trans_list->isExport("print")) { ?>
<?php
if ($market_trans_list->DbMasterFilter != "" && $market_trans->getCurrentMasterTable() == "market_property") {
	if ($market_trans_list->MasterRecordExists) {
		include_once "market_propertymaster.php";
	}
}
?>
<?php } ?>
<?php
$market_trans_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$market_trans_list->isExport() && !$market_trans->CurrentAction) { ?>
<form name="fmarket_translistsrch" id="fmarket_translistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmarket_translistsrch-search-panel" class="<?php echo $market_trans_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="market_trans">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $market_trans_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($market_trans_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($market_trans_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $market_trans_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($market_trans_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($market_trans_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($market_trans_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($market_trans_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $market_trans_list->showPageHeader(); ?>
<?php
$market_trans_list->showMessage();
?>
<?php if ($market_trans_list->TotalRecords > 0 || $market_trans->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($market_trans_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> market_trans">
<?php if (!$market_trans_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$market_trans_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $market_trans_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $market_trans_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmarket_translist" id="fmarket_translist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="market_trans">
<?php if ($market_trans->getCurrentMasterTable() == "market_property" && $market_trans->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="market_property">
<input type="hidden" name="fk_MarketItemNo" value="<?php echo HtmlEncode($market_trans_list->MarketItemNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_market_trans" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($market_trans_list->TotalRecords > 0 || $market_trans_list->isGridEdit()) { ?>
<table id="tbl_market_translist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$market_trans->RowType = ROWTYPE_HEADER;

// Render list options
$market_trans_list->renderListOptions();

// Render list options (header, left)
$market_trans_list->ListOptions->render("header", "left");
?>
<?php if ($market_trans_list->TransNo->Visible) { // TransNo ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->TransNo) == "") { ?>
		<th data-name="TransNo" class="<?php echo $market_trans_list->TransNo->headerCellClass() ?>"><div id="elh_market_trans_TransNo" class="market_trans_TransNo"><div class="ew-table-header-caption"><?php echo $market_trans_list->TransNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransNo" class="<?php echo $market_trans_list->TransNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->TransNo) ?>', 1);"><div id="elh_market_trans_TransNo" class="market_trans_TransNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->TransNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->TransNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->TransNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->MarketItemNo->Visible) { // MarketItemNo ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->MarketItemNo) == "") { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_trans_list->MarketItemNo->headerCellClass() ?>"><div id="elh_market_trans_MarketItemNo" class="market_trans_MarketItemNo"><div class="ew-table-header-caption"><?php echo $market_trans_list->MarketItemNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MarketItemNo" class="<?php echo $market_trans_list->MarketItemNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->MarketItemNo) ?>', 1);"><div id="elh_market_trans_MarketItemNo" class="market_trans_MarketItemNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->MarketItemNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->MarketItemNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->MarketItemNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->DateHired->Visible) { // DateHired ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->DateHired) == "") { ?>
		<th data-name="DateHired" class="<?php echo $market_trans_list->DateHired->headerCellClass() ?>"><div id="elh_market_trans_DateHired" class="market_trans_DateHired"><div class="ew-table-header-caption"><?php echo $market_trans_list->DateHired->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateHired" class="<?php echo $market_trans_list->DateHired->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->DateHired) ?>', 1);"><div id="elh_market_trans_DateHired" class="market_trans_DateHired">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->DateHired->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->DateHired->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->DateHired->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->MartketeerName->Visible) { // MartketeerName ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->MartketeerName) == "") { ?>
		<th data-name="MartketeerName" class="<?php echo $market_trans_list->MartketeerName->headerCellClass() ?>"><div id="elh_market_trans_MartketeerName" class="market_trans_MartketeerName"><div class="ew-table-header-caption"><?php echo $market_trans_list->MartketeerName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MartketeerName" class="<?php echo $market_trans_list->MartketeerName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->MartketeerName) ?>', 1);"><div id="elh_market_trans_MartketeerName" class="market_trans_MartketeerName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->MartketeerName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->MartketeerName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->MartketeerName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->MartketeerID->Visible) { // MartketeerID ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->MartketeerID) == "") { ?>
		<th data-name="MartketeerID" class="<?php echo $market_trans_list->MartketeerID->headerCellClass() ?>"><div id="elh_market_trans_MartketeerID" class="market_trans_MartketeerID"><div class="ew-table-header-caption"><?php echo $market_trans_list->MartketeerID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MartketeerID" class="<?php echo $market_trans_list->MartketeerID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->MartketeerID) ?>', 1);"><div id="elh_market_trans_MartketeerID" class="market_trans_MartketeerID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->MartketeerID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->MartketeerID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->MartketeerID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->AmountDue->Visible) { // AmountDue ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->AmountDue) == "") { ?>
		<th data-name="AmountDue" class="<?php echo $market_trans_list->AmountDue->headerCellClass() ?>"><div id="elh_market_trans_AmountDue" class="market_trans_AmountDue"><div class="ew-table-header-caption"><?php echo $market_trans_list->AmountDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountDue" class="<?php echo $market_trans_list->AmountDue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->AmountDue) ?>', 1);"><div id="elh_market_trans_AmountDue" class="market_trans_AmountDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->AmountDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->AmountDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $market_trans_list->AmountPaid->headerCellClass() ?>"><div id="elh_market_trans_AmountPaid" class="market_trans_AmountPaid"><div class="ew-table-header-caption"><?php echo $market_trans_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $market_trans_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->AmountPaid) ?>', 1);"><div id="elh_market_trans_AmountPaid" class="market_trans_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->ReceiptNo->Visible) { // ReceiptNo ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->ReceiptNo) == "") { ?>
		<th data-name="ReceiptNo" class="<?php echo $market_trans_list->ReceiptNo->headerCellClass() ?>"><div id="elh_market_trans_ReceiptNo" class="market_trans_ReceiptNo"><div class="ew-table-header-caption"><?php echo $market_trans_list->ReceiptNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReceiptNo" class="<?php echo $market_trans_list->ReceiptNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->ReceiptNo) ?>', 1);"><div id="elh_market_trans_ReceiptNo" class="market_trans_ReceiptNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->ReceiptNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->ReceiptNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->ReceiptNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_trans_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_market_trans_LastUpdatedBy" class="market_trans_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $market_trans_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $market_trans_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->LastUpdatedBy) ?>', 1);"><div id="elh_market_trans_LastUpdatedBy" class="market_trans_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($market_trans_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($market_trans_list->SortUrl($market_trans_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_trans_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_market_trans_LastUpdateDate" class="market_trans_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $market_trans_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $market_trans_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $market_trans_list->SortUrl($market_trans_list->LastUpdateDate) ?>', 1);"><div id="elh_market_trans_LastUpdateDate" class="market_trans_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $market_trans_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($market_trans_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($market_trans_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$market_trans_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($market_trans_list->ExportAll && $market_trans_list->isExport()) {
	$market_trans_list->StopRecord = $market_trans_list->TotalRecords;
} else {

	// Set the last record to display
	if ($market_trans_list->TotalRecords > $market_trans_list->StartRecord + $market_trans_list->DisplayRecords - 1)
		$market_trans_list->StopRecord = $market_trans_list->StartRecord + $market_trans_list->DisplayRecords - 1;
	else
		$market_trans_list->StopRecord = $market_trans_list->TotalRecords;
}
$market_trans_list->RecordCount = $market_trans_list->StartRecord - 1;
if ($market_trans_list->Recordset && !$market_trans_list->Recordset->EOF) {
	$market_trans_list->Recordset->moveFirst();
	$selectLimit = $market_trans_list->UseSelectLimit;
	if (!$selectLimit && $market_trans_list->StartRecord > 1)
		$market_trans_list->Recordset->move($market_trans_list->StartRecord - 1);
} elseif (!$market_trans->AllowAddDeleteRow && $market_trans_list->StopRecord == 0) {
	$market_trans_list->StopRecord = $market_trans->GridAddRowCount;
}

// Initialize aggregate
$market_trans->RowType = ROWTYPE_AGGREGATEINIT;
$market_trans->resetAttributes();
$market_trans_list->renderRow();
while ($market_trans_list->RecordCount < $market_trans_list->StopRecord) {
	$market_trans_list->RecordCount++;
	if ($market_trans_list->RecordCount >= $market_trans_list->StartRecord) {
		$market_trans_list->RowCount++;

		// Set up key count
		$market_trans_list->KeyCount = $market_trans_list->RowIndex;

		// Init row class and style
		$market_trans->resetAttributes();
		$market_trans->CssClass = "";
		if ($market_trans_list->isGridAdd()) {
		} else {
			$market_trans_list->loadRowValues($market_trans_list->Recordset); // Load row values
		}
		$market_trans->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$market_trans->RowAttrs->merge(["data-rowindex" => $market_trans_list->RowCount, "id" => "r" . $market_trans_list->RowCount . "_market_trans", "data-rowtype" => $market_trans->RowType]);

		// Render row
		$market_trans_list->renderRow();

		// Render list options
		$market_trans_list->renderListOptions();
?>
	<tr <?php echo $market_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$market_trans_list->ListOptions->render("body", "left", $market_trans_list->RowCount);
?>
	<?php if ($market_trans_list->TransNo->Visible) { // TransNo ?>
		<td data-name="TransNo" <?php echo $market_trans_list->TransNo->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_TransNo">
<span<?php echo $market_trans_list->TransNo->viewAttributes() ?>><?php echo $market_trans_list->TransNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->MarketItemNo->Visible) { // MarketItemNo ?>
		<td data-name="MarketItemNo" <?php echo $market_trans_list->MarketItemNo->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_MarketItemNo">
<span<?php echo $market_trans_list->MarketItemNo->viewAttributes() ?>><?php echo $market_trans_list->MarketItemNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->DateHired->Visible) { // DateHired ?>
		<td data-name="DateHired" <?php echo $market_trans_list->DateHired->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_DateHired">
<span<?php echo $market_trans_list->DateHired->viewAttributes() ?>><?php echo $market_trans_list->DateHired->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->MartketeerName->Visible) { // MartketeerName ?>
		<td data-name="MartketeerName" <?php echo $market_trans_list->MartketeerName->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_MartketeerName">
<span<?php echo $market_trans_list->MartketeerName->viewAttributes() ?>><?php echo $market_trans_list->MartketeerName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->MartketeerID->Visible) { // MartketeerID ?>
		<td data-name="MartketeerID" <?php echo $market_trans_list->MartketeerID->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_MartketeerID">
<span<?php echo $market_trans_list->MartketeerID->viewAttributes() ?>><?php echo $market_trans_list->MartketeerID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" <?php echo $market_trans_list->AmountDue->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_AmountDue">
<span<?php echo $market_trans_list->AmountDue->viewAttributes() ?>><?php echo $market_trans_list->AmountDue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $market_trans_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_AmountPaid">
<span<?php echo $market_trans_list->AmountPaid->viewAttributes() ?>><?php echo $market_trans_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->ReceiptNo->Visible) { // ReceiptNo ?>
		<td data-name="ReceiptNo" <?php echo $market_trans_list->ReceiptNo->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_ReceiptNo">
<span<?php echo $market_trans_list->ReceiptNo->viewAttributes() ?>><?php echo $market_trans_list->ReceiptNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $market_trans_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_LastUpdatedBy">
<span<?php echo $market_trans_list->LastUpdatedBy->viewAttributes() ?>><?php echo $market_trans_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($market_trans_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $market_trans_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $market_trans_list->RowCount ?>_market_trans_LastUpdateDate">
<span<?php echo $market_trans_list->LastUpdateDate->viewAttributes() ?>><?php echo $market_trans_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$market_trans_list->ListOptions->render("body", "right", $market_trans_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$market_trans_list->isGridAdd())
		$market_trans_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$market_trans->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($market_trans_list->Recordset)
	$market_trans_list->Recordset->Close();
?>
<?php if (!$market_trans_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$market_trans_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $market_trans_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $market_trans_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($market_trans_list->TotalRecords == 0 && !$market_trans->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $market_trans_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$market_trans_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$market_trans_list->isExport()) { ?>
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
$market_trans_list->terminate();
?>