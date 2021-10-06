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
$transaction_type_list = new transaction_type_list();

// Run the page
$transaction_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$transaction_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$transaction_type_list->isExport()) { ?>
<script>
var ftransaction_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	ftransaction_typelist = currentForm = new ew.Form("ftransaction_typelist", "list");
	ftransaction_typelist.formKeyCountName = '<?php echo $transaction_type_list->FormKeyCountName ?>';
	loadjs.done("ftransaction_typelist");
});
var ftransaction_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	ftransaction_typelistsrch = currentSearchForm = new ew.Form("ftransaction_typelistsrch");

	// Dynamic selection lists
	// Filters

	ftransaction_typelistsrch.filterList = <?php echo $transaction_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	ftransaction_typelistsrch.initSearchPanel = true;
	loadjs.done("ftransaction_typelistsrch");
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
<?php if (!$transaction_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($transaction_type_list->TotalRecords > 0 && $transaction_type_list->ExportOptions->visible()) { ?>
<?php $transaction_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($transaction_type_list->ImportOptions->visible()) { ?>
<?php $transaction_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($transaction_type_list->SearchOptions->visible()) { ?>
<?php $transaction_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($transaction_type_list->FilterOptions->visible()) { ?>
<?php $transaction_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$transaction_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$transaction_type_list->isExport() && !$transaction_type->CurrentAction) { ?>
<form name="ftransaction_typelistsrch" id="ftransaction_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="ftransaction_typelistsrch-search-panel" class="<?php echo $transaction_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="transaction_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $transaction_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($transaction_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($transaction_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $transaction_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($transaction_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($transaction_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($transaction_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($transaction_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $transaction_type_list->showPageHeader(); ?>
<?php
$transaction_type_list->showMessage();
?>
<?php if ($transaction_type_list->TotalRecords > 0 || $transaction_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($transaction_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> transaction_type">
<?php if (!$transaction_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$transaction_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $transaction_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transaction_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="ftransaction_typelist" id="ftransaction_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="transaction_type">
<div id="gmp_transaction_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($transaction_type_list->TotalRecords > 0 || $transaction_type_list->isGridEdit()) { ?>
<table id="tbl_transaction_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$transaction_type->RowType = ROWTYPE_HEADER;

// Render list options
$transaction_type_list->renderListOptions();

// Render list options (header, left)
$transaction_type_list->ListOptions->render("header", "left");
?>
<?php if ($transaction_type_list->TransactionCode->Visible) { // TransactionCode ?>
	<?php if ($transaction_type_list->SortUrl($transaction_type_list->TransactionCode) == "") { ?>
		<th data-name="TransactionCode" class="<?php echo $transaction_type_list->TransactionCode->headerCellClass() ?>"><div id="elh_transaction_type_TransactionCode" class="transaction_type_TransactionCode"><div class="ew-table-header-caption"><?php echo $transaction_type_list->TransactionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransactionCode" class="<?php echo $transaction_type_list->TransactionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaction_type_list->SortUrl($transaction_type_list->TransactionCode) ?>', 1);"><div id="elh_transaction_type_TransactionCode" class="transaction_type_TransactionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_type_list->TransactionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($transaction_type_list->TransactionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaction_type_list->TransactionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_type_list->TransactionName->Visible) { // TransactionName ?>
	<?php if ($transaction_type_list->SortUrl($transaction_type_list->TransactionName) == "") { ?>
		<th data-name="TransactionName" class="<?php echo $transaction_type_list->TransactionName->headerCellClass() ?>"><div id="elh_transaction_type_TransactionName" class="transaction_type_TransactionName"><div class="ew-table-header-caption"><?php echo $transaction_type_list->TransactionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransactionName" class="<?php echo $transaction_type_list->TransactionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaction_type_list->SortUrl($transaction_type_list->TransactionName) ?>', 1);"><div id="elh_transaction_type_TransactionName" class="transaction_type_TransactionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_type_list->TransactionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_type_list->TransactionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaction_type_list->TransactionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($transaction_type_list->TransDesc->Visible) { // TransDesc ?>
	<?php if ($transaction_type_list->SortUrl($transaction_type_list->TransDesc) == "") { ?>
		<th data-name="TransDesc" class="<?php echo $transaction_type_list->TransDesc->headerCellClass() ?>"><div id="elh_transaction_type_TransDesc" class="transaction_type_TransDesc"><div class="ew-table-header-caption"><?php echo $transaction_type_list->TransDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TransDesc" class="<?php echo $transaction_type_list->TransDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $transaction_type_list->SortUrl($transaction_type_list->TransDesc) ?>', 1);"><div id="elh_transaction_type_TransDesc" class="transaction_type_TransDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $transaction_type_list->TransDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($transaction_type_list->TransDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($transaction_type_list->TransDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$transaction_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($transaction_type_list->ExportAll && $transaction_type_list->isExport()) {
	$transaction_type_list->StopRecord = $transaction_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($transaction_type_list->TotalRecords > $transaction_type_list->StartRecord + $transaction_type_list->DisplayRecords - 1)
		$transaction_type_list->StopRecord = $transaction_type_list->StartRecord + $transaction_type_list->DisplayRecords - 1;
	else
		$transaction_type_list->StopRecord = $transaction_type_list->TotalRecords;
}
$transaction_type_list->RecordCount = $transaction_type_list->StartRecord - 1;
if ($transaction_type_list->Recordset && !$transaction_type_list->Recordset->EOF) {
	$transaction_type_list->Recordset->moveFirst();
	$selectLimit = $transaction_type_list->UseSelectLimit;
	if (!$selectLimit && $transaction_type_list->StartRecord > 1)
		$transaction_type_list->Recordset->move($transaction_type_list->StartRecord - 1);
} elseif (!$transaction_type->AllowAddDeleteRow && $transaction_type_list->StopRecord == 0) {
	$transaction_type_list->StopRecord = $transaction_type->GridAddRowCount;
}

// Initialize aggregate
$transaction_type->RowType = ROWTYPE_AGGREGATEINIT;
$transaction_type->resetAttributes();
$transaction_type_list->renderRow();
while ($transaction_type_list->RecordCount < $transaction_type_list->StopRecord) {
	$transaction_type_list->RecordCount++;
	if ($transaction_type_list->RecordCount >= $transaction_type_list->StartRecord) {
		$transaction_type_list->RowCount++;

		// Set up key count
		$transaction_type_list->KeyCount = $transaction_type_list->RowIndex;

		// Init row class and style
		$transaction_type->resetAttributes();
		$transaction_type->CssClass = "";
		if ($transaction_type_list->isGridAdd()) {
		} else {
			$transaction_type_list->loadRowValues($transaction_type_list->Recordset); // Load row values
		}
		$transaction_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$transaction_type->RowAttrs->merge(["data-rowindex" => $transaction_type_list->RowCount, "id" => "r" . $transaction_type_list->RowCount . "_transaction_type", "data-rowtype" => $transaction_type->RowType]);

		// Render row
		$transaction_type_list->renderRow();

		// Render list options
		$transaction_type_list->renderListOptions();
?>
	<tr <?php echo $transaction_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$transaction_type_list->ListOptions->render("body", "left", $transaction_type_list->RowCount);
?>
	<?php if ($transaction_type_list->TransactionCode->Visible) { // TransactionCode ?>
		<td data-name="TransactionCode" <?php echo $transaction_type_list->TransactionCode->cellAttributes() ?>>
<span id="el<?php echo $transaction_type_list->RowCount ?>_transaction_type_TransactionCode">
<span<?php echo $transaction_type_list->TransactionCode->viewAttributes() ?>><?php echo $transaction_type_list->TransactionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaction_type_list->TransactionName->Visible) { // TransactionName ?>
		<td data-name="TransactionName" <?php echo $transaction_type_list->TransactionName->cellAttributes() ?>>
<span id="el<?php echo $transaction_type_list->RowCount ?>_transaction_type_TransactionName">
<span<?php echo $transaction_type_list->TransactionName->viewAttributes() ?>><?php echo $transaction_type_list->TransactionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($transaction_type_list->TransDesc->Visible) { // TransDesc ?>
		<td data-name="TransDesc" <?php echo $transaction_type_list->TransDesc->cellAttributes() ?>>
<span id="el<?php echo $transaction_type_list->RowCount ?>_transaction_type_TransDesc">
<span<?php echo $transaction_type_list->TransDesc->viewAttributes() ?>><?php echo $transaction_type_list->TransDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$transaction_type_list->ListOptions->render("body", "right", $transaction_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$transaction_type_list->isGridAdd())
		$transaction_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$transaction_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($transaction_type_list->Recordset)
	$transaction_type_list->Recordset->Close();
?>
<?php if (!$transaction_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$transaction_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $transaction_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $transaction_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($transaction_type_list->TotalRecords == 0 && !$transaction_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $transaction_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$transaction_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$transaction_type_list->isExport()) { ?>
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
$transaction_type_list->terminate();
?>