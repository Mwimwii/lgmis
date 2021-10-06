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
$leave_type_list = new leave_type_list();

// Run the page
$leave_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$leave_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$leave_type_list->isExport()) { ?>
<script>
var fleave_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fleave_typelist = currentForm = new ew.Form("fleave_typelist", "list");
	fleave_typelist.formKeyCountName = '<?php echo $leave_type_list->FormKeyCountName ?>';
	loadjs.done("fleave_typelist");
});
var fleave_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fleave_typelistsrch = currentSearchForm = new ew.Form("fleave_typelistsrch");

	// Dynamic selection lists
	// Filters

	fleave_typelistsrch.filterList = <?php echo $leave_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fleave_typelistsrch.initSearchPanel = true;
	loadjs.done("fleave_typelistsrch");
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
<?php if (!$leave_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($leave_type_list->TotalRecords > 0 && $leave_type_list->ExportOptions->visible()) { ?>
<?php $leave_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_type_list->ImportOptions->visible()) { ?>
<?php $leave_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($leave_type_list->SearchOptions->visible()) { ?>
<?php $leave_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($leave_type_list->FilterOptions->visible()) { ?>
<?php $leave_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$leave_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$leave_type_list->isExport() && !$leave_type->CurrentAction) { ?>
<form name="fleave_typelistsrch" id="fleave_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fleave_typelistsrch-search-panel" class="<?php echo $leave_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="leave_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $leave_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($leave_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($leave_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $leave_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($leave_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($leave_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($leave_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($leave_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $leave_type_list->showPageHeader(); ?>
<?php
$leave_type_list->showMessage();
?>
<?php if ($leave_type_list->TotalRecords > 0 || $leave_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($leave_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> leave_type">
<?php if (!$leave_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$leave_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fleave_typelist" id="fleave_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="leave_type">
<div id="gmp_leave_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($leave_type_list->TotalRecords > 0 || $leave_type_list->isGridEdit()) { ?>
<table id="tbl_leave_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$leave_type->RowType = ROWTYPE_HEADER;

// Render list options
$leave_type_list->renderListOptions();

// Render list options (header, left)
$leave_type_list->ListOptions->render("header", "left");
?>
<?php if ($leave_type_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
	<?php if ($leave_type_list->SortUrl($leave_type_list->LeaveTypeCode) == "") { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_type_list->LeaveTypeCode->headerCellClass() ?>"><div id="elh_leave_type_LeaveTypeCode" class="leave_type_LeaveTypeCode"><div class="ew-table-header-caption"><?php echo $leave_type_list->LeaveTypeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeCode" class="<?php echo $leave_type_list->LeaveTypeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_type_list->SortUrl($leave_type_list->LeaveTypeCode) ?>', 1);"><div id="elh_leave_type_LeaveTypeCode" class="leave_type_LeaveTypeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_type_list->LeaveTypeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_type_list->LeaveTypeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_type_list->LeaveTypeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_type_list->LeaveTypeName->Visible) { // LeaveTypeName ?>
	<?php if ($leave_type_list->SortUrl($leave_type_list->LeaveTypeName) == "") { ?>
		<th data-name="LeaveTypeName" class="<?php echo $leave_type_list->LeaveTypeName->headerCellClass() ?>"><div id="elh_leave_type_LeaveTypeName" class="leave_type_LeaveTypeName"><div class="ew-table-header-caption"><?php echo $leave_type_list->LeaveTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LeaveTypeName" class="<?php echo $leave_type_list->LeaveTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_type_list->SortUrl($leave_type_list->LeaveTypeName) ?>', 1);"><div id="elh_leave_type_LeaveTypeName" class="leave_type_LeaveTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_type_list->LeaveTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($leave_type_list->LeaveTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_type_list->LeaveTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($leave_type_list->Accrued->Visible) { // Accrued ?>
	<?php if ($leave_type_list->SortUrl($leave_type_list->Accrued) == "") { ?>
		<th data-name="Accrued" class="<?php echo $leave_type_list->Accrued->headerCellClass() ?>"><div id="elh_leave_type_Accrued" class="leave_type_Accrued"><div class="ew-table-header-caption"><?php echo $leave_type_list->Accrued->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Accrued" class="<?php echo $leave_type_list->Accrued->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $leave_type_list->SortUrl($leave_type_list->Accrued) ?>', 1);"><div id="elh_leave_type_Accrued" class="leave_type_Accrued">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $leave_type_list->Accrued->caption() ?></span><span class="ew-table-header-sort"><?php if ($leave_type_list->Accrued->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($leave_type_list->Accrued->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$leave_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($leave_type_list->ExportAll && $leave_type_list->isExport()) {
	$leave_type_list->StopRecord = $leave_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($leave_type_list->TotalRecords > $leave_type_list->StartRecord + $leave_type_list->DisplayRecords - 1)
		$leave_type_list->StopRecord = $leave_type_list->StartRecord + $leave_type_list->DisplayRecords - 1;
	else
		$leave_type_list->StopRecord = $leave_type_list->TotalRecords;
}
$leave_type_list->RecordCount = $leave_type_list->StartRecord - 1;
if ($leave_type_list->Recordset && !$leave_type_list->Recordset->EOF) {
	$leave_type_list->Recordset->moveFirst();
	$selectLimit = $leave_type_list->UseSelectLimit;
	if (!$selectLimit && $leave_type_list->StartRecord > 1)
		$leave_type_list->Recordset->move($leave_type_list->StartRecord - 1);
} elseif (!$leave_type->AllowAddDeleteRow && $leave_type_list->StopRecord == 0) {
	$leave_type_list->StopRecord = $leave_type->GridAddRowCount;
}

// Initialize aggregate
$leave_type->RowType = ROWTYPE_AGGREGATEINIT;
$leave_type->resetAttributes();
$leave_type_list->renderRow();
while ($leave_type_list->RecordCount < $leave_type_list->StopRecord) {
	$leave_type_list->RecordCount++;
	if ($leave_type_list->RecordCount >= $leave_type_list->StartRecord) {
		$leave_type_list->RowCount++;

		// Set up key count
		$leave_type_list->KeyCount = $leave_type_list->RowIndex;

		// Init row class and style
		$leave_type->resetAttributes();
		$leave_type->CssClass = "";
		if ($leave_type_list->isGridAdd()) {
		} else {
			$leave_type_list->loadRowValues($leave_type_list->Recordset); // Load row values
		}
		$leave_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$leave_type->RowAttrs->merge(["data-rowindex" => $leave_type_list->RowCount, "id" => "r" . $leave_type_list->RowCount . "_leave_type", "data-rowtype" => $leave_type->RowType]);

		// Render row
		$leave_type_list->renderRow();

		// Render list options
		$leave_type_list->renderListOptions();
?>
	<tr <?php echo $leave_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$leave_type_list->ListOptions->render("body", "left", $leave_type_list->RowCount);
?>
	<?php if ($leave_type_list->LeaveTypeCode->Visible) { // LeaveTypeCode ?>
		<td data-name="LeaveTypeCode" <?php echo $leave_type_list->LeaveTypeCode->cellAttributes() ?>>
<span id="el<?php echo $leave_type_list->RowCount ?>_leave_type_LeaveTypeCode">
<span<?php echo $leave_type_list->LeaveTypeCode->viewAttributes() ?>><?php echo $leave_type_list->LeaveTypeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_type_list->LeaveTypeName->Visible) { // LeaveTypeName ?>
		<td data-name="LeaveTypeName" <?php echo $leave_type_list->LeaveTypeName->cellAttributes() ?>>
<span id="el<?php echo $leave_type_list->RowCount ?>_leave_type_LeaveTypeName">
<span<?php echo $leave_type_list->LeaveTypeName->viewAttributes() ?>><?php echo $leave_type_list->LeaveTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($leave_type_list->Accrued->Visible) { // Accrued ?>
		<td data-name="Accrued" <?php echo $leave_type_list->Accrued->cellAttributes() ?>>
<span id="el<?php echo $leave_type_list->RowCount ?>_leave_type_Accrued">
<span<?php echo $leave_type_list->Accrued->viewAttributes() ?>><?php echo $leave_type_list->Accrued->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$leave_type_list->ListOptions->render("body", "right", $leave_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$leave_type_list->isGridAdd())
		$leave_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$leave_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($leave_type_list->Recordset)
	$leave_type_list->Recordset->Close();
?>
<?php if (!$leave_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$leave_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $leave_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $leave_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($leave_type_list->TotalRecords == 0 && !$leave_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $leave_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$leave_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$leave_type_list->isExport()) { ?>
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
$leave_type_list->terminate();
?>