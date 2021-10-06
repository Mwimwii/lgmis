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
$current_total_netpay_list = new current_total_netpay_list();

// Run the page
$current_total_netpay_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$current_total_netpay_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$current_total_netpay_list->isExport()) { ?>
<script>
var fcurrent_total_netpaylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcurrent_total_netpaylist = currentForm = new ew.Form("fcurrent_total_netpaylist", "list");
	fcurrent_total_netpaylist.formKeyCountName = '<?php echo $current_total_netpay_list->FormKeyCountName ?>';
	loadjs.done("fcurrent_total_netpaylist");
});
var fcurrent_total_netpaylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcurrent_total_netpaylistsrch = currentSearchForm = new ew.Form("fcurrent_total_netpaylistsrch");

	// Dynamic selection lists
	// Filters

	fcurrent_total_netpaylistsrch.filterList = <?php echo $current_total_netpay_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcurrent_total_netpaylistsrch.initSearchPanel = true;
	loadjs.done("fcurrent_total_netpaylistsrch");
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
<?php if (!$current_total_netpay_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($current_total_netpay_list->TotalRecords > 0 && $current_total_netpay_list->ExportOptions->visible()) { ?>
<?php $current_total_netpay_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($current_total_netpay_list->ImportOptions->visible()) { ?>
<?php $current_total_netpay_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($current_total_netpay_list->SearchOptions->visible()) { ?>
<?php $current_total_netpay_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($current_total_netpay_list->FilterOptions->visible()) { ?>
<?php $current_total_netpay_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$current_total_netpay_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$current_total_netpay_list->isExport() && !$current_total_netpay->CurrentAction) { ?>
<form name="fcurrent_total_netpaylistsrch" id="fcurrent_total_netpaylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcurrent_total_netpaylistsrch-search-panel" class="<?php echo $current_total_netpay_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="current_total_netpay">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $current_total_netpay_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($current_total_netpay_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($current_total_netpay_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $current_total_netpay_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($current_total_netpay_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($current_total_netpay_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($current_total_netpay_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($current_total_netpay_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $current_total_netpay_list->showPageHeader(); ?>
<?php
$current_total_netpay_list->showMessage();
?>
<?php if ($current_total_netpay_list->TotalRecords > 0 || $current_total_netpay->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($current_total_netpay_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> current_total_netpay">
<?php if (!$current_total_netpay_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$current_total_netpay_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $current_total_netpay_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $current_total_netpay_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcurrent_total_netpaylist" id="fcurrent_total_netpaylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="current_total_netpay">
<div id="gmp_current_total_netpay" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($current_total_netpay_list->TotalRecords > 0 || $current_total_netpay_list->isGridEdit()) { ?>
<table id="tbl_current_total_netpaylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$current_total_netpay->RowType = ROWTYPE_HEADER;

// Render list options
$current_total_netpay_list->renderListOptions();

// Render list options (header, left)
$current_total_netpay_list->ListOptions->render("header", "left");
?>
<?php if ($current_total_netpay_list->Net_Pay->Visible) { // Net Pay ?>
	<?php if ($current_total_netpay_list->SortUrl($current_total_netpay_list->Net_Pay) == "") { ?>
		<th data-name="Net_Pay" class="<?php echo $current_total_netpay_list->Net_Pay->headerCellClass() ?>"><div id="elh_current_total_netpay_Net_Pay" class="current_total_netpay_Net_Pay"><div class="ew-table-header-caption"><?php echo $current_total_netpay_list->Net_Pay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Net_Pay" class="<?php echo $current_total_netpay_list->Net_Pay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_total_netpay_list->SortUrl($current_total_netpay_list->Net_Pay) ?>', 1);"><div id="elh_current_total_netpay_Net_Pay" class="current_total_netpay_Net_Pay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_total_netpay_list->Net_Pay->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($current_total_netpay_list->Net_Pay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_total_netpay_list->Net_Pay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_total_netpay_list->NetPay->Visible) { // NetPay ?>
	<?php if ($current_total_netpay_list->SortUrl($current_total_netpay_list->NetPay) == "") { ?>
		<th data-name="NetPay" class="<?php echo $current_total_netpay_list->NetPay->headerCellClass() ?>"><div id="elh_current_total_netpay_NetPay" class="current_total_netpay_NetPay"><div class="ew-table-header-caption"><?php echo $current_total_netpay_list->NetPay->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NetPay" class="<?php echo $current_total_netpay_list->NetPay->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_total_netpay_list->SortUrl($current_total_netpay_list->NetPay) ?>', 1);"><div id="elh_current_total_netpay_NetPay" class="current_total_netpay_NetPay">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_total_netpay_list->NetPay->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_total_netpay_list->NetPay->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_total_netpay_list->NetPay->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$current_total_netpay_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($current_total_netpay_list->ExportAll && $current_total_netpay_list->isExport()) {
	$current_total_netpay_list->StopRecord = $current_total_netpay_list->TotalRecords;
} else {

	// Set the last record to display
	if ($current_total_netpay_list->TotalRecords > $current_total_netpay_list->StartRecord + $current_total_netpay_list->DisplayRecords - 1)
		$current_total_netpay_list->StopRecord = $current_total_netpay_list->StartRecord + $current_total_netpay_list->DisplayRecords - 1;
	else
		$current_total_netpay_list->StopRecord = $current_total_netpay_list->TotalRecords;
}
$current_total_netpay_list->RecordCount = $current_total_netpay_list->StartRecord - 1;
if ($current_total_netpay_list->Recordset && !$current_total_netpay_list->Recordset->EOF) {
	$current_total_netpay_list->Recordset->moveFirst();
	$selectLimit = $current_total_netpay_list->UseSelectLimit;
	if (!$selectLimit && $current_total_netpay_list->StartRecord > 1)
		$current_total_netpay_list->Recordset->move($current_total_netpay_list->StartRecord - 1);
} elseif (!$current_total_netpay->AllowAddDeleteRow && $current_total_netpay_list->StopRecord == 0) {
	$current_total_netpay_list->StopRecord = $current_total_netpay->GridAddRowCount;
}

// Initialize aggregate
$current_total_netpay->RowType = ROWTYPE_AGGREGATEINIT;
$current_total_netpay->resetAttributes();
$current_total_netpay_list->renderRow();
while ($current_total_netpay_list->RecordCount < $current_total_netpay_list->StopRecord) {
	$current_total_netpay_list->RecordCount++;
	if ($current_total_netpay_list->RecordCount >= $current_total_netpay_list->StartRecord) {
		$current_total_netpay_list->RowCount++;

		// Set up key count
		$current_total_netpay_list->KeyCount = $current_total_netpay_list->RowIndex;

		// Init row class and style
		$current_total_netpay->resetAttributes();
		$current_total_netpay->CssClass = "";
		if ($current_total_netpay_list->isGridAdd()) {
		} else {
			$current_total_netpay_list->loadRowValues($current_total_netpay_list->Recordset); // Load row values
		}
		$current_total_netpay->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$current_total_netpay->RowAttrs->merge(["data-rowindex" => $current_total_netpay_list->RowCount, "id" => "r" . $current_total_netpay_list->RowCount . "_current_total_netpay", "data-rowtype" => $current_total_netpay->RowType]);

		// Render row
		$current_total_netpay_list->renderRow();

		// Render list options
		$current_total_netpay_list->renderListOptions();
?>
	<tr <?php echo $current_total_netpay->rowAttributes() ?>>
<?php

// Render list options (body, left)
$current_total_netpay_list->ListOptions->render("body", "left", $current_total_netpay_list->RowCount);
?>
	<?php if ($current_total_netpay_list->Net_Pay->Visible) { // Net Pay ?>
		<td data-name="Net_Pay" <?php echo $current_total_netpay_list->Net_Pay->cellAttributes() ?>>
<span id="el<?php echo $current_total_netpay_list->RowCount ?>_current_total_netpay_Net_Pay">
<span<?php echo $current_total_netpay_list->Net_Pay->viewAttributes() ?>><?php echo $current_total_netpay_list->Net_Pay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_total_netpay_list->NetPay->Visible) { // NetPay ?>
		<td data-name="NetPay" <?php echo $current_total_netpay_list->NetPay->cellAttributes() ?>>
<span id="el<?php echo $current_total_netpay_list->RowCount ?>_current_total_netpay_NetPay">
<span<?php echo $current_total_netpay_list->NetPay->viewAttributes() ?>><?php echo $current_total_netpay_list->NetPay->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$current_total_netpay_list->ListOptions->render("body", "right", $current_total_netpay_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$current_total_netpay_list->isGridAdd())
		$current_total_netpay_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$current_total_netpay->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($current_total_netpay_list->Recordset)
	$current_total_netpay_list->Recordset->Close();
?>
<?php if (!$current_total_netpay_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$current_total_netpay_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $current_total_netpay_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $current_total_netpay_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($current_total_netpay_list->TotalRecords == 0 && !$current_total_netpay->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $current_total_netpay_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$current_total_netpay_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$current_total_netpay_list->isExport()) { ?>
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
$current_total_netpay_list->terminate();
?>