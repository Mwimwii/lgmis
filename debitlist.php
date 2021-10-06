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
$debit_list = new debit_list();

// Run the page
$debit_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$debit_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$debit_list->isExport()) { ?>
<script>
var fdebitlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdebitlist = currentForm = new ew.Form("fdebitlist", "list");
	fdebitlist.formKeyCountName = '<?php echo $debit_list->FormKeyCountName ?>';
	loadjs.done("fdebitlist");
});
var fdebitlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdebitlistsrch = currentSearchForm = new ew.Form("fdebitlistsrch");

	// Dynamic selection lists
	// Filters

	fdebitlistsrch.filterList = <?php echo $debit_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdebitlistsrch.initSearchPanel = true;
	loadjs.done("fdebitlistsrch");
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
<?php if (!$debit_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($debit_list->TotalRecords > 0 && $debit_list->ExportOptions->visible()) { ?>
<?php $debit_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($debit_list->ImportOptions->visible()) { ?>
<?php $debit_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($debit_list->SearchOptions->visible()) { ?>
<?php $debit_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($debit_list->FilterOptions->visible()) { ?>
<?php $debit_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$debit_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$debit_list->isExport() && !$debit->CurrentAction) { ?>
<form name="fdebitlistsrch" id="fdebitlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdebitlistsrch-search-panel" class="<?php echo $debit_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="debit">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $debit_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($debit_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($debit_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $debit_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($debit_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($debit_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($debit_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($debit_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $debit_list->showPageHeader(); ?>
<?php
$debit_list->showMessage();
?>
<?php if ($debit_list->TotalRecords > 0 || $debit->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($debit_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> debit">
<?php if (!$debit_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$debit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $debit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $debit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdebitlist" id="fdebitlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="debit">
<div id="gmp_debit" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($debit_list->TotalRecords > 0 || $debit_list->isGridEdit()) { ?>
<table id="tbl_debitlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$debit->RowType = ROWTYPE_HEADER;

// Render list options
$debit_list->renderListOptions();

// Render list options (header, left)
$debit_list->ListOptions->render("header", "left");
?>
<?php if ($debit_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($debit_list->SortUrl($debit_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $debit_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_debit_PayrollPeriod" class="debit_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $debit_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $debit_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $debit_list->SortUrl($debit_list->PayrollPeriod) ?>', 1);"><div id="elh_debit_PayrollPeriod" class="debit_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $debit_list->PayrollPeriod->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($debit_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($debit_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($debit_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($debit_list->SortUrl($debit_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $debit_list->DeductionCode->headerCellClass() ?>"><div id="elh_debit_DeductionCode" class="debit_DeductionCode"><div class="ew-table-header-caption"><?php echo $debit_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $debit_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $debit_list->SortUrl($debit_list->DeductionCode) ?>', 1);"><div id="elh_debit_DeductionCode" class="debit_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $debit_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($debit_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($debit_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($debit_list->TotalDeductions->Visible) { // TotalDeductions ?>
	<?php if ($debit_list->SortUrl($debit_list->TotalDeductions) == "") { ?>
		<th data-name="TotalDeductions" class="<?php echo $debit_list->TotalDeductions->headerCellClass() ?>"><div id="elh_debit_TotalDeductions" class="debit_TotalDeductions"><div class="ew-table-header-caption"><?php echo $debit_list->TotalDeductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDeductions" class="<?php echo $debit_list->TotalDeductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $debit_list->SortUrl($debit_list->TotalDeductions) ?>', 1);"><div id="elh_debit_TotalDeductions" class="debit_TotalDeductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $debit_list->TotalDeductions->caption() ?></span><span class="ew-table-header-sort"><?php if ($debit_list->TotalDeductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($debit_list->TotalDeductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$debit_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($debit_list->ExportAll && $debit_list->isExport()) {
	$debit_list->StopRecord = $debit_list->TotalRecords;
} else {

	// Set the last record to display
	if ($debit_list->TotalRecords > $debit_list->StartRecord + $debit_list->DisplayRecords - 1)
		$debit_list->StopRecord = $debit_list->StartRecord + $debit_list->DisplayRecords - 1;
	else
		$debit_list->StopRecord = $debit_list->TotalRecords;
}
$debit_list->RecordCount = $debit_list->StartRecord - 1;
if ($debit_list->Recordset && !$debit_list->Recordset->EOF) {
	$debit_list->Recordset->moveFirst();
	$selectLimit = $debit_list->UseSelectLimit;
	if (!$selectLimit && $debit_list->StartRecord > 1)
		$debit_list->Recordset->move($debit_list->StartRecord - 1);
} elseif (!$debit->AllowAddDeleteRow && $debit_list->StopRecord == 0) {
	$debit_list->StopRecord = $debit->GridAddRowCount;
}

// Initialize aggregate
$debit->RowType = ROWTYPE_AGGREGATEINIT;
$debit->resetAttributes();
$debit_list->renderRow();
while ($debit_list->RecordCount < $debit_list->StopRecord) {
	$debit_list->RecordCount++;
	if ($debit_list->RecordCount >= $debit_list->StartRecord) {
		$debit_list->RowCount++;

		// Set up key count
		$debit_list->KeyCount = $debit_list->RowIndex;

		// Init row class and style
		$debit->resetAttributes();
		$debit->CssClass = "";
		if ($debit_list->isGridAdd()) {
		} else {
			$debit_list->loadRowValues($debit_list->Recordset); // Load row values
		}
		$debit->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$debit->RowAttrs->merge(["data-rowindex" => $debit_list->RowCount, "id" => "r" . $debit_list->RowCount . "_debit", "data-rowtype" => $debit->RowType]);

		// Render row
		$debit_list->renderRow();

		// Render list options
		$debit_list->renderListOptions();
?>
	<tr <?php echo $debit->rowAttributes() ?>>
<?php

// Render list options (body, left)
$debit_list->ListOptions->render("body", "left", $debit_list->RowCount);
?>
	<?php if ($debit_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $debit_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $debit_list->RowCount ?>_debit_PayrollPeriod">
<span<?php echo $debit_list->PayrollPeriod->viewAttributes() ?>><?php echo $debit_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($debit_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $debit_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $debit_list->RowCount ?>_debit_DeductionCode">
<span<?php echo $debit_list->DeductionCode->viewAttributes() ?>><?php echo $debit_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($debit_list->TotalDeductions->Visible) { // TotalDeductions ?>
		<td data-name="TotalDeductions" <?php echo $debit_list->TotalDeductions->cellAttributes() ?>>
<span id="el<?php echo $debit_list->RowCount ?>_debit_TotalDeductions">
<span<?php echo $debit_list->TotalDeductions->viewAttributes() ?>><?php echo $debit_list->TotalDeductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$debit_list->ListOptions->render("body", "right", $debit_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$debit_list->isGridAdd())
		$debit_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$debit->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($debit_list->Recordset)
	$debit_list->Recordset->Close();
?>
<?php if (!$debit_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$debit_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $debit_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $debit_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($debit_list->TotalRecords == 0 && !$debit->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $debit_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$debit_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$debit_list->isExport()) { ?>
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
$debit_list->terminate();
?>