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
$leave_booked_list = new leave_booked_list();

// Run the page
$leave_booked_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_booked_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_booked_list->isExport()) { ?>
<script>
var fleave_bookedlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_bookedlist = currentForm = new ew.Form("fleave_bookedlist", "list");
	fleave_bookedlist.formKeyCountName = '<?php echo $leave_booked_list->FormKeyCountName ?>';
	loadjs.done("fleave_bookedlist");
});
var fleave_bookedlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fleave_bookedlistsrch = currentSearchForm = new ew.Form("fleave_bookedlistsrch");

	// Dynamic selection lists
	// Filters

	fleave_bookedlistsrch.filterList = <?php echo $leave_booked_list->getFilterList() ?>;

	// Init search panel as collapsed
	fleave_bookedlistsrch.initSearchPanel = true;
	loadjs.done("fleave_bookedlistsrch");
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
<?php if (!$leave_booked_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_booked_list->TotalRecords > 0 && $leave_booked_list->ExportOptions->visible()) { ?>
<?php $leave_booked_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_booked_list->ImportOptions->visible()) { ?>
<?php $leave_booked_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_booked_list->SearchOptions->visible()) { ?>
<?php $leave_booked_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($leave_booked_list->FilterOptions->visible()) { ?>
<?php $leave_booked_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$leave_booked_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$leave_booked_list->isExport() && !$leave_booked->CurrentAction) { ?>
<form name="fleave_bookedlistsrch" id="fleave_bookedlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fleave_bookedlistsrch-search-panel" class="<?php echo $leave_booked_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="leave_booked">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $leave_booked_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($leave_booked_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($leave_booked_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $leave_booked_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($leave_booked_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($leave_booked_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($leave_booked_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($leave_booked_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $leave_booked_list->showPageHeader(); ?>
<?php
$leave_booked_list->showMessage();
?>
<?php if ($leave_booked_list->TotalRecords > 0 || $leave_booked->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_booked_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_booked">
<?php if (!$leave_booked_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_booked_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_booked_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_booked_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_bookedlist" id="fleave_bookedlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_booked">
<div id="gmp_leave_booked" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_booked_list->TotalRecords > 0 || $leave_booked_list->isGridEdit()) { ?>
<table id="tbl_leave_bookedlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_booked->RowType = ROWTYPE_HEADER;

// Render list options
$leave_booked_list->renderListOptions();

// Render list options (header, left)
$leave_booked_list->ListOptions->render("header", "left");
?>
<?php if ($leave_booked_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_booked_list->SortUrl($leave_booked_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_booked_list->EmployeeID->headerCellClass() ?>"><div id="elh_leave_booked_EmployeeID" class="leave_booked_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_booked_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_booked_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_booked_list->SortUrl($leave_booked_list->EmployeeID) ?>', 1);"><div id="elh_leave_booked_EmployeeID" class="leave_booked_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_booked_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_booked_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_booked_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_booked_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_booked_list->SortUrl($leave_booked_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_booked_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_booked_LeaveTypeCode" class="leave_booked_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_booked_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_booked_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_booked_list->SortUrl($leave_booked_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_booked_LeaveTypeCode" class="leave_booked_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_booked_list->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_booked_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_booked_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_booked_list->StartDate->Visible) { // StartDate ?>
	<?php if ($leave_booked_list->SortUrl($leave_booked_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $leave_booked_list->StartDate->headerCellClass() ?>"><div id="elh_leave_booked_StartDate" class="leave_booked_StartDate"><div class="ew-table-header-caption"><?php echo $leave_booked_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $leave_booked_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_booked_list->SortUrl($leave_booked_list->StartDate) ?>', 1);"><div id="elh_leave_booked_StartDate" class="leave_booked_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_booked_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_booked_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_booked_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_booked_list->EndDate->Visible) { // EndDate ?>
	<?php if ($leave_booked_list->SortUrl($leave_booked_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $leave_booked_list->EndDate->headerCellClass() ?>"><div id="elh_leave_booked_EndDate" class="leave_booked_EndDate"><div class="ew-table-header-caption"><?php echo $leave_booked_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $leave_booked_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_booked_list->SortUrl($leave_booked_list->EndDate) ?>', 1);"><div id="elh_leave_booked_EndDate" class="leave_booked_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_booked_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_booked_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_booked_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_booked_list->Location->Visible) { // Location ?>
	<?php if ($leave_booked_list->SortUrl($leave_booked_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $leave_booked_list->Location->headerCellClass() ?>"><div id="elh_leave_booked_Location" class="leave_booked_Location"><div class="ew-table-header-caption"><?php echo $leave_booked_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $leave_booked_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_booked_list->SortUrl($leave_booked_list->Location) ?>', 1);"><div id="elh_leave_booked_Location" class="leave_booked_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_booked_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_booked_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_booked_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_booked_list->Remarks->Visible) { // Remarks ?>
	<?php if ($leave_booked_list->SortUrl($leave_booked_list->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $leave_booked_list->Remarks->headerCellClass() ?>"><div id="elh_leave_booked_Remarks" class="leave_booked_Remarks"><div class="ew-table-header-caption"><?php echo $leave_booked_list->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $leave_booked_list->Remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_booked_list->SortUrl($leave_booked_list->Remarks) ?>', 1);"><div id="elh_leave_booked_Remarks" class="leave_booked_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_booked_list->Remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_booked_list->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_booked_list->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_booked_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_booked_list->ExportAll && $leave_booked_list->isExport()) {
	$leave_booked_list->StopRecord = $leave_booked_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_booked_list->TotalRecords > $leave_booked_list->StartRecord + $leave_booked_list->DisplayRecords - 1)
		$leave_booked_list->StopRecord = $leave_booked_list->StartRecord + $leave_booked_list->DisplayRecords - 1;
	else
		$leave_booked_list->StopRecord = $leave_booked_list->TotalRecords;
}
$leave_booked_list->RecordCount = $leave_booked_list->StartRecord - 1;
if ($leave_booked_list->Recordset && !$leave_booked_list->Recordset->EOF) {
	$leave_booked_list->Recordset->moveFirst();
	$selectLimit = $leave_booked_list->UseSelectLimit;
	if (!$selectLimit && $leave_booked_list->StartRecord > 1)
		$leave_booked_list->Recordset->move($leave_booked_list->StartRecord - 1);
} elseif (!$leave_booked->AllowAddDeleteRow && $leave_booked_list->StopRecord == 0) {
	$leave_booked_list->StopRecord = $leave_booked->GridAddRowCount;
}

// Initialize aggregate
$leave_booked->RowType = ROWTYPE_AGGREGATEINIT;
$leave_booked->resetAttributes();
$leave_booked_list->renderRow();
while ($leave_booked_list->RecordCount < $leave_booked_list->StopRecord) {
	$leave_booked_list->RecordCount++;
	if ($leave_booked_list->RecordCount >= $leave_booked_list->StartRecord) {
		$leave_booked_list->RowCount++;

		// Set up key count
		$leave_booked_list->KeyCount = $leave_booked_list->RowIndex;

		// Init row class and style
		$leave_booked->resetAttributes();
		$leave_booked->CssClass = "";
		if ($leave_booked_list->isGridAdd()) {
		} else {
			$leave_booked_list->loadRowValues($leave_booked_list->Recordset); // Load row values
		}
		$leave_booked->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$leave_booked->RowAttrs->merge(["data-rowindex" => $leave_booked_list->RowCount, "id" => "r" . $leave_booked_list->RowCount . "_leave_booked", "data-rowtype" => $leave_booked->RowType]);

		// Render row
		$leave_booked_list->renderRow();

		// Render list options
		$leave_booked_list->renderListOptions();
?>
	<tr <?php echo $leave_booked->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_booked_list->ListOptions->render("body", "left", $leave_booked_list->RowCount);
?>
	<?php if ($leave_booked_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_booked_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_list->RowCount ?>_leave_booked_EmployeeID">
<span<?php echo $leave_booked_list->EmployeeID->viewAttributes() ?>><?php echo $leave_booked_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_booked_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_booked_list->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_list->RowCount ?>_leave_booked_LeaveTypeCode">
<span<?php echo $leave_booked_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_booked_list->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_booked_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $leave_booked_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_list->RowCount ?>_leave_booked_StartDate">
<span<?php echo $leave_booked_list->StartDate->viewAttributes() ?>><?php echo $leave_booked_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_booked_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $leave_booked_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_list->RowCount ?>_leave_booked_EndDate">
<span<?php echo $leave_booked_list->EndDate->viewAttributes() ?>><?php echo $leave_booked_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_booked_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $leave_booked_list->Location->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_list->RowCount ?>_leave_booked_Location">
<span<?php echo $leave_booked_list->Location->viewAttributes() ?>><?php echo $leave_booked_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_booked_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $leave_booked_list->Remarks->cellAttributes() ?>>
<span id="el<?php echo $leave_booked_list->RowCount ?>_leave_booked_Remarks">
<span<?php echo $leave_booked_list->Remarks->viewAttributes() ?>><?php echo $leave_booked_list->Remarks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_booked_list->ListOptions->render("body", "right", $leave_booked_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$leave_booked_list->isGridAdd())
		$leave_booked_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$leave_booked->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_booked_list->Recordset)
	$leave_booked_list->Recordset->Close();
?>
<?php if (!$leave_booked_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_booked_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_booked_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_booked_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_booked_list->TotalRecords == 0 && !$leave_booked->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_booked_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_booked_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_booked_list->isExport()) { ?>
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
$leave_booked_list->terminate();
?>