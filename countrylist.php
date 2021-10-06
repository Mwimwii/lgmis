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
$country_list = new country_list();

// Run the page
$country_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$country_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$country_list->isExport()) { ?>
<script>
var fcountrylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcountrylist = currentForm = new ew.Form("fcountrylist", "list");
	fcountrylist.formKeyCountName = '<?php echo $country_list->FormKeyCountName ?>';
	loadjs.done("fcountrylist");
});
var fcountrylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcountrylistsrch = currentSearchForm = new ew.Form("fcountrylistsrch");

	// Dynamic selection lists
	// Filters

	fcountrylistsrch.filterList = <?php echo $country_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcountrylistsrch.initSearchPanel = true;
	loadjs.done("fcountrylistsrch");
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
<?php if (!$country_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($country_list->TotalRecords > 0 && $country_list->ExportOptions->visible()) { ?>
<?php $country_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($country_list->ImportOptions->visible()) { ?>
<?php $country_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($country_list->SearchOptions->visible()) { ?>
<?php $country_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($country_list->FilterOptions->visible()) { ?>
<?php $country_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$country_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$country_list->isExport() && !$country->CurrentAction) { ?>
<form name="fcountrylistsrch" id="fcountrylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcountrylistsrch-search-panel" class="<?php echo $country_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="country">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $country_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($country_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($country_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $country_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($country_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $country_list->showPageHeader(); ?>
<?php
$country_list->showMessage();
?>
<?php if ($country_list->TotalRecords > 0 || $country->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($country_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> country">
<?php if (!$country_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$country_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $country_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $country_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcountrylist" id="fcountrylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="country">
<div id="gmp_country" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($country_list->TotalRecords > 0 || $country_list->isGridEdit()) { ?>
<table id="tbl_countrylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$country->RowType = ROWTYPE_HEADER;

// Render list options
$country_list->renderListOptions();

// Render list options (header, left)
$country_list->ListOptions->render("header", "left");
?>
<?php if ($country_list->CountryName->Visible) { // CountryName ?>
	<?php if ($country_list->SortUrl($country_list->CountryName) == "") { ?>
		<th data-name="CountryName" class="<?php echo $country_list->CountryName->headerCellClass() ?>"><div id="elh_country_CountryName" class="country_CountryName"><div class="ew-table-header-caption"><?php echo $country_list->CountryName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CountryName" class="<?php echo $country_list->CountryName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $country_list->SortUrl($country_list->CountryName) ?>', 1);"><div id="elh_country_CountryName" class="country_CountryName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $country_list->CountryName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($country_list->CountryName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($country_list->CountryName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($country_list->CurrencyCode->Visible) { // CurrencyCode ?>
	<?php if ($country_list->SortUrl($country_list->CurrencyCode) == "") { ?>
		<th data-name="CurrencyCode" class="<?php echo $country_list->CurrencyCode->headerCellClass() ?>"><div id="elh_country_CurrencyCode" class="country_CurrencyCode"><div class="ew-table-header-caption"><?php echo $country_list->CurrencyCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrencyCode" class="<?php echo $country_list->CurrencyCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $country_list->SortUrl($country_list->CurrencyCode) ?>', 1);"><div id="elh_country_CurrencyCode" class="country_CurrencyCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $country_list->CurrencyCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($country_list->CurrencyCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($country_list->CurrencyCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($country_list->ExchangeRate->Visible) { // ExchangeRate ?>
	<?php if ($country_list->SortUrl($country_list->ExchangeRate) == "") { ?>
		<th data-name="ExchangeRate" class="<?php echo $country_list->ExchangeRate->headerCellClass() ?>"><div id="elh_country_ExchangeRate" class="country_ExchangeRate"><div class="ew-table-header-caption"><?php echo $country_list->ExchangeRate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExchangeRate" class="<?php echo $country_list->ExchangeRate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $country_list->SortUrl($country_list->ExchangeRate) ?>', 1);"><div id="elh_country_ExchangeRate" class="country_ExchangeRate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $country_list->ExchangeRate->caption() ?></span><span class="ew-table-header-sort"><?php if ($country_list->ExchangeRate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($country_list->ExchangeRate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($country_list->CountryCode->Visible) { // CountryCode ?>
	<?php if ($country_list->SortUrl($country_list->CountryCode) == "") { ?>
		<th data-name="CountryCode" class="<?php echo $country_list->CountryCode->headerCellClass() ?>"><div id="elh_country_CountryCode" class="country_CountryCode"><div class="ew-table-header-caption"><?php echo $country_list->CountryCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CountryCode" class="<?php echo $country_list->CountryCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $country_list->SortUrl($country_list->CountryCode) ?>', 1);"><div id="elh_country_CountryCode" class="country_CountryCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $country_list->CountryCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($country_list->CountryCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($country_list->CountryCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$country_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($country_list->ExportAll && $country_list->isExport()) {
	$country_list->StopRecord = $country_list->TotalRecords;
} else {

	// Set the last record to display
	if ($country_list->TotalRecords > $country_list->StartRecord + $country_list->DisplayRecords - 1)
		$country_list->StopRecord = $country_list->StartRecord + $country_list->DisplayRecords - 1;
	else
		$country_list->StopRecord = $country_list->TotalRecords;
}
$country_list->RecordCount = $country_list->StartRecord - 1;
if ($country_list->Recordset && !$country_list->Recordset->EOF) {
	$country_list->Recordset->moveFirst();
	$selectLimit = $country_list->UseSelectLimit;
	if (!$selectLimit && $country_list->StartRecord > 1)
		$country_list->Recordset->move($country_list->StartRecord - 1);
} elseif (!$country->AllowAddDeleteRow && $country_list->StopRecord == 0) {
	$country_list->StopRecord = $country->GridAddRowCount;
}

// Initialize aggregate
$country->RowType = ROWTYPE_AGGREGATEINIT;
$country->resetAttributes();
$country_list->renderRow();
while ($country_list->RecordCount < $country_list->StopRecord) {
	$country_list->RecordCount++;
	if ($country_list->RecordCount >= $country_list->StartRecord) {
		$country_list->RowCount++;

		// Set up key count
		$country_list->KeyCount = $country_list->RowIndex;

		// Init row class and style
		$country->resetAttributes();
		$country->CssClass = "";
		if ($country_list->isGridAdd()) {
		} else {
			$country_list->loadRowValues($country_list->Recordset); // Load row values
		}
		$country->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$country->RowAttrs->merge(["data-rowindex" => $country_list->RowCount, "id" => "r" . $country_list->RowCount . "_country", "data-rowtype" => $country->RowType]);

		// Render row
		$country_list->renderRow();

		// Render list options
		$country_list->renderListOptions();
?>
	<tr <?php echo $country->rowAttributes() ?>>
<?php

// Render list options (body, left)
$country_list->ListOptions->render("body", "left", $country_list->RowCount);
?>
	<?php if ($country_list->CountryName->Visible) { // CountryName ?>
		<td data-name="CountryName" <?php echo $country_list->CountryName->cellAttributes() ?>>
<span id="el<?php echo $country_list->RowCount ?>_country_CountryName">
<span<?php echo $country_list->CountryName->viewAttributes() ?>><?php echo $country_list->CountryName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($country_list->CurrencyCode->Visible) { // CurrencyCode ?>
		<td data-name="CurrencyCode" <?php echo $country_list->CurrencyCode->cellAttributes() ?>>
<span id="el<?php echo $country_list->RowCount ?>_country_CurrencyCode">
<span<?php echo $country_list->CurrencyCode->viewAttributes() ?>><?php echo $country_list->CurrencyCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($country_list->ExchangeRate->Visible) { // ExchangeRate ?>
		<td data-name="ExchangeRate" <?php echo $country_list->ExchangeRate->cellAttributes() ?>>
<span id="el<?php echo $country_list->RowCount ?>_country_ExchangeRate">
<span<?php echo $country_list->ExchangeRate->viewAttributes() ?>><?php echo $country_list->ExchangeRate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($country_list->CountryCode->Visible) { // CountryCode ?>
		<td data-name="CountryCode" <?php echo $country_list->CountryCode->cellAttributes() ?>>
<span id="el<?php echo $country_list->RowCount ?>_country_CountryCode">
<span<?php echo $country_list->CountryCode->viewAttributes() ?>><?php echo $country_list->CountryCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$country_list->ListOptions->render("body", "right", $country_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$country_list->isGridAdd())
		$country_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$country->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($country_list->Recordset)
	$country_list->Recordset->Close();
?>
<?php if (!$country_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$country_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $country_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $country_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($country_list->TotalRecords == 0 && !$country->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $country_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$country_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$country_list->isExport()) { ?>
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
$country_list->terminate();
?>