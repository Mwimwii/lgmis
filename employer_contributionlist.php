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
$employer_contribution_list = new employer_contribution_list();

// Run the page
$employer_contribution_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$employer_contribution_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$employer_contribution_list->isExport()) { ?>
<script>
var femployer_contributionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	femployer_contributionlist = currentForm = new ew.Form("femployer_contributionlist", "list");
	femployer_contributionlist.formKeyCountName = '<?php echo $employer_contribution_list->FormKeyCountName ?>';
	loadjs.done("femployer_contributionlist");
});
var femployer_contributionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	femployer_contributionlistsrch = currentSearchForm = new ew.Form("femployer_contributionlistsrch");

	// Dynamic selection lists
	// Filters

	femployer_contributionlistsrch.filterList = <?php echo $employer_contribution_list->getFilterList() ?>;

	// Init search panel as collapsed
	femployer_contributionlistsrch.initSearchPanel = true;
	loadjs.done("femployer_contributionlistsrch");
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
<?php if (!$employer_contribution_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($employer_contribution_list->TotalRecords > 0 && $employer_contribution_list->ExportOptions->visible()) { ?>
<?php $employer_contribution_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($employer_contribution_list->ImportOptions->visible()) { ?>
<?php $employer_contribution_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($employer_contribution_list->SearchOptions->visible()) { ?>
<?php $employer_contribution_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($employer_contribution_list->FilterOptions->visible()) { ?>
<?php $employer_contribution_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$employer_contribution_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$employer_contribution_list->isExport() && !$employer_contribution->CurrentAction) { ?>
<form name="femployer_contributionlistsrch" id="femployer_contributionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="femployer_contributionlistsrch-search-panel" class="<?php echo $employer_contribution_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="employer_contribution">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $employer_contribution_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($employer_contribution_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($employer_contribution_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $employer_contribution_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($employer_contribution_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($employer_contribution_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($employer_contribution_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($employer_contribution_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $employer_contribution_list->showPageHeader(); ?>
<?php
$employer_contribution_list->showMessage();
?>
<?php if ($employer_contribution_list->TotalRecords > 0 || $employer_contribution->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($employer_contribution_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> employer_contribution">
<?php if (!$employer_contribution_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$employer_contribution_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employer_contribution_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employer_contribution_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="femployer_contributionlist" id="femployer_contributionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="employer_contribution">
<div id="gmp_employer_contribution" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($employer_contribution_list->TotalRecords > 0 || $employer_contribution_list->isGridEdit()) { ?>
<table id="tbl_employer_contributionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$employer_contribution->RowType = ROWTYPE_HEADER;

// Render list options
$employer_contribution_list->renderListOptions();

// Render list options (header, left)
$employer_contribution_list->ListOptions->render("header", "left");
?>
<?php if ($employer_contribution_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
	<?php if ($employer_contribution_list->SortUrl($employer_contribution_list->PayrollPeriod) == "") { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employer_contribution_list->PayrollPeriod->headerCellClass() ?>"><div id="elh_employer_contribution_PayrollPeriod" class="employer_contribution_PayrollPeriod"><div class="ew-table-header-caption"><?php echo $employer_contribution_list->PayrollPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollPeriod" class="<?php echo $employer_contribution_list->PayrollPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employer_contribution_list->SortUrl($employer_contribution_list->PayrollPeriod) ?>', 1);"><div id="elh_employer_contribution_PayrollPeriod" class="employer_contribution_PayrollPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employer_contribution_list->PayrollPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($employer_contribution_list->PayrollPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employer_contribution_list->PayrollPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employer_contribution_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($employer_contribution_list->SortUrl($employer_contribution_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $employer_contribution_list->DeductionCode->headerCellClass() ?>"><div id="elh_employer_contribution_DeductionCode" class="employer_contribution_DeductionCode"><div class="ew-table-header-caption"><?php echo $employer_contribution_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $employer_contribution_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employer_contribution_list->SortUrl($employer_contribution_list->DeductionCode) ?>', 1);"><div id="elh_employer_contribution_DeductionCode" class="employer_contribution_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employer_contribution_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($employer_contribution_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employer_contribution_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($employer_contribution_list->TotalDeductions->Visible) { // TotalDeductions ?>
	<?php if ($employer_contribution_list->SortUrl($employer_contribution_list->TotalDeductions) == "") { ?>
		<th data-name="TotalDeductions" class="<?php echo $employer_contribution_list->TotalDeductions->headerCellClass() ?>"><div id="elh_employer_contribution_TotalDeductions" class="employer_contribution_TotalDeductions"><div class="ew-table-header-caption"><?php echo $employer_contribution_list->TotalDeductions->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TotalDeductions" class="<?php echo $employer_contribution_list->TotalDeductions->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $employer_contribution_list->SortUrl($employer_contribution_list->TotalDeductions) ?>', 1);"><div id="elh_employer_contribution_TotalDeductions" class="employer_contribution_TotalDeductions">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $employer_contribution_list->TotalDeductions->caption() ?></span><span class="ew-table-header-sort"><?php if ($employer_contribution_list->TotalDeductions->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($employer_contribution_list->TotalDeductions->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$employer_contribution_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($employer_contribution_list->ExportAll && $employer_contribution_list->isExport()) {
	$employer_contribution_list->StopRecord = $employer_contribution_list->TotalRecords;
} else {

	// Set the last record to display
	if ($employer_contribution_list->TotalRecords > $employer_contribution_list->StartRecord + $employer_contribution_list->DisplayRecords - 1)
		$employer_contribution_list->StopRecord = $employer_contribution_list->StartRecord + $employer_contribution_list->DisplayRecords - 1;
	else
		$employer_contribution_list->StopRecord = $employer_contribution_list->TotalRecords;
}
$employer_contribution_list->RecordCount = $employer_contribution_list->StartRecord - 1;
if ($employer_contribution_list->Recordset && !$employer_contribution_list->Recordset->EOF) {
	$employer_contribution_list->Recordset->moveFirst();
	$selectLimit = $employer_contribution_list->UseSelectLimit;
	if (!$selectLimit && $employer_contribution_list->StartRecord > 1)
		$employer_contribution_list->Recordset->move($employer_contribution_list->StartRecord - 1);
} elseif (!$employer_contribution->AllowAddDeleteRow && $employer_contribution_list->StopRecord == 0) {
	$employer_contribution_list->StopRecord = $employer_contribution->GridAddRowCount;
}

// Initialize aggregate
$employer_contribution->RowType = ROWTYPE_AGGREGATEINIT;
$employer_contribution->resetAttributes();
$employer_contribution_list->renderRow();
while ($employer_contribution_list->RecordCount < $employer_contribution_list->StopRecord) {
	$employer_contribution_list->RecordCount++;
	if ($employer_contribution_list->RecordCount >= $employer_contribution_list->StartRecord) {
		$employer_contribution_list->RowCount++;

		// Set up key count
		$employer_contribution_list->KeyCount = $employer_contribution_list->RowIndex;

		// Init row class and style
		$employer_contribution->resetAttributes();
		$employer_contribution->CssClass = "";
		if ($employer_contribution_list->isGridAdd()) {
		} else {
			$employer_contribution_list->loadRowValues($employer_contribution_list->Recordset); // Load row values
		}
		$employer_contribution->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$employer_contribution->RowAttrs->merge(["data-rowindex" => $employer_contribution_list->RowCount, "id" => "r" . $employer_contribution_list->RowCount . "_employer_contribution", "data-rowtype" => $employer_contribution->RowType]);

		// Render row
		$employer_contribution_list->renderRow();

		// Render list options
		$employer_contribution_list->renderListOptions();
?>
	<tr <?php echo $employer_contribution->rowAttributes() ?>>
<?php

// Render list options (body, left)
$employer_contribution_list->ListOptions->render("body", "left", $employer_contribution_list->RowCount);
?>
	<?php if ($employer_contribution_list->PayrollPeriod->Visible) { // PayrollPeriod ?>
		<td data-name="PayrollPeriod" <?php echo $employer_contribution_list->PayrollPeriod->cellAttributes() ?>>
<span id="el<?php echo $employer_contribution_list->RowCount ?>_employer_contribution_PayrollPeriod">
<span<?php echo $employer_contribution_list->PayrollPeriod->viewAttributes() ?>><?php echo $employer_contribution_list->PayrollPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employer_contribution_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $employer_contribution_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $employer_contribution_list->RowCount ?>_employer_contribution_DeductionCode">
<span<?php echo $employer_contribution_list->DeductionCode->viewAttributes() ?>><?php echo $employer_contribution_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($employer_contribution_list->TotalDeductions->Visible) { // TotalDeductions ?>
		<td data-name="TotalDeductions" <?php echo $employer_contribution_list->TotalDeductions->cellAttributes() ?>>
<span id="el<?php echo $employer_contribution_list->RowCount ?>_employer_contribution_TotalDeductions">
<span<?php echo $employer_contribution_list->TotalDeductions->viewAttributes() ?>><?php echo $employer_contribution_list->TotalDeductions->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$employer_contribution_list->ListOptions->render("body", "right", $employer_contribution_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$employer_contribution_list->isGridAdd())
		$employer_contribution_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$employer_contribution->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($employer_contribution_list->Recordset)
	$employer_contribution_list->Recordset->Close();
?>
<?php if (!$employer_contribution_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$employer_contribution_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $employer_contribution_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $employer_contribution_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($employer_contribution_list->TotalRecords == 0 && !$employer_contribution->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $employer_contribution_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$employer_contribution_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$employer_contribution_list->isExport()) { ?>
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
$employer_contribution_list->terminate();
?>