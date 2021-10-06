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
$current_total_napsa_list = new current_total_napsa_list();

// Run the page
$current_total_napsa_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$current_total_napsa_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$current_total_napsa_list->isExport()) { ?>
<script>
var fcurrent_total_napsalist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcurrent_total_napsalist = currentForm = new ew.Form("fcurrent_total_napsalist", "list");
	fcurrent_total_napsalist.formKeyCountName = '<?php echo $current_total_napsa_list->FormKeyCountName ?>';
	loadjs.done("fcurrent_total_napsalist");
});
var fcurrent_total_napsalistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcurrent_total_napsalistsrch = currentSearchForm = new ew.Form("fcurrent_total_napsalistsrch");

	// Dynamic selection lists
	// Filters

	fcurrent_total_napsalistsrch.filterList = <?php echo $current_total_napsa_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcurrent_total_napsalistsrch.initSearchPanel = true;
	loadjs.done("fcurrent_total_napsalistsrch");
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
<?php if (!$current_total_napsa_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($current_total_napsa_list->TotalRecords > 0 && $current_total_napsa_list->ExportOptions->visible()) { ?>
<?php $current_total_napsa_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($current_total_napsa_list->ImportOptions->visible()) { ?>
<?php $current_total_napsa_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($current_total_napsa_list->SearchOptions->visible()) { ?>
<?php $current_total_napsa_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($current_total_napsa_list->FilterOptions->visible()) { ?>
<?php $current_total_napsa_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$current_total_napsa_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$current_total_napsa_list->isExport() && !$current_total_napsa->CurrentAction) { ?>
<form name="fcurrent_total_napsalistsrch" id="fcurrent_total_napsalistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcurrent_total_napsalistsrch-search-panel" class="<?php echo $current_total_napsa_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="current_total_napsa">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $current_total_napsa_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($current_total_napsa_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($current_total_napsa_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $current_total_napsa_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($current_total_napsa_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($current_total_napsa_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($current_total_napsa_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($current_total_napsa_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $current_total_napsa_list->showPageHeader(); ?>
<?php
$current_total_napsa_list->showMessage();
?>
<?php if ($current_total_napsa_list->TotalRecords > 0 || $current_total_napsa->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($current_total_napsa_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> current_total_napsa">
<?php if (!$current_total_napsa_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$current_total_napsa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $current_total_napsa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $current_total_napsa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcurrent_total_napsalist" id="fcurrent_total_napsalist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="current_total_napsa">
<div id="gmp_current_total_napsa" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($current_total_napsa_list->TotalRecords > 0 || $current_total_napsa_list->isGridEdit()) { ?>
<table id="tbl_current_total_napsalist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$current_total_napsa->RowType = ROWTYPE_HEADER;

// Render list options
$current_total_napsa_list->renderListOptions();

// Render list options (header, left)
$current_total_napsa_list->ListOptions->render("header", "left");
?>
<?php if ($current_total_napsa_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($current_total_napsa_list->SortUrl($current_total_napsa_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $current_total_napsa_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_current_total_napsa_PayrollPeriod" class="current_total_napsa_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $current_total_napsa_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $current_total_napsa_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_total_napsa_list->SortUrl($current_total_napsa_list->PayrollPeriod) ?>', 1);"><div id="elh_current_total_napsa_PayrollPeriod" class="current_total_napsa_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_total_napsa_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_total_napsa_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_total_napsa_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_total_napsa_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($current_total_napsa_list->SortUrl($current_total_napsa_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $current_total_napsa_list->DeductionCode->headerCellClass() ?>"><div id="elh_current_total_napsa_DeductionCode" class="current_total_napsa_DeductionCode"><div class="ew-table-header-caption"><?php echo $current_total_napsa_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $current_total_napsa_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_total_napsa_list->SortUrl($current_total_napsa_list->DeductionCode) ?>', 1);"><div id="elh_current_total_napsa_DeductionCode" class="current_total_napsa_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_total_napsa_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($current_total_napsa_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_total_napsa_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_total_napsa_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($current_total_napsa_list->SortUrl($current_total_napsa_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $current_total_napsa_list->DeductionName->headerCellClass() ?>"><div id="elh_current_total_napsa_DeductionName" class="current_total_napsa_DeductionName"><div class="ew-table-header-caption"><?php echo $current_total_napsa_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $current_total_napsa_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_total_napsa_list->SortUrl($current_total_napsa_list->DeductionName) ?>', 1);"><div id="elh_current_total_napsa_DeductionName" class="current_total_napsa_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_total_napsa_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($current_total_napsa_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_total_napsa_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($current_total_napsa_list->total_napsa->Visible) { // total_napsa ?>
	<?php if ($current_total_napsa_list->SortUrl($current_total_napsa_list->total_napsa) == "") { ?>
		<th data-name="total_napsa" class="<?php echo $current_total_napsa_list->total_napsa->headerCellClass() ?>"><div id="elh_current_total_napsa_total_napsa" class="current_total_napsa_total_napsa"><div class="ew-table-header-caption"><?php echo $current_total_napsa_list->total_napsa->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="total_napsa" class="<?php echo $current_total_napsa_list->total_napsa->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $current_total_napsa_list->SortUrl($current_total_napsa_list->total_napsa) ?>', 1);"><div id="elh_current_total_napsa_total_napsa" class="current_total_napsa_total_napsa">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $current_total_napsa_list->total_napsa->caption() ?></span><span class="ew-table-header-sort"><?php if ($current_total_napsa_list->total_napsa->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($current_total_napsa_list->total_napsa->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$current_total_napsa_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($current_total_napsa_list->ExportAll && $current_total_napsa_list->isExport()) {
	$current_total_napsa_list->StopRecord = $current_total_napsa_list->TotalRecords;
} else {

	// Set the last record to display
	if ($current_total_napsa_list->TotalRecords > $current_total_napsa_list->StartRecord + $current_total_napsa_list->DisplayRecords - 1)
		$current_total_napsa_list->StopRecord = $current_total_napsa_list->StartRecord + $current_total_napsa_list->DisplayRecords - 1;
	else
		$current_total_napsa_list->StopRecord = $current_total_napsa_list->TotalRecords;
}
$current_total_napsa_list->RecordCount = $current_total_napsa_list->StartRecord - 1;
if ($current_total_napsa_list->Recordset && !$current_total_napsa_list->Recordset->EOF) {
	$current_total_napsa_list->Recordset->moveFirst();
	$selectLimit = $current_total_napsa_list->UseSelectLimit;
	if (!$selectLimit && $current_total_napsa_list->StartRecord > 1)
		$current_total_napsa_list->Recordset->move($current_total_napsa_list->StartRecord - 1);
} elseif (!$current_total_napsa->AllowAddDeleteRow && $current_total_napsa_list->StopRecord == 0) {
	$current_total_napsa_list->StopRecord = $current_total_napsa->GridAddRowCount;
}

// Initialize aggregate
$current_total_napsa->RowType = ROWTYPE_AGGREGATEINIT;
$current_total_napsa->resetAttributes();
$current_total_napsa_list->renderRow();
while ($current_total_napsa_list->RecordCount < $current_total_napsa_list->StopRecord) {
	$current_total_napsa_list->RecordCount++;
	if ($current_total_napsa_list->RecordCount >= $current_total_napsa_list->StartRecord) {
		$current_total_napsa_list->RowCount++;

		// Set up key count
		$current_total_napsa_list->KeyCount = $current_total_napsa_list->RowIndex;

		// Init row class and style
		$current_total_napsa->resetAttributes();
		$current_total_napsa->CssClass = "";
		if ($current_total_napsa_list->isGridAdd()) {
		} else {
			$current_total_napsa_list->loadRowValues($current_total_napsa_list->Recordset); // Load row values
		}
		$current_total_napsa->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$current_total_napsa->RowAttrs->merge(["data-rowindex" => $current_total_napsa_list->RowCount, "id" => "r" . $current_total_napsa_list->RowCount . "_current_total_napsa", "data-rowtype" => $current_total_napsa->RowType]);

		// Render row
		$current_total_napsa_list->renderRow();

		// Render list options
		$current_total_napsa_list->renderListOptions();
?>
	<tr <?php echo $current_total_napsa->rowAttributes() ?>>
<?php

// Render list options (body, left)
$current_total_napsa_list->ListOptions->render("body", "left", $current_total_napsa_list->RowCount);
?>
	<?php if ($current_total_napsa_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $current_total_napsa_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $current_total_napsa_list->RowCount ?>_current_total_napsa_PayrollPeriod">
<span<?php echo $current_total_napsa_list->PayrollPeriod->viewAttributes() ?>><?php echo $current_total_napsa_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_total_napsa_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $current_total_napsa_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $current_total_napsa_list->RowCount ?>_current_total_napsa_DeductionCode">
<span<?php echo $current_total_napsa_list->DeductionCode->viewAttributes() ?>><?php echo $current_total_napsa_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_total_napsa_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $current_total_napsa_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $current_total_napsa_list->RowCount ?>_current_total_napsa_DeductionName">
<span<?php echo $current_total_napsa_list->DeductionName->viewAttributes() ?>><?php echo $current_total_napsa_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($current_total_napsa_list->total_napsa->Visible) { // total_napsa ?>
		<td data-name="total_napsa" <?php echo $current_total_napsa_list->total_napsa->cellAttributes() ?>>
<span id="el<?php echo $current_total_napsa_list->RowCount ?>_current_total_napsa_total_napsa">
<span<?php echo $current_total_napsa_list->total_napsa->viewAttributes() ?>><?php echo $current_total_napsa_list->total_napsa->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$current_total_napsa_list->ListOptions->render("body", "right", $current_total_napsa_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$current_total_napsa_list->isGridAdd())
		$current_total_napsa_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$current_total_napsa->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($current_total_napsa_list->Recordset)
	$current_total_napsa_list->Recordset->Close();
?>
<?php if (!$current_total_napsa_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$current_total_napsa_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $current_total_napsa_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $current_total_napsa_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($current_total_napsa_list->TotalRecords == 0 && !$current_total_napsa->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $current_total_napsa_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$current_total_napsa_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$current_total_napsa_list->isExport()) { ?>
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
$current_total_napsa_list->terminate();
?>