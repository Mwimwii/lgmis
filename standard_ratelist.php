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
$standard_rate_list = new standard_rate_list();

// Run the page
$standard_rate_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$standard_rate_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$standard_rate_list->isExport()) { ?>
<script>
var fstandard_ratelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fstandard_ratelist = currentForm = new ew.Form("fstandard_ratelist", "list");
	fstandard_ratelist.formKeyCountName = '<?php echo $standard_rate_list->FormKeyCountName ?>';
	loadjs.done("fstandard_ratelist");
});
var fstandard_ratelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fstandard_ratelistsrch = currentSearchForm = new ew.Form("fstandard_ratelistsrch");

	// Dynamic selection lists
	// Filters

	fstandard_ratelistsrch.filterList = <?php echo $standard_rate_list->getFilterList() ?>;

	// Init search panel as collapsed
	fstandard_ratelistsrch.initSearchPanel = true;
	loadjs.done("fstandard_ratelistsrch");
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
<?php if (!$standard_rate_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($standard_rate_list->TotalRecords > 0 && $standard_rate_list->ExportOptions->visible()) { ?>
<?php $standard_rate_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($standard_rate_list->ImportOptions->visible()) { ?>
<?php $standard_rate_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($standard_rate_list->SearchOptions->visible()) { ?>
<?php $standard_rate_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($standard_rate_list->FilterOptions->visible()) { ?>
<?php $standard_rate_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$standard_rate_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$standard_rate_list->isExport() && !$standard_rate->CurrentAction) { ?>
<form name="fstandard_ratelistsrch" id="fstandard_ratelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fstandard_ratelistsrch-search-panel" class="<?php echo $standard_rate_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="standard_rate">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $standard_rate_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($standard_rate_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($standard_rate_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $standard_rate_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($standard_rate_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($standard_rate_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($standard_rate_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($standard_rate_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $standard_rate_list->showPageHeader(); ?>
<?php
$standard_rate_list->showMessage();
?>
<?php if ($standard_rate_list->TotalRecords > 0 || $standard_rate->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($standard_rate_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> standard_rate">
<?php if (!$standard_rate_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$standard_rate_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $standard_rate_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $standard_rate_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fstandard_ratelist" id="fstandard_ratelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="standard_rate">
<div id="gmp_standard_rate" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($standard_rate_list->TotalRecords > 0 || $standard_rate_list->isGridEdit()) { ?>
<table id="tbl_standard_ratelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$standard_rate->RowType = ROWTYPE_HEADER;

// Render list options
$standard_rate_list->renderListOptions();

// Render list options (header, left)
$standard_rate_list->ListOptions->render("header", "left");
?>
<?php if ($standard_rate_list->account_id->Visible) { // account_id ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->account_id) == "") { ?>
		<th data-name="account_id" class="<?php echo $standard_rate_list->account_id->headerCellClass() ?>"><div id="elh_standard_rate_account_id" class="standard_rate_account_id"><div class="ew-table-header-caption"><?php echo $standard_rate_list->account_id->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="account_id" class="<?php echo $standard_rate_list->account_id->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->account_id) ?>', 1);"><div id="elh_standard_rate_account_id" class="standard_rate_account_id">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->account_id->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->account_id->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->account_id->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->moimp_code->Visible) { // moimp_code ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->moimp_code) == "") { ?>
		<th data-name="moimp_code" class="<?php echo $standard_rate_list->moimp_code->headerCellClass() ?>"><div id="elh_standard_rate_moimp_code" class="standard_rate_moimp_code"><div class="ew-table-header-caption"><?php echo $standard_rate_list->moimp_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="moimp_code" class="<?php echo $standard_rate_list->moimp_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->moimp_code) ?>', 1);"><div id="elh_standard_rate_moimp_code" class="standard_rate_moimp_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->moimp_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->moimp_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->moimp_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->account_code->Visible) { // account_code ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->account_code) == "") { ?>
		<th data-name="account_code" class="<?php echo $standard_rate_list->account_code->headerCellClass() ?>"><div id="elh_standard_rate_account_code" class="standard_rate_account_code"><div class="ew-table-header-caption"><?php echo $standard_rate_list->account_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="account_code" class="<?php echo $standard_rate_list->account_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->account_code) ?>', 1);"><div id="elh_standard_rate_account_code" class="standard_rate_account_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->account_code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->account_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->account_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->period_code->Visible) { // period_code ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->period_code) == "") { ?>
		<th data-name="period_code" class="<?php echo $standard_rate_list->period_code->headerCellClass() ?>"><div id="elh_standard_rate_period_code" class="standard_rate_period_code"><div class="ew-table-header-caption"><?php echo $standard_rate_list->period_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="period_code" class="<?php echo $standard_rate_list->period_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->period_code) ?>', 1);"><div id="elh_standard_rate_period_code" class="standard_rate_period_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->period_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->period_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->period_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->level_code->Visible) { // level_code ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->level_code) == "") { ?>
		<th data-name="level_code" class="<?php echo $standard_rate_list->level_code->headerCellClass() ?>"><div id="elh_standard_rate_level_code" class="standard_rate_level_code"><div class="ew-table-header-caption"><?php echo $standard_rate_list->level_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="level_code" class="<?php echo $standard_rate_list->level_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->level_code) ?>', 1);"><div id="elh_standard_rate_level_code" class="standard_rate_level_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->level_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->level_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->level_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->destination_code->Visible) { // destination_code ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->destination_code) == "") { ?>
		<th data-name="destination_code" class="<?php echo $standard_rate_list->destination_code->headerCellClass() ?>"><div id="elh_standard_rate_destination_code" class="standard_rate_destination_code"><div class="ew-table-header-caption"><?php echo $standard_rate_list->destination_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="destination_code" class="<?php echo $standard_rate_list->destination_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->destination_code) ?>', 1);"><div id="elh_standard_rate_destination_code" class="standard_rate_destination_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->destination_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->destination_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->destination_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->amount->Visible) { // amount ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->amount) == "") { ?>
		<th data-name="amount" class="<?php echo $standard_rate_list->amount->headerCellClass() ?>"><div id="elh_standard_rate_amount" class="standard_rate_amount"><div class="ew-table-header-caption"><?php echo $standard_rate_list->amount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="amount" class="<?php echo $standard_rate_list->amount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->amount) ?>', 1);"><div id="elh_standard_rate_amount" class="standard_rate_amount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->amount->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->amount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->amount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->currency_Code->Visible) { // currency_Code ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->currency_Code) == "") { ?>
		<th data-name="currency_Code" class="<?php echo $standard_rate_list->currency_Code->headerCellClass() ?>"><div id="elh_standard_rate_currency_Code" class="standard_rate_currency_Code"><div class="ew-table-header-caption"><?php echo $standard_rate_list->currency_Code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="currency_Code" class="<?php echo $standard_rate_list->currency_Code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->currency_Code) ?>', 1);"><div id="elh_standard_rate_currency_Code" class="standard_rate_currency_Code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->currency_Code->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->currency_Code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->currency_Code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->last_user->Visible) { // last_user ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->last_user) == "") { ?>
		<th data-name="last_user" class="<?php echo $standard_rate_list->last_user->headerCellClass() ?>"><div id="elh_standard_rate_last_user" class="standard_rate_last_user"><div class="ew-table-header-caption"><?php echo $standard_rate_list->last_user->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="last_user" class="<?php echo $standard_rate_list->last_user->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->last_user) ?>', 1);"><div id="elh_standard_rate_last_user" class="standard_rate_last_user">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->last_user->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->last_user->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->last_user->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($standard_rate_list->last_update->Visible) { // last_update ?>
	<?php if ($standard_rate_list->SortUrl($standard_rate_list->last_update) == "") { ?>
		<th data-name="last_update" class="<?php echo $standard_rate_list->last_update->headerCellClass() ?>"><div id="elh_standard_rate_last_update" class="standard_rate_last_update"><div class="ew-table-header-caption"><?php echo $standard_rate_list->last_update->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="last_update" class="<?php echo $standard_rate_list->last_update->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $standard_rate_list->SortUrl($standard_rate_list->last_update) ?>', 1);"><div id="elh_standard_rate_last_update" class="standard_rate_last_update">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $standard_rate_list->last_update->caption() ?></span><span class="ew-table-header-sort"><?php if ($standard_rate_list->last_update->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($standard_rate_list->last_update->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$standard_rate_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($standard_rate_list->ExportAll && $standard_rate_list->isExport()) {
	$standard_rate_list->StopRecord = $standard_rate_list->TotalRecords;
} else {

	// Set the last record to display
	if ($standard_rate_list->TotalRecords > $standard_rate_list->StartRecord + $standard_rate_list->DisplayRecords - 1)
		$standard_rate_list->StopRecord = $standard_rate_list->StartRecord + $standard_rate_list->DisplayRecords - 1;
	else
		$standard_rate_list->StopRecord = $standard_rate_list->TotalRecords;
}
$standard_rate_list->RecordCount = $standard_rate_list->StartRecord - 1;
if ($standard_rate_list->Recordset && !$standard_rate_list->Recordset->EOF) {
	$standard_rate_list->Recordset->moveFirst();
	$selectLimit = $standard_rate_list->UseSelectLimit;
	if (!$selectLimit && $standard_rate_list->StartRecord > 1)
		$standard_rate_list->Recordset->move($standard_rate_list->StartRecord - 1);
} elseif (!$standard_rate->AllowAddDeleteRow && $standard_rate_list->StopRecord == 0) {
	$standard_rate_list->StopRecord = $standard_rate->GridAddRowCount;
}

// Initialize aggregate
$standard_rate->RowType = ROWTYPE_AGGREGATEINIT;
$standard_rate->resetAttributes();
$standard_rate_list->renderRow();
while ($standard_rate_list->RecordCount < $standard_rate_list->StopRecord) {
	$standard_rate_list->RecordCount++;
	if ($standard_rate_list->RecordCount >= $standard_rate_list->StartRecord) {
		$standard_rate_list->RowCount++;

		// Set up key count
		$standard_rate_list->KeyCount = $standard_rate_list->RowIndex;

		// Init row class and style
		$standard_rate->resetAttributes();
		$standard_rate->CssClass = "";
		if ($standard_rate_list->isGridAdd()) {
		} else {
			$standard_rate_list->loadRowValues($standard_rate_list->Recordset); // Load row values
		}
		$standard_rate->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$standard_rate->RowAttrs->merge(["data-rowindex" => $standard_rate_list->RowCount, "id" => "r" . $standard_rate_list->RowCount . "_standard_rate", "data-rowtype" => $standard_rate->RowType]);

		// Render row
		$standard_rate_list->renderRow();

		// Render list options
		$standard_rate_list->renderListOptions();
?>
	<tr <?php echo $standard_rate->rowAttributes() ?>>
<?php

// Render list options (body, left)
$standard_rate_list->ListOptions->render("body", "left", $standard_rate_list->RowCount);
?>
	<?php if ($standard_rate_list->account_id->Visible) { // account_id ?>
		<td data-name="account_id" <?php echo $standard_rate_list->account_id->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_account_id">
<span<?php echo $standard_rate_list->account_id->viewAttributes() ?>><?php echo $standard_rate_list->account_id->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->moimp_code->Visible) { // moimp_code ?>
		<td data-name="moimp_code" <?php echo $standard_rate_list->moimp_code->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_moimp_code">
<span<?php echo $standard_rate_list->moimp_code->viewAttributes() ?>><?php echo $standard_rate_list->moimp_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->account_code->Visible) { // account_code ?>
		<td data-name="account_code" <?php echo $standard_rate_list->account_code->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_account_code">
<span<?php echo $standard_rate_list->account_code->viewAttributes() ?>><?php echo $standard_rate_list->account_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->period_code->Visible) { // period_code ?>
		<td data-name="period_code" <?php echo $standard_rate_list->period_code->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_period_code">
<span<?php echo $standard_rate_list->period_code->viewAttributes() ?>><?php echo $standard_rate_list->period_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->level_code->Visible) { // level_code ?>
		<td data-name="level_code" <?php echo $standard_rate_list->level_code->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_level_code">
<span<?php echo $standard_rate_list->level_code->viewAttributes() ?>><?php echo $standard_rate_list->level_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->destination_code->Visible) { // destination_code ?>
		<td data-name="destination_code" <?php echo $standard_rate_list->destination_code->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_destination_code">
<span<?php echo $standard_rate_list->destination_code->viewAttributes() ?>><?php echo $standard_rate_list->destination_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->amount->Visible) { // amount ?>
		<td data-name="amount" <?php echo $standard_rate_list->amount->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_amount">
<span<?php echo $standard_rate_list->amount->viewAttributes() ?>><?php echo $standard_rate_list->amount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->currency_Code->Visible) { // currency_Code ?>
		<td data-name="currency_Code" <?php echo $standard_rate_list->currency_Code->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_currency_Code">
<span<?php echo $standard_rate_list->currency_Code->viewAttributes() ?>><?php echo $standard_rate_list->currency_Code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->last_user->Visible) { // last_user ?>
		<td data-name="last_user" <?php echo $standard_rate_list->last_user->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_last_user">
<span<?php echo $standard_rate_list->last_user->viewAttributes() ?>><?php echo $standard_rate_list->last_user->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($standard_rate_list->last_update->Visible) { // last_update ?>
		<td data-name="last_update" <?php echo $standard_rate_list->last_update->cellAttributes() ?>>
<span id="el<?php echo $standard_rate_list->RowCount ?>_standard_rate_last_update">
<span<?php echo $standard_rate_list->last_update->viewAttributes() ?>><?php echo $standard_rate_list->last_update->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$standard_rate_list->ListOptions->render("body", "right", $standard_rate_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$standard_rate_list->isGridAdd())
		$standard_rate_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$standard_rate->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($standard_rate_list->Recordset)
	$standard_rate_list->Recordset->Close();
?>
<?php if (!$standard_rate_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$standard_rate_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $standard_rate_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $standard_rate_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($standard_rate_list->TotalRecords == 0 && !$standard_rate->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $standard_rate_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$standard_rate_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$standard_rate_list->isExport()) { ?>
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
$standard_rate_list->terminate();
?>