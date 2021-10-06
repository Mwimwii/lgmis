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
$payment_method_list = new payment_method_list();

// Run the page
$payment_method_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payment_method_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payment_method_list->isExport()) { ?>
<script>
var fpayment_methodlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayment_methodlist = currentForm = new ew.Form("fpayment_methodlist", "list");
	fpayment_methodlist.formKeyCountName = '<?php echo $payment_method_list->FormKeyCountName ?>';
	loadjs.done("fpayment_methodlist");
});
var fpayment_methodlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayment_methodlistsrch = currentSearchForm = new ew.Form("fpayment_methodlistsrch");

	// Dynamic selection lists
	// Filters

	fpayment_methodlistsrch.filterList = <?php echo $payment_method_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayment_methodlistsrch.initSearchPanel = true;
	loadjs.done("fpayment_methodlistsrch");
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
<?php if (!$payment_method_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payment_method_list->TotalRecords > 0 && $payment_method_list->ExportOptions->visible()) { ?>
<?php $payment_method_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payment_method_list->ImportOptions->visible()) { ?>
<?php $payment_method_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payment_method_list->SearchOptions->visible()) { ?>
<?php $payment_method_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payment_method_list->FilterOptions->visible()) { ?>
<?php $payment_method_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payment_method_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payment_method_list->isExport() && !$payment_method->CurrentAction) { ?>
<form name="fpayment_methodlistsrch" id="fpayment_methodlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayment_methodlistsrch-search-panel" class="<?php echo $payment_method_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payment_method">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payment_method_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payment_method_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payment_method_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payment_method_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payment_method_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payment_method_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payment_method_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payment_method_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payment_method_list->showPageHeader(); ?>
<?php
$payment_method_list->showMessage();
?>
<?php if ($payment_method_list->TotalRecords > 0 || $payment_method->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payment_method_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payment_method">
<?php if (!$payment_method_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payment_method_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_method_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payment_method_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayment_methodlist" id="fpayment_methodlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payment_method">
<div id="gmp_payment_method" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payment_method_list->TotalRecords > 0 || $payment_method_list->isGridEdit()) { ?>
<table id="tbl_payment_methodlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payment_method->RowType = ROWTYPE_HEADER;

// Render list options
$payment_method_list->renderListOptions();

// Render list options (header, left)
$payment_method_list->ListOptions->render("header", "left");
?>
<?php if ($payment_method_list->PaymentMethod->Visible) { // PaymentMethod ?>
	<?php if ($payment_method_list->SortUrl($payment_method_list->PaymentMethod) == "") { ?>
		<th data-name="PaymentMethod" class="<?php echo $payment_method_list->PaymentMethod->headerCellClass() ?>"><div id="elh_payment_method_PaymentMethod" class="payment_method_PaymentMethod"><div class="ew-table-header-caption"><?php echo $payment_method_list->PaymentMethod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentMethod" class="<?php echo $payment_method_list->PaymentMethod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_method_list->SortUrl($payment_method_list->PaymentMethod) ?>', 1);"><div id="elh_payment_method_PaymentMethod" class="payment_method_PaymentMethod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_method_list->PaymentMethod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_method_list->PaymentMethod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_method_list->PaymentMethod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payment_method_list->PaymentDesc->Visible) { // PaymentDesc ?>
	<?php if ($payment_method_list->SortUrl($payment_method_list->PaymentDesc) == "") { ?>
		<th data-name="PaymentDesc" class="<?php echo $payment_method_list->PaymentDesc->headerCellClass() ?>"><div id="elh_payment_method_PaymentDesc" class="payment_method_PaymentDesc"><div class="ew-table-header-caption"><?php echo $payment_method_list->PaymentDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PaymentDesc" class="<?php echo $payment_method_list->PaymentDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payment_method_list->SortUrl($payment_method_list->PaymentDesc) ?>', 1);"><div id="elh_payment_method_PaymentDesc" class="payment_method_PaymentDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payment_method_list->PaymentDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payment_method_list->PaymentDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payment_method_list->PaymentDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payment_method_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payment_method_list->ExportAll && $payment_method_list->isExport()) {
	$payment_method_list->StopRecord = $payment_method_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payment_method_list->TotalRecords > $payment_method_list->StartRecord + $payment_method_list->DisplayRecords - 1)
		$payment_method_list->StopRecord = $payment_method_list->StartRecord + $payment_method_list->DisplayRecords - 1;
	else
		$payment_method_list->StopRecord = $payment_method_list->TotalRecords;
}
$payment_method_list->RecordCount = $payment_method_list->StartRecord - 1;
if ($payment_method_list->Recordset && !$payment_method_list->Recordset->EOF) {
	$payment_method_list->Recordset->moveFirst();
	$selectLimit = $payment_method_list->UseSelectLimit;
	if (!$selectLimit && $payment_method_list->StartRecord > 1)
		$payment_method_list->Recordset->move($payment_method_list->StartRecord - 1);
} elseif (!$payment_method->AllowAddDeleteRow && $payment_method_list->StopRecord == 0) {
	$payment_method_list->StopRecord = $payment_method->GridAddRowCount;
}

// Initialize aggregate
$payment_method->RowType = ROWTYPE_AGGREGATEINIT;
$payment_method->resetAttributes();
$payment_method_list->renderRow();
while ($payment_method_list->RecordCount < $payment_method_list->StopRecord) {
	$payment_method_list->RecordCount++;
	if ($payment_method_list->RecordCount >= $payment_method_list->StartRecord) {
		$payment_method_list->RowCount++;

		// Set up key count
		$payment_method_list->KeyCount = $payment_method_list->RowIndex;

		// Init row class and style
		$payment_method->resetAttributes();
		$payment_method->CssClass = "";
		if ($payment_method_list->isGridAdd()) {
		} else {
			$payment_method_list->loadRowValues($payment_method_list->Recordset); // Load row values
		}
		$payment_method->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payment_method->RowAttrs->merge(["data-rowindex" => $payment_method_list->RowCount, "id" => "r" . $payment_method_list->RowCount . "_payment_method", "data-rowtype" => $payment_method->RowType]);

		// Render row
		$payment_method_list->renderRow();

		// Render list options
		$payment_method_list->renderListOptions();
?>
	<tr <?php echo $payment_method->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payment_method_list->ListOptions->render("body", "left", $payment_method_list->RowCount);
?>
	<?php if ($payment_method_list->PaymentMethod->Visible) { // PaymentMethod ?>
		<td data-name="PaymentMethod" <?php echo $payment_method_list->PaymentMethod->cellAttributes() ?>>
<span id="el<?php echo $payment_method_list->RowCount ?>_payment_method_PaymentMethod">
<span<?php echo $payment_method_list->PaymentMethod->viewAttributes() ?>><?php echo $payment_method_list->PaymentMethod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payment_method_list->PaymentDesc->Visible) { // PaymentDesc ?>
		<td data-name="PaymentDesc" <?php echo $payment_method_list->PaymentDesc->cellAttributes() ?>>
<span id="el<?php echo $payment_method_list->RowCount ?>_payment_method_PaymentDesc">
<span<?php echo $payment_method_list->PaymentDesc->viewAttributes() ?>><?php echo $payment_method_list->PaymentDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payment_method_list->ListOptions->render("body", "right", $payment_method_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payment_method_list->isGridAdd())
		$payment_method_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payment_method->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payment_method_list->Recordset)
	$payment_method_list->Recordset->Close();
?>
<?php if (!$payment_method_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payment_method_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payment_method_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payment_method_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payment_method_list->TotalRecords == 0 && !$payment_method->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payment_method_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payment_method_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payment_method_list->isExport()) { ?>
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
$payment_method_list->terminate();
?>