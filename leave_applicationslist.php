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
$leave_applications_list = new leave_applications_list();

// Run the page
$leave_applications_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_applications_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_applications_list->isExport()) { ?>
<script>
var fleave_applicationslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_applicationslist = currentForm = new ew.Form("fleave_applicationslist", "list");
	fleave_applicationslist.formKeyCountName = '<?php echo $leave_applications_list->FormKeyCountName ?>';
	loadjs.done("fleave_applicationslist");
});
var fleave_applicationslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fleave_applicationslistsrch = currentSearchForm = new ew.Form("fleave_applicationslistsrch");

	// Dynamic selection lists
	// Filters

	fleave_applicationslistsrch.filterList = <?php echo $leave_applications_list->getFilterList() ?>;

	// Init search panel as collapsed
	fleave_applicationslistsrch.initSearchPanel = true;
	loadjs.done("fleave_applicationslistsrch");
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
<?php if (!$leave_applications_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_applications_list->TotalRecords > 0 && $leave_applications_list->ExportOptions->visible()) { ?>
<?php $leave_applications_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_applications_list->ImportOptions->visible()) { ?>
<?php $leave_applications_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_applications_list->SearchOptions->visible()) { ?>
<?php $leave_applications_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($leave_applications_list->FilterOptions->visible()) { ?>
<?php $leave_applications_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$leave_applications_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$leave_applications_list->isExport() && !$leave_applications->CurrentAction) { ?>
<form name="fleave_applicationslistsrch" id="fleave_applicationslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fleave_applicationslistsrch-search-panel" class="<?php echo $leave_applications_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="leave_applications">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $leave_applications_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($leave_applications_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($leave_applications_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $leave_applications_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($leave_applications_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($leave_applications_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($leave_applications_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($leave_applications_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $leave_applications_list->showPageHeader(); ?>
<?php
$leave_applications_list->showMessage();
?>
<?php if ($leave_applications_list->TotalRecords > 0 || $leave_applications->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_applications_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_applications">
<?php if (!$leave_applications_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_applications_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_applications_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_applications_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_applicationslist" id="fleave_applicationslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_applications">
<div id="gmp_leave_applications" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_applications_list->TotalRecords > 0 || $leave_applications_list->isGridEdit()) { ?>
<table id="tbl_leave_applicationslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_applications->RowType = ROWTYPE_HEADER;

// Render list options
$leave_applications_list->renderListOptions();

// Render list options (header, left)
$leave_applications_list->ListOptions->render("header", "left");
?>
<?php if ($leave_applications_list->LeaveApplicationID->Visible) { // LeaveApplicationID ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->LeaveApplicationID) == "") { ?>
		<th data-name="LeaveApplicationID" class="<?php echo $leave_applications_list->LeaveApplicationID->headerCellClass() ?>"><div id="elh_leave_applications_LeaveApplicationID" class="leave_applications_LeaveApplicationID"><div class="ew-table-header-caption"><?php echo $leave_applications_list->LeaveApplicationID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveApplicationID" class="<?php echo $leave_applications_list->LeaveApplicationID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->LeaveApplicationID) ?>', 1);"><div id="elh_leave_applications_LeaveApplicationID" class="leave_applications_LeaveApplicationID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->LeaveApplicationID->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->LeaveApplicationID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->LeaveApplicationID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_applications_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_applications_list->EmployeeID->headerCellClass() ?>"><div id="elh_leave_applications_EmployeeID" class="leave_applications_EmployeeID"><div class="ew-table-header-caption"><?php echo $leave_applications_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $leave_applications_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->EmployeeID) ?>', 1);"><div id="elh_leave_applications_EmployeeID" class="leave_applications_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->EmployeeID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_applications_list->StartDate->Visible) { // StartDate ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $leave_applications_list->StartDate->headerCellClass() ?>"><div id="elh_leave_applications_StartDate" class="leave_applications_StartDate"><div class="ew-table-header-caption"><?php echo $leave_applications_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $leave_applications_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->StartDate) ?>', 1);"><div id="elh_leave_applications_StartDate" class="leave_applications_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_applications_list->EndDate->Visible) { // EndDate ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $leave_applications_list->EndDate->headerCellClass() ?>"><div id="elh_leave_applications_EndDate" class="leave_applications_EndDate"><div class="ew-table-header-caption"><?php echo $leave_applications_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $leave_applications_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->EndDate) ?>', 1);"><div id="elh_leave_applications_EndDate" class="leave_applications_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_applications_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_applications_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_applications_LeaveTypeCode" class="leave_applications_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_applications_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_applications_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_applications_LeaveTypeCode" class="leave_applications_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->LeaveTypeCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_applications_list->Location->Visible) { // Location ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $leave_applications_list->Location->headerCellClass() ?>"><div id="elh_leave_applications_Location" class="leave_applications_Location"><div class="ew-table-header-caption"><?php echo $leave_applications_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $leave_applications_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->Location) ?>', 1);"><div id="elh_leave_applications_Location" class="leave_applications_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_applications_list->Status->Visible) { // Status ?>
	<?php if ($leave_applications_list->SortUrl($leave_applications_list->Status) == "") { ?>
		<th data-name="Status" class="<?php echo $leave_applications_list->Status->headerCellClass() ?>"><div id="elh_leave_applications_Status" class="leave_applications_Status"><div class="ew-table-header-caption"><?php echo $leave_applications_list->Status->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Status" class="<?php echo $leave_applications_list->Status->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_applications_list->SortUrl($leave_applications_list->Status) ?>', 1);"><div id="elh_leave_applications_Status" class="leave_applications_Status">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_applications_list->Status->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_applications_list->Status->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_applications_list->Status->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_applications_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_applications_list->ExportAll && $leave_applications_list->isExport()) {
	$leave_applications_list->StopRecord = $leave_applications_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_applications_list->TotalRecords > $leave_applications_list->StartRecord + $leave_applications_list->DisplayRecords - 1)
		$leave_applications_list->StopRecord = $leave_applications_list->StartRecord + $leave_applications_list->DisplayRecords - 1;
	else
		$leave_applications_list->StopRecord = $leave_applications_list->TotalRecords;
}
$leave_applications_list->RecordCount = $leave_applications_list->StartRecord - 1;
if ($leave_applications_list->Recordset && !$leave_applications_list->Recordset->EOF) {
	$leave_applications_list->Recordset->moveFirst();
	$selectLimit = $leave_applications_list->UseSelectLimit;
	if (!$selectLimit && $leave_applications_list->StartRecord > 1)
		$leave_applications_list->Recordset->move($leave_applications_list->StartRecord - 1);
} elseif (!$leave_applications->AllowAddDeleteRow && $leave_applications_list->StopRecord == 0) {
	$leave_applications_list->StopRecord = $leave_applications->GridAddRowCount;
}

// Initialize aggregate
$leave_applications->RowType = ROWTYPE_AGGREGATEINIT;
$leave_applications->resetAttributes();
$leave_applications_list->renderRow();
while ($leave_applications_list->RecordCount < $leave_applications_list->StopRecord) {
	$leave_applications_list->RecordCount++;
	if ($leave_applications_list->RecordCount >= $leave_applications_list->StartRecord) {
		$leave_applications_list->RowCount++;

		// Set up key count
		$leave_applications_list->KeyCount = $leave_applications_list->RowIndex;

		// Init row class and style
		$leave_applications->resetAttributes();
		$leave_applications->CssClass = "";
		if ($leave_applications_list->isGridAdd()) {
		} else {
			$leave_applications_list->loadRowValues($leave_applications_list->Recordset); // Load row values
		}
		$leave_applications->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$leave_applications->RowAttrs->merge(["data-rowindex" => $leave_applications_list->RowCount, "id" => "r" . $leave_applications_list->RowCount . "_leave_applications", "data-rowtype" => $leave_applications->RowType]);

		// Render row
		$leave_applications_list->renderRow();

		// Render list options
		$leave_applications_list->renderListOptions();
?>
	<tr <?php echo $leave_applications->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_applications_list->ListOptions->render("body", "left", $leave_applications_list->RowCount);
?>
	<?php if ($leave_applications_list->LeaveApplicationID->Visible) { // LeaveApplicationID ?>
		<td data-name="LeaveApplicationID" <?php echo $leave_applications_list->LeaveApplicationID->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_LeaveApplicationID">
<span<?php echo $leave_applications_list->LeaveApplicationID->viewAttributes() ?>><?php echo $leave_applications_list->LeaveApplicationID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_applications_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $leave_applications_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_EmployeeID">
<span<?php echo $leave_applications_list->EmployeeID->viewAttributes() ?>><?php echo $leave_applications_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_applications_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $leave_applications_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_StartDate">
<span<?php echo $leave_applications_list->StartDate->viewAttributes() ?>><?php echo $leave_applications_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_applications_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $leave_applications_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_EndDate">
<span<?php echo $leave_applications_list->EndDate->viewAttributes() ?>><?php echo $leave_applications_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_applications_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_applications_list->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_LeaveTypeCode">
<span<?php echo $leave_applications_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_applications_list->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_applications_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $leave_applications_list->Location->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_Location">
<span<?php echo $leave_applications_list->Location->viewAttributes() ?>><?php echo $leave_applications_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_applications_list->Status->Visible) { // Status ?>
		<td data-name="Status" <?php echo $leave_applications_list->Status->cellAttributes() ?>>
<span id="el<?php echo $leave_applications_list->RowCount ?>_leave_applications_Status">
<span<?php echo $leave_applications_list->Status->viewAttributes() ?>><?php echo $leave_applications_list->Status->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_applications_list->ListOptions->render("body", "right", $leave_applications_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$leave_applications_list->isGridAdd())
		$leave_applications_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$leave_applications->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_applications_list->Recordset)
	$leave_applications_list->Recordset->Close();
?>
<?php if (!$leave_applications_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_applications_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_applications_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_applications_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_applications_list->TotalRecords == 0 && !$leave_applications->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_applications_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_applications_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_applications_list->isExport()) { ?>
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
$leave_applications_list->terminate();
?>