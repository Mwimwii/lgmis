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
$council_meeting_list = new council_meeting_list();

// Run the page
$council_meeting_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_meeting_list->isExport()) { ?>
<script>
var fcouncil_meetinglist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncil_meetinglist = currentForm = new ew.Form("fcouncil_meetinglist", "list");
	fcouncil_meetinglist.formKeyCountName = '<?php echo $council_meeting_list->FormKeyCountName ?>';
	loadjs.done("fcouncil_meetinglist");
});
var fcouncil_meetinglistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncil_meetinglistsrch = currentSearchForm = new ew.Form("fcouncil_meetinglistsrch");

	// Dynamic selection lists
	// Filters

	fcouncil_meetinglistsrch.filterList = <?php echo $council_meeting_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncil_meetinglistsrch.initSearchPanel = true;
	loadjs.done("fcouncil_meetinglistsrch");
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
<?php if (!$council_meeting_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($council_meeting_list->TotalRecords > 0 && $council_meeting_list->ExportOptions->visible()) { ?>
<?php $council_meeting_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($council_meeting_list->ImportOptions->visible()) { ?>
<?php $council_meeting_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($council_meeting_list->SearchOptions->visible()) { ?>
<?php $council_meeting_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($council_meeting_list->FilterOptions->visible()) { ?>
<?php $council_meeting_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$council_meeting_list->isExport() || Config("EXPORT_MASTER_RECORD") && $council_meeting_list->isExport("print")) { ?>
<?php
if ($council_meeting_list->DbMasterFilter != "" && $council_meeting->getCurrentMasterTable() == "local_authority") {
	if ($council_meeting_list->MasterRecordExists) {
		include_once "local_authoritymaster.php";
	}
}
?>
<?php } ?>
<?php
$council_meeting_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$council_meeting_list->isExport() && !$council_meeting->CurrentAction) { ?>
<form name="fcouncil_meetinglistsrch" id="fcouncil_meetinglistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncil_meetinglistsrch-search-panel" class="<?php echo $council_meeting_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="council_meeting">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $council_meeting_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($council_meeting_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($council_meeting_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $council_meeting_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($council_meeting_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($council_meeting_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($council_meeting_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($council_meeting_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $council_meeting_list->showPageHeader(); ?>
<?php
$council_meeting_list->showMessage();
?>
<?php if ($council_meeting_list->TotalRecords > 0 || $council_meeting->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($council_meeting_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> council_meeting">
<?php if (!$council_meeting_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$council_meeting_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $council_meeting_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncil_meetinglist" id="fcouncil_meetinglist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting">
<?php if ($council_meeting->getCurrentMasterTable() == "local_authority" && $council_meeting->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="local_authority">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($council_meeting_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_council_meeting" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($council_meeting_list->TotalRecords > 0 || $council_meeting_list->isGridEdit()) { ?>
<table id="tbl_council_meetinglist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$council_meeting->RowType = ROWTYPE_HEADER;

// Render list options
$council_meeting_list->renderListOptions();

// Render list options (header, left)
$council_meeting_list->ListOptions->render("header", "left");
?>
<?php if ($council_meeting_list->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->MeetingNo) == "") { ?>
		<th data-name="MeetingNo" class="<?php echo $council_meeting_list->MeetingNo->headerCellClass() ?>"><div id="elh_council_meeting_MeetingNo" class="council_meeting_MeetingNo"><div class="ew-table-header-caption"><?php echo $council_meeting_list->MeetingNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingNo" class="<?php echo $council_meeting_list->MeetingNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->MeetingNo) ?>', 1);"><div id="elh_council_meeting_MeetingNo" class="council_meeting_MeetingNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->MeetingNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->MeetingNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->MeetingRef->Visible) { // MeetingRef ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->MeetingRef) == "") { ?>
		<th data-name="MeetingRef" class="<?php echo $council_meeting_list->MeetingRef->headerCellClass() ?>"><div id="elh_council_meeting_MeetingRef" class="council_meeting_MeetingRef"><div class="ew-table-header-caption"><?php echo $council_meeting_list->MeetingRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingRef" class="<?php echo $council_meeting_list->MeetingRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->MeetingRef) ?>', 1);"><div id="elh_council_meeting_MeetingRef" class="council_meeting_MeetingRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->MeetingRef->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->MeetingRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->MeetingRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->MeetingType->Visible) { // MeetingType ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->MeetingType) == "") { ?>
		<th data-name="MeetingType" class="<?php echo $council_meeting_list->MeetingType->headerCellClass() ?>"><div id="elh_council_meeting_MeetingType" class="council_meeting_MeetingType"><div class="ew-table-header-caption"><?php echo $council_meeting_list->MeetingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingType" class="<?php echo $council_meeting_list->MeetingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->MeetingType) ?>', 1);"><div id="elh_council_meeting_MeetingType" class="council_meeting_MeetingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->MeetingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->MeetingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->MeetingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->LACode->Visible) { // LACode ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $council_meeting_list->LACode->headerCellClass() ?>"><div id="elh_council_meeting_LACode" class="council_meeting_LACode"><div class="ew-table-header-caption"><?php echo $council_meeting_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $council_meeting_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->LACode) ?>', 1);"><div id="elh_council_meeting_LACode" class="council_meeting_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->PlannedDate->Visible) { // PlannedDate ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->PlannedDate) == "") { ?>
		<th data-name="PlannedDate" class="<?php echo $council_meeting_list->PlannedDate->headerCellClass() ?>"><div id="elh_council_meeting_PlannedDate" class="council_meeting_PlannedDate"><div class="ew-table-header-caption"><?php echo $council_meeting_list->PlannedDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedDate" class="<?php echo $council_meeting_list->PlannedDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->PlannedDate) ?>', 1);"><div id="elh_council_meeting_PlannedDate" class="council_meeting_PlannedDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->PlannedDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->PlannedDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->PlannedDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->ActualDate->Visible) { // ActualDate ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->ActualDate) == "") { ?>
		<th data-name="ActualDate" class="<?php echo $council_meeting_list->ActualDate->headerCellClass() ?>"><div id="elh_council_meeting_ActualDate" class="council_meeting_ActualDate"><div class="ew-table-header-caption"><?php echo $council_meeting_list->ActualDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualDate" class="<?php echo $council_meeting_list->ActualDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->ActualDate) ?>', 1);"><div id="elh_council_meeting_ActualDate" class="council_meeting_ActualDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->ActualDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->ActualDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->ActualDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->Attendance->Visible) { // Attendance ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->Attendance) == "") { ?>
		<th data-name="Attendance" class="<?php echo $council_meeting_list->Attendance->headerCellClass() ?>"><div id="elh_council_meeting_Attendance" class="council_meeting_Attendance"><div class="ew-table-header-caption"><?php echo $council_meeting_list->Attendance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Attendance" class="<?php echo $council_meeting_list->Attendance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->Attendance) ?>', 1);"><div id="elh_council_meeting_Attendance" class="council_meeting_Attendance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->Attendance->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->Attendance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->Attendance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_list->ChairedBy->Visible) { // ChairedBy ?>
	<?php if ($council_meeting_list->SortUrl($council_meeting_list->ChairedBy) == "") { ?>
		<th data-name="ChairedBy" class="<?php echo $council_meeting_list->ChairedBy->headerCellClass() ?>"><div id="elh_council_meeting_ChairedBy" class="council_meeting_ChairedBy"><div class="ew-table-header-caption"><?php echo $council_meeting_list->ChairedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChairedBy" class="<?php echo $council_meeting_list->ChairedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_list->SortUrl($council_meeting_list->ChairedBy) ?>', 1);"><div id="elh_council_meeting_ChairedBy" class="council_meeting_ChairedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_list->ChairedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_list->ChairedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_list->ChairedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_meeting_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($council_meeting_list->ExportAll && $council_meeting_list->isExport()) {
	$council_meeting_list->StopRecord = $council_meeting_list->TotalRecords;
} else {

	// Set the last record to display
	if ($council_meeting_list->TotalRecords > $council_meeting_list->StartRecord + $council_meeting_list->DisplayRecords - 1)
		$council_meeting_list->StopRecord = $council_meeting_list->StartRecord + $council_meeting_list->DisplayRecords - 1;
	else
		$council_meeting_list->StopRecord = $council_meeting_list->TotalRecords;
}
$council_meeting_list->RecordCount = $council_meeting_list->StartRecord - 1;
if ($council_meeting_list->Recordset && !$council_meeting_list->Recordset->EOF) {
	$council_meeting_list->Recordset->moveFirst();
	$selectLimit = $council_meeting_list->UseSelectLimit;
	if (!$selectLimit && $council_meeting_list->StartRecord > 1)
		$council_meeting_list->Recordset->move($council_meeting_list->StartRecord - 1);
} elseif (!$council_meeting->AllowAddDeleteRow && $council_meeting_list->StopRecord == 0) {
	$council_meeting_list->StopRecord = $council_meeting->GridAddRowCount;
}

// Initialize aggregate
$council_meeting->RowType = ROWTYPE_AGGREGATEINIT;
$council_meeting->resetAttributes();
$council_meeting_list->renderRow();
while ($council_meeting_list->RecordCount < $council_meeting_list->StopRecord) {
	$council_meeting_list->RecordCount++;
	if ($council_meeting_list->RecordCount >= $council_meeting_list->StartRecord) {
		$council_meeting_list->RowCount++;

		// Set up key count
		$council_meeting_list->KeyCount = $council_meeting_list->RowIndex;

		// Init row class and style
		$council_meeting->resetAttributes();
		$council_meeting->CssClass = "";
		if ($council_meeting_list->isGridAdd()) {
		} else {
			$council_meeting_list->loadRowValues($council_meeting_list->Recordset); // Load row values
		}
		$council_meeting->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$council_meeting->RowAttrs->merge(["data-rowindex" => $council_meeting_list->RowCount, "id" => "r" . $council_meeting_list->RowCount . "_council_meeting", "data-rowtype" => $council_meeting->RowType]);

		// Render row
		$council_meeting_list->renderRow();

		// Render list options
		$council_meeting_list->renderListOptions();
?>
	<tr <?php echo $council_meeting->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_meeting_list->ListOptions->render("body", "left", $council_meeting_list->RowCount);
?>
	<?php if ($council_meeting_list->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo" <?php echo $council_meeting_list->MeetingNo->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_MeetingNo">
<span<?php echo $council_meeting_list->MeetingNo->viewAttributes() ?>><?php echo $council_meeting_list->MeetingNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->MeetingRef->Visible) { // MeetingRef ?>
		<td data-name="MeetingRef" <?php echo $council_meeting_list->MeetingRef->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_MeetingRef">
<span<?php echo $council_meeting_list->MeetingRef->viewAttributes() ?>><?php echo $council_meeting_list->MeetingRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->MeetingType->Visible) { // MeetingType ?>
		<td data-name="MeetingType" <?php echo $council_meeting_list->MeetingType->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_MeetingType">
<span<?php echo $council_meeting_list->MeetingType->viewAttributes() ?>><?php echo $council_meeting_list->MeetingType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $council_meeting_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_LACode">
<span<?php echo $council_meeting_list->LACode->viewAttributes() ?>><?php echo $council_meeting_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->PlannedDate->Visible) { // PlannedDate ?>
		<td data-name="PlannedDate" <?php echo $council_meeting_list->PlannedDate->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_PlannedDate">
<span<?php echo $council_meeting_list->PlannedDate->viewAttributes() ?>><?php echo $council_meeting_list->PlannedDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->ActualDate->Visible) { // ActualDate ?>
		<td data-name="ActualDate" <?php echo $council_meeting_list->ActualDate->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_ActualDate">
<span<?php echo $council_meeting_list->ActualDate->viewAttributes() ?>><?php echo $council_meeting_list->ActualDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->Attendance->Visible) { // Attendance ?>
		<td data-name="Attendance" <?php echo $council_meeting_list->Attendance->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_Attendance">
<span<?php echo $council_meeting_list->Attendance->viewAttributes() ?>><?php echo $council_meeting_list->Attendance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_list->ChairedBy->Visible) { // ChairedBy ?>
		<td data-name="ChairedBy" <?php echo $council_meeting_list->ChairedBy->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_list->RowCount ?>_council_meeting_ChairedBy">
<span<?php echo $council_meeting_list->ChairedBy->viewAttributes() ?>><?php echo $council_meeting_list->ChairedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_meeting_list->ListOptions->render("body", "right", $council_meeting_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$council_meeting_list->isGridAdd())
		$council_meeting_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$council_meeting->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($council_meeting_list->Recordset)
	$council_meeting_list->Recordset->Close();
?>
<?php if (!$council_meeting_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$council_meeting_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $council_meeting_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($council_meeting_list->TotalRecords == 0 && !$council_meeting->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $council_meeting_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$council_meeting_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_meeting_list->isExport()) { ?>
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
$council_meeting_list->terminate();
?>