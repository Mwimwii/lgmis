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
$council_meeting_type_list = new council_meeting_type_list();

// Run the page
$council_meeting_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$council_meeting_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$council_meeting_type_list->isExport()) { ?>
<script>
var fcouncil_meeting_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncil_meeting_typelist = currentForm = new ew.Form("fcouncil_meeting_typelist", "list");
	fcouncil_meeting_typelist.formKeyCountName = '<?php echo $council_meeting_type_list->FormKeyCountName ?>';
	loadjs.done("fcouncil_meeting_typelist");
});
var fcouncil_meeting_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncil_meeting_typelistsrch = currentSearchForm = new ew.Form("fcouncil_meeting_typelistsrch");

	// Dynamic selection lists
	// Filters

	fcouncil_meeting_typelistsrch.filterList = <?php echo $council_meeting_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncil_meeting_typelistsrch.initSearchPanel = true;
	loadjs.done("fcouncil_meeting_typelistsrch");
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
<?php if (!$council_meeting_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($council_meeting_type_list->TotalRecords > 0 && $council_meeting_type_list->ExportOptions->visible()) { ?>
<?php $council_meeting_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($council_meeting_type_list->ImportOptions->visible()) { ?>
<?php $council_meeting_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($council_meeting_type_list->SearchOptions->visible()) { ?>
<?php $council_meeting_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($council_meeting_type_list->FilterOptions->visible()) { ?>
<?php $council_meeting_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$council_meeting_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$council_meeting_type_list->isExport() && !$council_meeting_type->CurrentAction) { ?>
<form name="fcouncil_meeting_typelistsrch" id="fcouncil_meeting_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncil_meeting_typelistsrch-search-panel" class="<?php echo $council_meeting_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="council_meeting_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $council_meeting_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($council_meeting_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($council_meeting_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $council_meeting_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($council_meeting_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($council_meeting_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($council_meeting_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($council_meeting_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $council_meeting_type_list->showPageHeader(); ?>
<?php
$council_meeting_type_list->showMessage();
?>
<?php if ($council_meeting_type_list->TotalRecords > 0 || $council_meeting_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($council_meeting_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> council_meeting_type">
<?php if (!$council_meeting_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$council_meeting_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $council_meeting_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncil_meeting_typelist" id="fcouncil_meeting_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="council_meeting_type">
<div id="gmp_council_meeting_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($council_meeting_type_list->TotalRecords > 0 || $council_meeting_type_list->isGridEdit()) { ?>
<table id="tbl_council_meeting_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$council_meeting_type->RowType = ROWTYPE_HEADER;

// Render list options
$council_meeting_type_list->renderListOptions();

// Render list options (header, left)
$council_meeting_type_list->ListOptions->render("header", "left");
?>
<?php if ($council_meeting_type_list->MeetingType->Visible) { // MeetingType ?>
	<?php if ($council_meeting_type_list->SortUrl($council_meeting_type_list->MeetingType) == "") { ?>
		<th data-name="MeetingType" class="<?php echo $council_meeting_type_list->MeetingType->headerCellClass() ?>"><div id="elh_council_meeting_type_MeetingType" class="council_meeting_type_MeetingType"><div class="ew-table-header-caption"><?php echo $council_meeting_type_list->MeetingType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingType" class="<?php echo $council_meeting_type_list->MeetingType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_type_list->SortUrl($council_meeting_type_list->MeetingType) ?>', 1);"><div id="elh_council_meeting_type_MeetingType" class="council_meeting_type_MeetingType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_type_list->MeetingType->caption() ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_type_list->MeetingType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_type_list->MeetingType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($council_meeting_type_list->MeetingTypeName->Visible) { // MeetingTypeName ?>
	<?php if ($council_meeting_type_list->SortUrl($council_meeting_type_list->MeetingTypeName) == "") { ?>
		<th data-name="MeetingTypeName" class="<?php echo $council_meeting_type_list->MeetingTypeName->headerCellClass() ?>"><div id="elh_council_meeting_type_MeetingTypeName" class="council_meeting_type_MeetingTypeName"><div class="ew-table-header-caption"><?php echo $council_meeting_type_list->MeetingTypeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MeetingTypeName" class="<?php echo $council_meeting_type_list->MeetingTypeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $council_meeting_type_list->SortUrl($council_meeting_type_list->MeetingTypeName) ?>', 1);"><div id="elh_council_meeting_type_MeetingTypeName" class="council_meeting_type_MeetingTypeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $council_meeting_type_list->MeetingTypeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($council_meeting_type_list->MeetingTypeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($council_meeting_type_list->MeetingTypeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$council_meeting_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($council_meeting_type_list->ExportAll && $council_meeting_type_list->isExport()) {
	$council_meeting_type_list->StopRecord = $council_meeting_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($council_meeting_type_list->TotalRecords > $council_meeting_type_list->StartRecord + $council_meeting_type_list->DisplayRecords - 1)
		$council_meeting_type_list->StopRecord = $council_meeting_type_list->StartRecord + $council_meeting_type_list->DisplayRecords - 1;
	else
		$council_meeting_type_list->StopRecord = $council_meeting_type_list->TotalRecords;
}
$council_meeting_type_list->RecordCount = $council_meeting_type_list->StartRecord - 1;
if ($council_meeting_type_list->Recordset && !$council_meeting_type_list->Recordset->EOF) {
	$council_meeting_type_list->Recordset->moveFirst();
	$selectLimit = $council_meeting_type_list->UseSelectLimit;
	if (!$selectLimit && $council_meeting_type_list->StartRecord > 1)
		$council_meeting_type_list->Recordset->move($council_meeting_type_list->StartRecord - 1);
} elseif (!$council_meeting_type->AllowAddDeleteRow && $council_meeting_type_list->StopRecord == 0) {
	$council_meeting_type_list->StopRecord = $council_meeting_type->GridAddRowCount;
}

// Initialize aggregate
$council_meeting_type->RowType = ROWTYPE_AGGREGATEINIT;
$council_meeting_type->resetAttributes();
$council_meeting_type_list->renderRow();
while ($council_meeting_type_list->RecordCount < $council_meeting_type_list->StopRecord) {
	$council_meeting_type_list->RecordCount++;
	if ($council_meeting_type_list->RecordCount >= $council_meeting_type_list->StartRecord) {
		$council_meeting_type_list->RowCount++;

		// Set up key count
		$council_meeting_type_list->KeyCount = $council_meeting_type_list->RowIndex;

		// Init row class and style
		$council_meeting_type->resetAttributes();
		$council_meeting_type->CssClass = "";
		if ($council_meeting_type_list->isGridAdd()) {
		} else {
			$council_meeting_type_list->loadRowValues($council_meeting_type_list->Recordset); // Load row values
		}
		$council_meeting_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$council_meeting_type->RowAttrs->merge(["data-rowindex" => $council_meeting_type_list->RowCount, "id" => "r" . $council_meeting_type_list->RowCount . "_council_meeting_type", "data-rowtype" => $council_meeting_type->RowType]);

		// Render row
		$council_meeting_type_list->renderRow();

		// Render list options
		$council_meeting_type_list->renderListOptions();
?>
	<tr <?php echo $council_meeting_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$council_meeting_type_list->ListOptions->render("body", "left", $council_meeting_type_list->RowCount);
?>
	<?php if ($council_meeting_type_list->MeetingType->Visible) { // MeetingType ?>
		<td data-name="MeetingType" <?php echo $council_meeting_type_list->MeetingType->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_type_list->RowCount ?>_council_meeting_type_MeetingType">
<span<?php echo $council_meeting_type_list->MeetingType->viewAttributes() ?>><?php echo $council_meeting_type_list->MeetingType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($council_meeting_type_list->MeetingTypeName->Visible) { // MeetingTypeName ?>
		<td data-name="MeetingTypeName" <?php echo $council_meeting_type_list->MeetingTypeName->cellAttributes() ?>>
<span id="el<?php echo $council_meeting_type_list->RowCount ?>_council_meeting_type_MeetingTypeName">
<span<?php echo $council_meeting_type_list->MeetingTypeName->viewAttributes() ?>><?php echo $council_meeting_type_list->MeetingTypeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$council_meeting_type_list->ListOptions->render("body", "right", $council_meeting_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$council_meeting_type_list->isGridAdd())
		$council_meeting_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$council_meeting_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($council_meeting_type_list->Recordset)
	$council_meeting_type_list->Recordset->Close();
?>
<?php if (!$council_meeting_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$council_meeting_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $council_meeting_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $council_meeting_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($council_meeting_type_list->TotalRecords == 0 && !$council_meeting_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $council_meeting_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$council_meeting_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$council_meeting_type_list->isExport()) { ?>
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
$council_meeting_type_list->terminate();
?>