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
$leave_accrued_trans_list = new leave_accrued_trans_list();

// Run the page
$leave_accrued_trans_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_accrued_trans_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_accrued_trans_list->isExport()) { ?>
<script>
var fleave_accrued_translist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_accrued_translist = currentForm = new ew.Form("fleave_accrued_translist", "list");
	fleave_accrued_translist.formKeyCountName = '<?php echo $leave_accrued_trans_list->FormKeyCountName ?>';
	loadjs.done("fleave_accrued_translist");
});
var fleave_accrued_translistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fleave_accrued_translistsrch = currentSearchForm = new ew.Form("fleave_accrued_translistsrch");

	// Dynamic selection lists
	// Filters

	fleave_accrued_translistsrch.filterList = <?php echo $leave_accrued_trans_list->getFilterList() ?>;

	// Init search panel as collapsed
	fleave_accrued_translistsrch.initSearchPanel = true;
	loadjs.done("fleave_accrued_translistsrch");
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
<?php if (!$leave_accrued_trans_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_accrued_trans_list->TotalRecords > 0 && $leave_accrued_trans_list->ExportOptions->visible()) { ?>
<?php $leave_accrued_trans_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->ImportOptions->visible()) { ?>
<?php $leave_accrued_trans_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->SearchOptions->visible()) { ?>
<?php $leave_accrued_trans_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->FilterOptions->visible()) { ?>
<?php $leave_accrued_trans_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$leave_accrued_trans_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$leave_accrued_trans_list->isExport() && !$leave_accrued_trans->CurrentAction) { ?>
<form name="fleave_accrued_translistsrch" id="fleave_accrued_translistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fleave_accrued_translistsrch-search-panel" class="<?php echo $leave_accrued_trans_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="leave_accrued_trans">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $leave_accrued_trans_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($leave_accrued_trans_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($leave_accrued_trans_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $leave_accrued_trans_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($leave_accrued_trans_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($leave_accrued_trans_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($leave_accrued_trans_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($leave_accrued_trans_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $leave_accrued_trans_list->showPageHeader(); ?>
<?php
$leave_accrued_trans_list->showMessage();
?>
<?php if ($leave_accrued_trans_list->TotalRecords > 0 || $leave_accrued_trans->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_accrued_trans_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_accrued_trans">
<?php if (!$leave_accrued_trans_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_accrued_trans_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_accrued_trans_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_accrued_trans_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_accrued_translist" id="fleave_accrued_translist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_accrued_trans">
<div id="gmp_leave_accrued_trans" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_accrued_trans_list->TotalRecords > 0 || $leave_accrued_trans_list->isGridEdit()) { ?>
<table id="tbl_leave_accrued_translist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_accrued_trans->RowType = ROWTYPE_HEADER;

// Render list options
$leave_accrued_trans_list->renderListOptions();

// Render list options (header, left)
$leave_accrued_trans_list->ListOptions->render("header", "left");
?>
<?php if ($leave_accrued_trans_list->Year->Visible) { // Year ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->Year) == "") { ?>
		<th data-name="Year" class="<?php echo $leave_accrued_trans_list->Year->headerCellClass() ?>"><div id="elh_leave_accrued_trans_Year" class="leave_accrued_trans_Year"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->Year->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Year" class="<?php echo $leave_accrued_trans_list->Year->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->Year) ?>', 1);"><div id="elh_leave_accrued_trans_Year" class="leave_accrued_trans_Year">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->Year->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->Year->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->Year->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->RunMonth->Visible) { // RunMonth ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->RunMonth) == "") { ?>
		<th data-name="RunMonth" class="<?php echo $leave_accrued_trans_list->RunMonth->headerCellClass() ?>"><div id="elh_leave_accrued_trans_RunMonth" class="leave_accrued_trans_RunMonth"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->RunMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RunMonth" class="<?php echo $leave_accrued_trans_list->RunMonth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->RunMonth) ?>', 1);"><div id="elh_leave_accrued_trans_RunMonth" class="leave_accrued_trans_RunMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->RunMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->RunMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->RunMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_accrued_trans_list->EmployeeID->headerCellClass() ?>"><div id="elh_leave_accrued_trans_EmployeeID" class="leave_accrued_trans_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_accrued_trans_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->EmployeeID) ?>', 1);"><div id="elh_leave_accrued_trans_EmployeeID" class="leave_accrued_trans_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_accrued_trans_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_accrued_trans_LeaveTypeCode" class="leave_accrued_trans_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_accrued_trans_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_accrued_trans_LeaveTypeCode" class="leave_accrued_trans_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->LeaveAccrued->Visible) { // LeaveAccrued ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LeaveAccrued) == "") { ?>
		<th data-name="LeaveAccrued" class="<?php echo $leave_accrued_trans_list->LeaveAccrued->headerCellClass() ?>"><div id="elh_leave_accrued_trans_LeaveAccrued" class="leave_accrued_trans_LeaveAccrued"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LeaveAccrued->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveAccrued" class="<?php echo $leave_accrued_trans_list->LeaveAccrued->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LeaveAccrued) ?>', 1);"><div id="elh_leave_accrued_trans_LeaveAccrued" class="leave_accrued_trans_LeaveAccrued">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LeaveAccrued->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->LeaveAccrued->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->LeaveAccrued->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->LastAccrualDate->Visible) { // LastAccrualDate ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LastAccrualDate) == "") { ?>
		<th data-name="LastAccrualDate" class="<?php echo $leave_accrued_trans_list->LastAccrualDate->headerCellClass() ?>"><div id="elh_leave_accrued_trans_LastAccrualDate" class="leave_accrued_trans_LastAccrualDate"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LastAccrualDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastAccrualDate" class="<?php echo $leave_accrued_trans_list->LastAccrualDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LastAccrualDate) ?>', 1);"><div id="elh_leave_accrued_trans_LastAccrualDate" class="leave_accrued_trans_LastAccrualDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LastAccrualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->LastAccrualDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->LastAccrualDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->LeaveLost->Visible) { // LeaveLost ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LeaveLost) == "") { ?>
		<th data-name="LeaveLost" class="<?php echo $leave_accrued_trans_list->LeaveLost->headerCellClass() ?>"><div id="elh_leave_accrued_trans_LeaveLost" class="leave_accrued_trans_LeaveLost"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LeaveLost->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveLost" class="<?php echo $leave_accrued_trans_list->LeaveLost->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LeaveLost) ?>', 1);"><div id="elh_leave_accrued_trans_LeaveLost" class="leave_accrued_trans_LeaveLost">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LeaveLost->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->LeaveLost->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->LeaveLost->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_accrued_trans_list->LACode->Visible) { // LACode ?>
	<?php if ($leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $leave_accrued_trans_list->LACode->headerCellClass() ?>"><div id="elh_leave_accrued_trans_LACode" class="leave_accrued_trans_LACode"><div class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $leave_accrued_trans_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_accrued_trans_list->SortUrl($leave_accrued_trans_list->LACode) ?>', 1);"><div id="elh_leave_accrued_trans_LACode" class="leave_accrued_trans_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_accrued_trans_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_accrued_trans_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_accrued_trans_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_accrued_trans_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_accrued_trans_list->ExportAll && $leave_accrued_trans_list->isExport()) {
	$leave_accrued_trans_list->StopRecord = $leave_accrued_trans_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_accrued_trans_list->TotalRecords > $leave_accrued_trans_list->StartRecord + $leave_accrued_trans_list->DisplayRecords - 1)
		$leave_accrued_trans_list->StopRecord = $leave_accrued_trans_list->StartRecord + $leave_accrued_trans_list->DisplayRecords - 1;
	else
		$leave_accrued_trans_list->StopRecord = $leave_accrued_trans_list->TotalRecords;
}
$leave_accrued_trans_list->RecordCount = $leave_accrued_trans_list->StartRecord - 1;
if ($leave_accrued_trans_list->Recordset && !$leave_accrued_trans_list->Recordset->EOF) {
	$leave_accrued_trans_list->Recordset->moveFirst();
	$selectLimit = $leave_accrued_trans_list->UseSelectLimit;
	if (!$selectLimit && $leave_accrued_trans_list->StartRecord > 1)
		$leave_accrued_trans_list->Recordset->move($leave_accrued_trans_list->StartRecord - 1);
} elseif (!$leave_accrued_trans->AllowAddDeleteRow && $leave_accrued_trans_list->StopRecord == 0) {
	$leave_accrued_trans_list->StopRecord = $leave_accrued_trans->GridAddRowCount;
}

// Initialize aggregate
$leave_accrued_trans->RowType = ROWTYPE_AGGREGATEINIT;
$leave_accrued_trans->resetAttributes();
$leave_accrued_trans_list->renderRow();
while ($leave_accrued_trans_list->RecordCount < $leave_accrued_trans_list->StopRecord) {
	$leave_accrued_trans_list->RecordCount++;
	if ($leave_accrued_trans_list->RecordCount >= $leave_accrued_trans_list->StartRecord) {
		$leave_accrued_trans_list->RowCount++;

		// Set up key count
		$leave_accrued_trans_list->KeyCount = $leave_accrued_trans_list->RowIndex;

		// Init row class and style
		$leave_accrued_trans->resetAttributes();
		$leave_accrued_trans->CssClass = "";
		if ($leave_accrued_trans_list->isGridAdd()) {
		} else {
			$leave_accrued_trans_list->loadRowValues($leave_accrued_trans_list->Recordset); // Load row values
		}
		$leave_accrued_trans->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$leave_accrued_trans->RowAttrs->merge(["data-rowindex" => $leave_accrued_trans_list->RowCount, "id" => "r" . $leave_accrued_trans_list->RowCount . "_leave_accrued_trans", "data-rowtype" => $leave_accrued_trans->RowType]);

		// Render row
		$leave_accrued_trans_list->renderRow();

		// Render list options
		$leave_accrued_trans_list->renderListOptions();
?>
	<tr <?php echo $leave_accrued_trans->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_accrued_trans_list->ListOptions->render("body", "left", $leave_accrued_trans_list->RowCount);
?>
	<?php if ($leave_accrued_trans_list->Year->Visible) { // Year ?>
		<td data-name="Year" <?php echo $leave_accrued_trans_list->Year->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_Year">
<span<?php echo $leave_accrued_trans_list->Year->viewAttributes() ?>><?php echo $leave_accrued_trans_list->Year->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->RunMonth->Visible) { // RunMonth ?>
		<td data-name="RunMonth" <?php echo $leave_accrued_trans_list->RunMonth->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_RunMonth">
<span<?php echo $leave_accrued_trans_list->RunMonth->viewAttributes() ?>><?php echo $leave_accrued_trans_list->RunMonth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_accrued_trans_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_EmployeeID">
<span<?php echo $leave_accrued_trans_list->EmployeeID->viewAttributes() ?>><?php echo $leave_accrued_trans_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_accrued_trans_list->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_LeaveTypeCode">
<span<?php echo $leave_accrued_trans_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_accrued_trans_list->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->LeaveAccrued->Visible) { // LeaveAccrued ?>
		<td data-name="LeaveAccrued" <?php echo $leave_accrued_trans_list->LeaveAccrued->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_LeaveAccrued">
<span<?php echo $leave_accrued_trans_list->LeaveAccrued->viewAttributes() ?>><?php echo $leave_accrued_trans_list->LeaveAccrued->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->LastAccrualDate->Visible) { // LastAccrualDate ?>
		<td data-name="LastAccrualDate" <?php echo $leave_accrued_trans_list->LastAccrualDate->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_LastAccrualDate">
<span<?php echo $leave_accrued_trans_list->LastAccrualDate->viewAttributes() ?>><?php echo $leave_accrued_trans_list->LastAccrualDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->LeaveLost->Visible) { // LeaveLost ?>
		<td data-name="LeaveLost" <?php echo $leave_accrued_trans_list->LeaveLost->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_LeaveLost">
<span<?php echo $leave_accrued_trans_list->LeaveLost->viewAttributes() ?>><?php echo $leave_accrued_trans_list->LeaveLost->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_accrued_trans_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $leave_accrued_trans_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $leave_accrued_trans_list->RowCount ?>_leave_accrued_trans_LACode">
<span<?php echo $leave_accrued_trans_list->LACode->viewAttributes() ?>><?php echo $leave_accrued_trans_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_accrued_trans_list->ListOptions->render("body", "right", $leave_accrued_trans_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$leave_accrued_trans_list->isGridAdd())
		$leave_accrued_trans_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$leave_accrued_trans->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_accrued_trans_list->Recordset)
	$leave_accrued_trans_list->Recordset->Close();
?>
<?php if (!$leave_accrued_trans_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_accrued_trans_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_accrued_trans_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_accrued_trans_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_accrued_trans_list->TotalRecords == 0 && !$leave_accrued_trans->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_accrued_trans_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_accrued_trans_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_accrued_trans_list->isExport()) { ?>
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
$leave_accrued_trans_list->terminate();
?>