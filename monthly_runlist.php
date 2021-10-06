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
$monthly_run_list = new monthly_run_list();

// Run the page
$monthly_run_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_run_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$monthly_run_list->isExport()) { ?>
<script>
var fmonthly_runlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmonthly_runlist = currentForm = new ew.Form("fmonthly_runlist", "list");
	fmonthly_runlist.formKeyCountName = '<?php echo $monthly_run_list->FormKeyCountName ?>';
	loadjs.done("fmonthly_runlist");
});
var fmonthly_runlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmonthly_runlistsrch = currentSearchForm = new ew.Form("fmonthly_runlistsrch");

	// Dynamic selection lists
	// Filters

	fmonthly_runlistsrch.filterList = <?php echo $monthly_run_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmonthly_runlistsrch.initSearchPanel = true;
	loadjs.done("fmonthly_runlistsrch");
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
<?php if (!$monthly_run_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($monthly_run_list->TotalRecords > 0 && $monthly_run_list->ExportOptions->visible()) { ?>
<?php $monthly_run_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_run_list->ImportOptions->visible()) { ?>
<?php $monthly_run_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_run_list->SearchOptions->visible()) { ?>
<?php $monthly_run_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_run_list->FilterOptions->visible()) { ?>
<?php $monthly_run_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$monthly_run_list->isExport() || Config("EXPORT_MASTER_RECORD") && $monthly_run_list->isExport("print")) { ?>
<?php
if ($monthly_run_list->DbMasterFilter != "" && $monthly_run->getCurrentMasterTable() == "payroll_period") {
	if ($monthly_run_list->MasterRecordExists) {
		include_once "payroll_periodmaster.php";
	}
}
?>
<?php
if ($monthly_run_list->DbMasterFilter != "" && $monthly_run->getCurrentMasterTable() == "local_authority") {
	if ($monthly_run_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$monthly_run_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$monthly_run_list->isExport() && !$monthly_run->CurrentAction) { ?>
<form name="fmonthly_runlistsrch" id="fmonthly_runlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmonthly_runlistsrch-search-panel" class="<?php echo $monthly_run_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="monthly_run">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $monthly_run_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($monthly_run_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($monthly_run_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $monthly_run_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($monthly_run_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($monthly_run_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($monthly_run_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($monthly_run_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $monthly_run_list->showPageHeader(); ?>
<?php
$monthly_run_list->showMessage();
?>
<?php if ($monthly_run_list->TotalRecords > 0 || $monthly_run->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($monthly_run_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monthly_run">
<?php if (!$monthly_run_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$monthly_run_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_run_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $monthly_run_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmonthly_runlist" id="fmonthly_runlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_run">
<?php if ($monthly_run->getCurrentMasterTable() == "payroll_period" && $monthly_run->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="payroll_period">
<input type="hidden" name="fk_PeriodCode" value="<?php echo HtmlEncode($monthly_run_list->PeriodCode->getSessionValue()) ?>">
<input type="hidden" name="fk_FiscalYear" value="<?php echo HtmlEncode($monthly_run_list->Year->getSessionValue()) ?>">
<input type="hidden" name="fk_RunMonth" value="<?php echo HtmlEncode($monthly_run_list->RunMonth->getSessionValue()) ?>">
<?php } ?>
<?php if ($monthly_run->getCurrentMasterTable() == "local_authority" && $monthly_run->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($monthly_run_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_monthly_run" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($monthly_run_list->TotalRecords > 0 || $monthly_run_list->isGridEdit()) { ?>
<table id="tbl_monthly_runlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$monthly_run->RowType = ROWTYPE_HEADER;

// Render list options
$monthly_run_list->renderListOptions();

// Render list options (header, left)
$monthly_run_list->ListOptions->render("header", "left");
?>
<?php if ($monthly_run_list->LACode->Visible) { // LACode ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $monthly_run_list->LACode->headerCellClass() ?>"><div id="elh_monthly_run_LACode" class="monthly_run_LACode"><div class="ew-table-header-caption"><?php echo $monthly_run_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $monthly_run_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->LACode) ?>', 1);"><div id="elh_monthly_run_LACode" class="monthly_run_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_list->PeriodCode->Visible) { // PeriodCode ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->PeriodCode) == "") { ?>
		<th data-name="PeriodCode" class="<?php echo $monthly_run_list->PeriodCode->headerCellClass() ?>"><div id="elh_monthly_run_PeriodCode" class="monthly_run_PeriodCode"><div class="ew-table-header-caption"><?php echo $monthly_run_list->PeriodCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodCode" class="<?php echo $monthly_run_list->PeriodCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->PeriodCode) ?>', 1);"><div id="elh_monthly_run_PeriodCode" class="monthly_run_PeriodCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->PeriodCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->PeriodCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->PeriodCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_list->RunDate->Visible) { // RunDate ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->RunDate) == "") { ?>
		<th data-name="RunDate" class="<?php echo $monthly_run_list->RunDate->headerCellClass() ?>"><div id="elh_monthly_run_RunDate" class="monthly_run_RunDate"><div class="ew-table-header-caption"><?php echo $monthly_run_list->RunDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunDate" class="<?php echo $monthly_run_list->RunDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->RunDate) ?>', 1);"><div id="elh_monthly_run_RunDate" class="monthly_run_RunDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->RunDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->RunDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->RunDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_list->Description->Visible) { // Description ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->Description) == "") { ?>
		<th data-name="Description" class="<?php echo $monthly_run_list->Description->headerCellClass() ?>"><div id="elh_monthly_run_Description" class="monthly_run_Description"><div class="ew-table-header-caption"><?php echo $monthly_run_list->Description->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Description" class="<?php echo $monthly_run_list->Description->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->Description) ?>', 1);"><div id="elh_monthly_run_Description" class="monthly_run_Description">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->Description->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->Description->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->Description->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_list->Year->Visible) { // Year ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $monthly_run_list->Year->headerCellClass() ?>"><div id="elh_monthly_run_Year" class="monthly_run_Year"><div class="ew-table-header-caption"><?php echo $monthly_run_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $monthly_run_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->Year) ?>', 1);"><div id="elh_monthly_run_Year" class="monthly_run_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_list->RunMonth->Visible) { // RunMonth ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->RunMonth) == "") { ?>
		<th data-name="RunMonth" class="<?php echo $monthly_run_list->RunMonth->headerCellClass() ?>"><div id="elh_monthly_run_RunMonth" class="monthly_run_RunMonth"><div class="ew-table-header-caption"><?php echo $monthly_run_list->RunMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunMonth" class="<?php echo $monthly_run_list->RunMonth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->RunMonth) ?>', 1);"><div id="elh_monthly_run_RunMonth" class="monthly_run_RunMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->RunMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->RunMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->RunMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_run_list->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($monthly_run_list->SortUrl($monthly_run_list->PayrollCode) == "") { ?>
		<th data-name="PayrollCode" class="<?php echo $monthly_run_list->PayrollCode->headerCellClass() ?>"><div id="elh_monthly_run_PayrollCode" class="monthly_run_PayrollCode"><div class="ew-table-header-caption"><?php echo $monthly_run_list->PayrollCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollCode" class="<?php echo $monthly_run_list->PayrollCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_run_list->SortUrl($monthly_run_list->PayrollCode) ?>', 1);"><div id="elh_monthly_run_PayrollCode" class="monthly_run_PayrollCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_run_list->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($monthly_run_list->PayrollCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_run_list->PayrollCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$monthly_run_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($monthly_run_list->ExportAll && $monthly_run_list->isExport()) {
	$monthly_run_list->StopRecord = $monthly_run_list->TotalRecords;
} else {

	// Set the last record to display
	if ($monthly_run_list->TotalRecords > $monthly_run_list->StartRecord + $monthly_run_list->DisplayRecords - 1)
		$monthly_run_list->StopRecord = $monthly_run_list->StartRecord + $monthly_run_list->DisplayRecords - 1;
	else
		$monthly_run_list->StopRecord = $monthly_run_list->TotalRecords;
}
$monthly_run_list->RecordCount = $monthly_run_list->StartRecord - 1;
if ($monthly_run_list->Recordset && !$monthly_run_list->Recordset->EOF) {
	$monthly_run_list->Recordset->moveFirst();
	$selectLimit = $monthly_run_list->UseSelectLimit;
	if (!$selectLimit && $monthly_run_list->StartRecord > 1)
		$monthly_run_list->Recordset->move($monthly_run_list->StartRecord - 1);
} elseif (!$monthly_run->AllowAddDeleteRow && $monthly_run_list->StopRecord == 0) {
	$monthly_run_list->StopRecord = $monthly_run->GridAddRowCount;
}

// Initialize aggregate
$monthly_run->RowType = ROWTYPE_AGGREGATEINIT;
$monthly_run->resetAttributes();
$monthly_run_list->renderRow();
while ($monthly_run_list->RecordCount < $monthly_run_list->StopRecord) {
	$monthly_run_list->RecordCount++;
	if ($monthly_run_list->RecordCount >= $monthly_run_list->StartRecord) {
		$monthly_run_list->RowCount++;

		// Set up key count
		$monthly_run_list->KeyCount = $monthly_run_list->RowIndex;

		// Init row class and style
		$monthly_run->resetAttributes();
		$monthly_run->CssClass = "";
		if ($monthly_run_list->isGridAdd()) {
		} else {
			$monthly_run_list->loadRowValues($monthly_run_list->Recordset); // Load row values
		}
		$monthly_run->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$monthly_run->RowAttrs->merge(["data-rowindex" => $monthly_run_list->RowCount, "id" => "r" . $monthly_run_list->RowCount . "_monthly_run", "data-rowtype" => $monthly_run->RowType]);

		// Render row
		$monthly_run_list->renderRow();

		// Render list options
		$monthly_run_list->renderListOptions();
?>
	<tr <?php echo $monthly_run->rowAttributes() ?>>
<?php

// Render list options (body, left)
$monthly_run_list->ListOptions->render("body", "left", $monthly_run_list->RowCount);
?>
	<?php if ($monthly_run_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $monthly_run_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_LACode">
<span<?php echo $monthly_run_list->LACode->viewAttributes() ?>><?php echo $monthly_run_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_run_list->PeriodCode->Visible) { // PeriodCode ?>
		<td data-name="PeriodCode" <?php echo $monthly_run_list->PeriodCode->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_PeriodCode">
<span<?php echo $monthly_run_list->PeriodCode->viewAttributes() ?>><?php echo $monthly_run_list->PeriodCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_run_list->RunDate->Visible) { // RunDate ?>
		<td data-name="RunDate" <?php echo $monthly_run_list->RunDate->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_RunDate">
<span<?php echo $monthly_run_list->RunDate->viewAttributes() ?>><?php echo $monthly_run_list->RunDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_run_list->Description->Visible) { // Description ?>
		<td data-name="Description" <?php echo $monthly_run_list->Description->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_Description">
<span<?php echo $monthly_run_list->Description->viewAttributes() ?>><?php echo $monthly_run_list->Description->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_run_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $monthly_run_list->Year->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_Year">
<span<?php echo $monthly_run_list->Year->viewAttributes() ?>><?php echo $monthly_run_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_run_list->RunMonth->Visible) { // RunMonth ?>
		<td data-name="RunMonth" <?php echo $monthly_run_list->RunMonth->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_RunMonth">
<span<?php echo $monthly_run_list->RunMonth->viewAttributes() ?>><?php echo $monthly_run_list->RunMonth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_run_list->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode" <?php echo $monthly_run_list->PayrollCode->cellAttributes() ?>>
<span id="el<?php echo $monthly_run_list->RowCount ?>_monthly_run_PayrollCode">
<span<?php echo $monthly_run_list->PayrollCode->viewAttributes() ?>><?php echo $monthly_run_list->PayrollCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$monthly_run_list->ListOptions->render("body", "right", $monthly_run_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$monthly_run_list->isGridAdd())
		$monthly_run_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$monthly_run->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($monthly_run_list->Recordset)
	$monthly_run_list->Recordset->Close();
?>
<?php if (!$monthly_run_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$monthly_run_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_run_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $monthly_run_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($monthly_run_list->TotalRecords == 0 && !$monthly_run->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $monthly_run_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$monthly_run_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$monthly_run_list->isExport()) { ?>
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
$monthly_run_list->terminate();
?>