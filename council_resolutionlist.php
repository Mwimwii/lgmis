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
$council_resolution_list = new council_resolution_list();

// Run the page
$council_resolution_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_resolution_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_resolution_list->isExport()) { ?>
<script>
var fcouncil_resolutionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncil_resolutionlist = currentForm = new ew.Form("fcouncil_resolutionlist", "list");
	fcouncil_resolutionlist.formKeyCountName = '<?php echo $council_resolution_list->FormKeyCountName ?>';
	loadjs.done("fcouncil_resolutionlist");
});
var fcouncil_resolutionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncil_resolutionlistsrch = currentSearchForm = new ew.Form("fcouncil_resolutionlistsrch");

	// Dynamic selection lists
	// Filters

	fcouncil_resolutionlistsrch.filterList = <?php echo $council_resolution_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncil_resolutionlistsrch.initSearchPanel = true;
	loadjs.done("fcouncil_resolutionlistsrch");
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
<?php if (!$council_resolution_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($council_resolution_list->TotalRecords > 0 && $council_resolution_list->ExportOptions->visible()) { ?>
<?php $council_resolution_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($council_resolution_list->ImportOptions->visible()) { ?>
<?php $council_resolution_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($council_resolution_list->SearchOptions->visible()) { ?>
<?php $council_resolution_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($council_resolution_list->FilterOptions->visible()) { ?>
<?php $council_resolution_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$council_resolution_list->isExport() || Config("EXPORT_MASTER_RECORD") && $council_resolution_list->isExport("print")) { ?>
<?php
if ($council_resolution_list->DbMasterFilter != "" && $council_resolution->getCurrentMasterTable() == "council_meeting") {
	if ($council_resolution_list->MasterRecordExists) {
		include_once "council_meetingmaster.php";
	}
}
?>
<?php } ?>
<?php
$council_resolution_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$council_resolution_list->isExport() && !$council_resolution->CurrentAction) { ?>
<form name="fcouncil_resolutionlistsrch" id="fcouncil_resolutionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncil_resolutionlistsrch-search-panel" class="<?php echo $council_resolution_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="council_resolution">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $council_resolution_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($council_resolution_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($council_resolution_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $council_resolution_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($council_resolution_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($council_resolution_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($council_resolution_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($council_resolution_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $council_resolution_list->showPageHeader(); ?>
<?php
$council_resolution_list->showMessage();
?>
<?php if ($council_resolution_list->TotalRecords > 0 || $council_resolution->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($council_resolution_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> council_resolution">
<?php if (!$council_resolution_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$council_resolution_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_resolution_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $council_resolution_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncil_resolutionlist" id="fcouncil_resolutionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_resolution">
<?php if ($council_resolution->getCurrentMasterTable() == "council_meeting" && $council_resolution->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="council_meeting">
<input type="hidden" name="fk_MeetingNo" value="<?php echo HtmlEncode($council_resolution_list->MeetingNo->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($council_resolution_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_council_resolution" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($council_resolution_list->TotalRecords > 0 || $council_resolution_list->isGridEdit()) { ?>
<table id="tbl_council_resolutionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$council_resolution->RowType = ROWTYPE_HEADER;

// Render list options
$council_resolution_list->renderListOptions();

// Render list options (header, left)
$council_resolution_list->ListOptions->render("header", "left");
?>
<?php if ($council_resolution_list->MeetingNo->Visible) { // MeetingNo ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->MeetingNo) == "") { ?>
		<th data-name="MeetingNo" class="<?php echo $council_resolution_list->MeetingNo->headerCellClass() ?>"><div id="elh_council_resolution_MeetingNo" class="council_resolution_MeetingNo"><div class="ew-table-header-caption"><?php echo $council_resolution_list->MeetingNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingNo" class="<?php echo $council_resolution_list->MeetingNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->MeetingNo) ?>', 1);"><div id="elh_council_resolution_MeetingNo" class="council_resolution_MeetingNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->MeetingNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->MeetingNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->MeetingNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_list->MinuteNumber->Visible) { // MinuteNumber ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->MinuteNumber) == "") { ?>
		<th data-name="MinuteNumber" class="<?php echo $council_resolution_list->MinuteNumber->headerCellClass() ?>"><div id="elh_council_resolution_MinuteNumber" class="council_resolution_MinuteNumber"><div class="ew-table-header-caption"><?php echo $council_resolution_list->MinuteNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MinuteNumber" class="<?php echo $council_resolution_list->MinuteNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->MinuteNumber) ?>', 1);"><div id="elh_council_resolution_MinuteNumber" class="council_resolution_MinuteNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->MinuteNumber->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->MinuteNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->MinuteNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_list->Resolutionccategory->Visible) { // Resolutionccategory ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->Resolutionccategory) == "") { ?>
		<th data-name="Resolutionccategory" class="<?php echo $council_resolution_list->Resolutionccategory->headerCellClass() ?>"><div id="elh_council_resolution_Resolutionccategory" class="council_resolution_Resolutionccategory"><div class="ew-table-header-caption"><?php echo $council_resolution_list->Resolutionccategory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Resolutionccategory" class="<?php echo $council_resolution_list->Resolutionccategory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->Resolutionccategory) ?>', 1);"><div id="elh_council_resolution_Resolutionccategory" class="council_resolution_Resolutionccategory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->Resolutionccategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->Resolutionccategory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->Resolutionccategory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_list->LACode->Visible) { // LACode ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $council_resolution_list->LACode->headerCellClass() ?>"><div id="elh_council_resolution_LACode" class="council_resolution_LACode"><div class="ew-table-header-caption"><?php echo $council_resolution_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $council_resolution_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->LACode) ?>', 1);"><div id="elh_council_resolution_LACode" class="council_resolution_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_list->ResolutionNo->Visible) { // ResolutionNo ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->ResolutionNo) == "") { ?>
		<th data-name="ResolutionNo" class="<?php echo $council_resolution_list->ResolutionNo->headerCellClass() ?>"><div id="elh_council_resolution_ResolutionNo" class="council_resolution_ResolutionNo"><div class="ew-table-header-caption"><?php echo $council_resolution_list->ResolutionNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ResolutionNo" class="<?php echo $council_resolution_list->ResolutionNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->ResolutionNo) ?>', 1);"><div id="elh_council_resolution_ResolutionNo" class="council_resolution_ResolutionNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->ResolutionNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->ResolutionNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->ResolutionNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_list->Responsibility->Visible) { // Responsibility ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->Responsibility) == "") { ?>
		<th data-name="Responsibility" class="<?php echo $council_resolution_list->Responsibility->headerCellClass() ?>"><div id="elh_council_resolution_Responsibility" class="council_resolution_Responsibility"><div class="ew-table-header-caption"><?php echo $council_resolution_list->Responsibility->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Responsibility" class="<?php echo $council_resolution_list->Responsibility->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->Responsibility) ?>', 1);"><div id="elh_council_resolution_Responsibility" class="council_resolution_Responsibility">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->Responsibility->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->Responsibility->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->Responsibility->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_resolution_list->ActionDate->Visible) { // ActionDate ?>
	<?php if ($council_resolution_list->SortUrl($council_resolution_list->ActionDate) == "") { ?>
		<th data-name="ActionDate" class="<?php echo $council_resolution_list->ActionDate->headerCellClass() ?>"><div id="elh_council_resolution_ActionDate" class="council_resolution_ActionDate"><div class="ew-table-header-caption"><?php echo $council_resolution_list->ActionDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionDate" class="<?php echo $council_resolution_list->ActionDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_resolution_list->SortUrl($council_resolution_list->ActionDate) ?>', 1);"><div id="elh_council_resolution_ActionDate" class="council_resolution_ActionDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_resolution_list->ActionDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_resolution_list->ActionDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_resolution_list->ActionDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_resolution_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($council_resolution_list->ExportAll && $council_resolution_list->isExport()) {
	$council_resolution_list->StopRecord = $council_resolution_list->TotalRecords;
} else {

	// Set the last record to display
	if ($council_resolution_list->TotalRecords > $council_resolution_list->StartRecord + $council_resolution_list->DisplayRecords - 1)
		$council_resolution_list->StopRecord = $council_resolution_list->StartRecord + $council_resolution_list->DisplayRecords - 1;
	else
		$council_resolution_list->StopRecord = $council_resolution_list->TotalRecords;
}
$council_resolution_list->RecordCount = $council_resolution_list->StartRecord - 1;
if ($council_resolution_list->Recordset && !$council_resolution_list->Recordset->EOF) {
	$council_resolution_list->Recordset->moveFirst();
	$selectLimit = $council_resolution_list->UseSelectLimit;
	if (!$selectLimit && $council_resolution_list->StartRecord > 1)
		$council_resolution_list->Recordset->move($council_resolution_list->StartRecord - 1);
} elseif (!$council_resolution->AllowAddDeleteRow && $council_resolution_list->StopRecord == 0) {
	$council_resolution_list->StopRecord = $council_resolution->GridAddRowCount;
}

// Initialize aggregate
$council_resolution->RowType = ROWTYPE_AGGREGATEINIT;
$council_resolution->resetAttributes();
$council_resolution_list->renderRow();
while ($council_resolution_list->RecordCount < $council_resolution_list->StopRecord) {
	$council_resolution_list->RecordCount++;
	if ($council_resolution_list->RecordCount >= $council_resolution_list->StartRecord) {
		$council_resolution_list->RowCount++;

		// Set up key count
		$council_resolution_list->KeyCount = $council_resolution_list->RowIndex;

		// Init row class and style
		$council_resolution->resetAttributes();
		$council_resolution->CssClass = "";
		if ($council_resolution_list->isGridAdd()) {
		} else {
			$council_resolution_list->loadRowValues($council_resolution_list->Recordset); // Load row values
		}
		$council_resolution->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$council_resolution->RowAttrs->merge(["data-rowindex" => $council_resolution_list->RowCount, "id" => "r" . $council_resolution_list->RowCount . "_council_resolution", "data-rowtype" => $council_resolution->RowType]);

		// Render row
		$council_resolution_list->renderRow();

		// Render list options
		$council_resolution_list->renderListOptions();
?>
	<tr <?php echo $council_resolution->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_resolution_list->ListOptions->render("body", "left", $council_resolution_list->RowCount);
?>
	<?php if ($council_resolution_list->MeetingNo->Visible) { // MeetingNo ?>
		<td data-name="MeetingNo" <?php echo $council_resolution_list->MeetingNo->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_MeetingNo">
<span<?php echo $council_resolution_list->MeetingNo->viewAttributes() ?>><?php echo $council_resolution_list->MeetingNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_resolution_list->MinuteNumber->Visible) { // MinuteNumber ?>
		<td data-name="MinuteNumber" <?php echo $council_resolution_list->MinuteNumber->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_MinuteNumber">
<span<?php echo $council_resolution_list->MinuteNumber->viewAttributes() ?>><?php echo $council_resolution_list->MinuteNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_resolution_list->Resolutionccategory->Visible) { // Resolutionccategory ?>
		<td data-name="Resolutionccategory" <?php echo $council_resolution_list->Resolutionccategory->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_Resolutionccategory">
<span<?php echo $council_resolution_list->Resolutionccategory->viewAttributes() ?>><?php echo $council_resolution_list->Resolutionccategory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_resolution_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $council_resolution_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_LACode">
<span<?php echo $council_resolution_list->LACode->viewAttributes() ?>><?php echo $council_resolution_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_resolution_list->ResolutionNo->Visible) { // ResolutionNo ?>
		<td data-name="ResolutionNo" <?php echo $council_resolution_list->ResolutionNo->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_ResolutionNo">
<span<?php echo $council_resolution_list->ResolutionNo->viewAttributes() ?>><?php echo $council_resolution_list->ResolutionNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_resolution_list->Responsibility->Visible) { // Responsibility ?>
		<td data-name="Responsibility" <?php echo $council_resolution_list->Responsibility->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_Responsibility">
<span<?php echo $council_resolution_list->Responsibility->viewAttributes() ?>><?php echo $council_resolution_list->Responsibility->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_resolution_list->ActionDate->Visible) { // ActionDate ?>
		<td data-name="ActionDate" <?php echo $council_resolution_list->ActionDate->cellAttributes() ?>>
<span id="el<?php echo $council_resolution_list->RowCount ?>_council_resolution_ActionDate">
<span<?php echo $council_resolution_list->ActionDate->viewAttributes() ?>><?php echo $council_resolution_list->ActionDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_resolution_list->ListOptions->render("body", "right", $council_resolution_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$council_resolution_list->isGridAdd())
		$council_resolution_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$council_resolution->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($council_resolution_list->Recordset)
	$council_resolution_list->Recordset->Close();
?>
<?php if (!$council_resolution_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$council_resolution_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_resolution_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $council_resolution_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($council_resolution_list->TotalRecords == 0 && !$council_resolution->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $council_resolution_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$council_resolution_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_resolution_list->isExport()) { ?>
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
$council_resolution_list->terminate();
?>