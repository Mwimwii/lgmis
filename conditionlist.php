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
$condition_list = new condition_list();

// Run the page
$condition_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$condition_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$condition_list->isExport()) { ?>
<script>
var fconditionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fconditionlist = currentForm = new ew.Form("fconditionlist", "list");
	fconditionlist.formKeyCountName = '<?php echo $condition_list->FormKeyCountName ?>';
	loadjs.done("fconditionlist");
});
var fconditionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fconditionlistsrch = currentSearchForm = new ew.Form("fconditionlistsrch");

	// Dynamic selection lists
	// Filters

	fconditionlistsrch.filterList = <?php echo $condition_list->getFilterList() ?>;

	// Init search panel as collapsed
	fconditionlistsrch.initSearchPanel = true;
	loadjs.done("fconditionlistsrch");
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
<?php if (!$condition_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($condition_list->TotalRecords > 0 && $condition_list->ExportOptions->visible()) { ?>
<?php $condition_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($condition_list->ImportOptions->visible()) { ?>
<?php $condition_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($condition_list->SearchOptions->visible()) { ?>
<?php $condition_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($condition_list->FilterOptions->visible()) { ?>
<?php $condition_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$condition_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$condition_list->isExport() && !$condition->CurrentAction) { ?>
<form name="fconditionlistsrch" id="fconditionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fconditionlistsrch-search-panel" class="<?php echo $condition_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="condition">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $condition_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($condition_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($condition_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $condition_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($condition_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($condition_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($condition_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($condition_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $condition_list->showPageHeader(); ?>
<?php
$condition_list->showMessage();
?>
<?php if ($condition_list->TotalRecords > 0 || $condition->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($condition_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> condition">
<?php if (!$condition_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$condition_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $condition_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $condition_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fconditionlist" id="fconditionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="condition">
<div id="gmp_condition" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($condition_list->TotalRecords > 0 || $condition_list->isGridEdit()) { ?>
<table id="tbl_conditionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$condition->RowType = ROWTYPE_HEADER;

// Render list options
$condition_list->renderListOptions();

// Render list options (header, left)
$condition_list->ListOptions->render("header", "left");
?>
<?php if ($condition_list->ConditionCode->Visible) { // ConditionCode ?>
	<?php if ($condition_list->SortUrl($condition_list->ConditionCode) == "") { ?>
		<th data-name="ConditionCode" class="<?php echo $condition_list->ConditionCode->headerCellClass() ?>"><div id="elh_condition_ConditionCode" class="condition_ConditionCode"><div class="ew-table-header-caption"><?php echo $condition_list->ConditionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ConditionCode" class="<?php echo $condition_list->ConditionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condition_list->SortUrl($condition_list->ConditionCode) ?>', 1);"><div id="elh_condition_ConditionCode" class="condition_ConditionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condition_list->ConditionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($condition_list->ConditionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condition_list->ConditionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($condition_list->ConditionDesc->Visible) { // ConditionDesc ?>
	<?php if ($condition_list->SortUrl($condition_list->ConditionDesc) == "") { ?>
		<th data-name="ConditionDesc" class="<?php echo $condition_list->ConditionDesc->headerCellClass() ?>"><div id="elh_condition_ConditionDesc" class="condition_ConditionDesc"><div class="ew-table-header-caption"><?php echo $condition_list->ConditionDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ConditionDesc" class="<?php echo $condition_list->ConditionDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condition_list->SortUrl($condition_list->ConditionDesc) ?>', 1);"><div id="elh_condition_ConditionDesc" class="condition_ConditionDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condition_list->ConditionDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($condition_list->ConditionDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condition_list->ConditionDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($condition_list->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
	<?php if ($condition_list->SortUrl($condition_list->AcceptableIndicator) == "") { ?>
		<th data-name="AcceptableIndicator" class="<?php echo $condition_list->AcceptableIndicator->headerCellClass() ?>"><div id="elh_condition_AcceptableIndicator" class="condition_AcceptableIndicator"><div class="ew-table-header-caption"><?php echo $condition_list->AcceptableIndicator->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AcceptableIndicator" class="<?php echo $condition_list->AcceptableIndicator->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $condition_list->SortUrl($condition_list->AcceptableIndicator) ?>', 1);"><div id="elh_condition_AcceptableIndicator" class="condition_AcceptableIndicator">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $condition_list->AcceptableIndicator->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($condition_list->AcceptableIndicator->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($condition_list->AcceptableIndicator->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$condition_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($condition_list->ExportAll && $condition_list->isExport()) {
	$condition_list->StopRecord = $condition_list->TotalRecords;
} else {

	// Set the last record to display
	if ($condition_list->TotalRecords > $condition_list->StartRecord + $condition_list->DisplayRecords - 1)
		$condition_list->StopRecord = $condition_list->StartRecord + $condition_list->DisplayRecords - 1;
	else
		$condition_list->StopRecord = $condition_list->TotalRecords;
}
$condition_list->RecordCount = $condition_list->StartRecord - 1;
if ($condition_list->Recordset && !$condition_list->Recordset->EOF) {
	$condition_list->Recordset->moveFirst();
	$selectLimit = $condition_list->UseSelectLimit;
	if (!$selectLimit && $condition_list->StartRecord > 1)
		$condition_list->Recordset->move($condition_list->StartRecord - 1);
} elseif (!$condition->AllowAddDeleteRow && $condition_list->StopRecord == 0) {
	$condition_list->StopRecord = $condition->GridAddRowCount;
}

// Initialize aggregate
$condition->RowType = ROWTYPE_AGGREGATEINIT;
$condition->resetAttributes();
$condition_list->renderRow();
while ($condition_list->RecordCount < $condition_list->StopRecord) {
	$condition_list->RecordCount++;
	if ($condition_list->RecordCount >= $condition_list->StartRecord) {
		$condition_list->RowCount++;

		// Set up key count
		$condition_list->KeyCount = $condition_list->RowIndex;

		// Init row class and style
		$condition->resetAttributes();
		$condition->CssClass = "";
		if ($condition_list->isGridAdd()) {
		} else {
			$condition_list->loadRowValues($condition_list->Recordset); // Load row values
		}
		$condition->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$condition->RowAttrs->merge(["data-rowindex" => $condition_list->RowCount, "id" => "r" . $condition_list->RowCount . "_condition", "data-rowtype" => $condition->RowType]);

		// Render row
		$condition_list->renderRow();

		// Render list options
		$condition_list->renderListOptions();
?>
	<tr <?php echo $condition->rowAttributes() ?>>
<?php

// Render list options (body, left)
$condition_list->ListOptions->render("body", "left", $condition_list->RowCount);
?>
	<?php if ($condition_list->ConditionCode->Visible) { // ConditionCode ?>
		<td data-name="ConditionCode" <?php echo $condition_list->ConditionCode->cellAttributes() ?>>
<span id="el<?php echo $condition_list->RowCount ?>_condition_ConditionCode">
<span<?php echo $condition_list->ConditionCode->viewAttributes() ?>><?php echo $condition_list->ConditionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($condition_list->ConditionDesc->Visible) { // ConditionDesc ?>
		<td data-name="ConditionDesc" <?php echo $condition_list->ConditionDesc->cellAttributes() ?>>
<span id="el<?php echo $condition_list->RowCount ?>_condition_ConditionDesc">
<span<?php echo $condition_list->ConditionDesc->viewAttributes() ?>><?php echo $condition_list->ConditionDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($condition_list->AcceptableIndicator->Visible) { // AcceptableIndicator ?>
		<td data-name="AcceptableIndicator" <?php echo $condition_list->AcceptableIndicator->cellAttributes() ?>>
<span id="el<?php echo $condition_list->RowCount ?>_condition_AcceptableIndicator">
<span<?php echo $condition_list->AcceptableIndicator->viewAttributes() ?>><?php echo $condition_list->AcceptableIndicator->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$condition_list->ListOptions->render("body", "right", $condition_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$condition_list->isGridAdd())
		$condition_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$condition->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($condition_list->Recordset)
	$condition_list->Recordset->Close();
?>
<?php if (!$condition_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$condition_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $condition_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $condition_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($condition_list->TotalRecords == 0 && !$condition->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $condition_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$condition_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$condition_list->isExport()) { ?>
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
$condition_list->terminate();
?>