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
$currency_list = new currency_list();

// Run the page
$currency_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$currency_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$currency_list->isExport()) { ?>
<script>
var fcurrencylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcurrencylist = currentForm = new ew.Form("fcurrencylist", "list");
	fcurrencylist.formKeyCountName = '<?php echo $currency_list->FormKeyCountName ?>';
	loadjs.done("fcurrencylist");
});
var fcurrencylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcurrencylistsrch = currentSearchForm = new ew.Form("fcurrencylistsrch");

	// Dynamic selection lists
	// Filters

	fcurrencylistsrch.filterList = <?php echo $currency_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcurrencylistsrch.initSearchPanel = true;
	loadjs.done("fcurrencylistsrch");
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
<?php if (!$currency_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($currency_list->TotalRecords > 0 && $currency_list->ExportOptions->visible()) { ?>
<?php $currency_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($currency_list->ImportOptions->visible()) { ?>
<?php $currency_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($currency_list->SearchOptions->visible()) { ?>
<?php $currency_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($currency_list->FilterOptions->visible()) { ?>
<?php $currency_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$currency_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$currency_list->isExport() && !$currency->CurrentAction) { ?>
<form name="fcurrencylistsrch" id="fcurrencylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcurrencylistsrch-search-panel" class="<?php echo $currency_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="currency">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $currency_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($currency_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($currency_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $currency_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($currency_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($currency_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($currency_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($currency_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $currency_list->showPageHeader(); ?>
<?php
$currency_list->showMessage();
?>
<?php if ($currency_list->TotalRecords > 0 || $currency->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($currency_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> currency">
<?php if (!$currency_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$currency_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $currency_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $currency_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcurrencylist" id="fcurrencylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="currency">
<div id="gmp_currency" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($currency_list->TotalRecords > 0 || $currency_list->isGridEdit()) { ?>
<table id="tbl_currencylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$currency->RowType = ROWTYPE_HEADER;

// Render list options
$currency_list->renderListOptions();

// Render list options (header, left)
$currency_list->ListOptions->render("header", "left");
?>
<?php if ($currency_list->CurrencyCode->Visible) { // CurrencyCode ?>
	<?php if ($currency_list->SortUrl($currency_list->CurrencyCode) == "") { ?>
		<th data-name="CurrencyCode" class="<?php echo $currency_list->CurrencyCode->headerCellClass() ?>"><div id="elh_currency_CurrencyCode" class="currency_CurrencyCode"><div class="ew-table-header-caption"><?php echo $currency_list->CurrencyCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrencyCode" class="<?php echo $currency_list->CurrencyCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $currency_list->SortUrl($currency_list->CurrencyCode) ?>', 1);"><div id="elh_currency_CurrencyCode" class="currency_CurrencyCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $currency_list->CurrencyCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($currency_list->CurrencyCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($currency_list->CurrencyCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($currency_list->CurrencyName->Visible) { // CurrencyName ?>
	<?php if ($currency_list->SortUrl($currency_list->CurrencyName) == "") { ?>
		<th data-name="CurrencyName" class="<?php echo $currency_list->CurrencyName->headerCellClass() ?>"><div id="elh_currency_CurrencyName" class="currency_CurrencyName"><div class="ew-table-header-caption"><?php echo $currency_list->CurrencyName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrencyName" class="<?php echo $currency_list->CurrencyName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $currency_list->SortUrl($currency_list->CurrencyName) ?>', 1);"><div id="elh_currency_CurrencyName" class="currency_CurrencyName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $currency_list->CurrencyName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($currency_list->CurrencyName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($currency_list->CurrencyName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$currency_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($currency_list->ExportAll && $currency_list->isExport()) {
	$currency_list->StopRecord = $currency_list->TotalRecords;
} else {

	// Set the last record to display
	if ($currency_list->TotalRecords > $currency_list->StartRecord + $currency_list->DisplayRecords - 1)
		$currency_list->StopRecord = $currency_list->StartRecord + $currency_list->DisplayRecords - 1;
	else
		$currency_list->StopRecord = $currency_list->TotalRecords;
}
$currency_list->RecordCount = $currency_list->StartRecord - 1;
if ($currency_list->Recordset && !$currency_list->Recordset->EOF) {
	$currency_list->Recordset->moveFirst();
	$selectLimit = $currency_list->UseSelectLimit;
	if (!$selectLimit && $currency_list->StartRecord > 1)
		$currency_list->Recordset->move($currency_list->StartRecord - 1);
} elseif (!$currency->AllowAddDeleteRow && $currency_list->StopRecord == 0) {
	$currency_list->StopRecord = $currency->GridAddRowCount;
}

// Initialize aggregate
$currency->RowType = ROWTYPE_AGGREGATEINIT;
$currency->resetAttributes();
$currency_list->renderRow();
while ($currency_list->RecordCount < $currency_list->StopRecord) {
	$currency_list->RecordCount++;
	if ($currency_list->RecordCount >= $currency_list->StartRecord) {
		$currency_list->RowCount++;

		// Set up key count
		$currency_list->KeyCount = $currency_list->RowIndex;

		// Init row class and style
		$currency->resetAttributes();
		$currency->CssClass = "";
		if ($currency_list->isGridAdd()) {
		} else {
			$currency_list->loadRowValues($currency_list->Recordset); // Load row values
		}
		$currency->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$currency->RowAttrs->merge(["data-rowindex" => $currency_list->RowCount, "id" => "r" . $currency_list->RowCount . "_currency", "data-rowtype" => $currency->RowType]);

		// Render row
		$currency_list->renderRow();

		// Render list options
		$currency_list->renderListOptions();
?>
	<tr <?php echo $currency->rowAttributes() ?>>
<?php

// Render list options (body, left)
$currency_list->ListOptions->render("body", "left", $currency_list->RowCount);
?>
	<?php if ($currency_list->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode" <?php echo $currency_list->CurrencyCode->cellAttributes() ?>>
<span id="el<?php echo $currency_list->RowCount ?>_currency_CurrencyCode">
<span<?php echo $currency_list->CurrencyCode->viewAttributes() ?>><?php echo $currency_list->CurrencyCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($currency_list->CurrencyName->Visible) { // CurrencyName ?>
		<td data-name="CurrencyName" <?php echo $currency_list->CurrencyName->cellAttributes() ?>>
<span id="el<?php echo $currency_list->RowCount ?>_currency_CurrencyName">
<span<?php echo $currency_list->CurrencyName->viewAttributes() ?>><?php echo $currency_list->CurrencyName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$currency_list->ListOptions->render("body", "right", $currency_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$currency_list->isGridAdd())
		$currency_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$currency->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($currency_list->Recordset)
	$currency_list->Recordset->Close();
?>
<?php if (!$currency_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$currency_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $currency_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $currency_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($currency_list->TotalRecords == 0 && !$currency->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $currency_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$currency_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$currency_list->isExport()) { ?>
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
$currency_list->terminate();
?>