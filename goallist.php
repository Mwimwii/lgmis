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
$goal_list = new goal_list();

// Run the page
$goal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$goal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$goal_list->isExport()) { ?>
<script>
var fgoallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fgoallist = currentForm = new ew.Form("fgoallist", "list");
	fgoallist.formKeyCountName = '<?php echo $goal_list->FormKeyCountName ?>';
	loadjs.done("fgoallist");
});
var fgoallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fgoallistsrch = currentSearchForm = new ew.Form("fgoallistsrch");

	// Dynamic selection lists
	// Filters

	fgoallistsrch.filterList = <?php echo $goal_list->getFilterList() ?>;

	// Init search panel as collapsed
	fgoallistsrch.initSearchPanel = true;
	loadjs.done("fgoallistsrch");
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
<?php if (!$goal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($goal_list->TotalRecords > 0 && $goal_list->ExportOptions->visible()) { ?>
<?php $goal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($goal_list->ImportOptions->visible()) { ?>
<?php $goal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($goal_list->SearchOptions->visible()) { ?>
<?php $goal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($goal_list->FilterOptions->visible()) { ?>
<?php $goal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$goal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$goal_list->isExport() && !$goal->CurrentAction) { ?>
<form name="fgoallistsrch" id="fgoallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fgoallistsrch-search-panel" class="<?php echo $goal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="goal">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $goal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($goal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($goal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $goal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($goal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($goal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($goal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($goal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $goal_list->showPageHeader(); ?>
<?php
$goal_list->showMessage();
?>
<?php if ($goal_list->TotalRecords > 0 || $goal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($goal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> goal">
<?php if (!$goal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$goal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $goal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $goal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fgoallist" id="fgoallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="goal">
<div id="gmp_goal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($goal_list->TotalRecords > 0 || $goal_list->isGridEdit()) { ?>
<table id="tbl_goallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$goal->RowType = ROWTYPE_HEADER;

// Render list options
$goal_list->renderListOptions();

// Render list options (header, left)
$goal_list->ListOptions->render("header", "left");
?>
<?php if ($goal_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
	<?php if ($goal_list->SortUrl($goal_list->StrategicObjectiveCode) == "") { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $goal_list->StrategicObjectiveCode->headerCellClass() ?>"><div id="elh_goal_StrategicObjectiveCode" class="goal_StrategicObjectiveCode"><div class="ew-table-header-caption"><?php echo $goal_list->StrategicObjectiveCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StrategicObjectiveCode" class="<?php echo $goal_list->StrategicObjectiveCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $goal_list->SortUrl($goal_list->StrategicObjectiveCode) ?>', 1);"><div id="elh_goal_StrategicObjectiveCode" class="goal_StrategicObjectiveCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $goal_list->StrategicObjectiveCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($goal_list->StrategicObjectiveCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($goal_list->StrategicObjectiveCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($goal_list->GoalNo->Visible) { // GoalNo ?>
	<?php if ($goal_list->SortUrl($goal_list->GoalNo) == "") { ?>
		<th data-name="GoalNo" class="<?php echo $goal_list->GoalNo->headerCellClass() ?>"><div id="elh_goal_GoalNo" class="goal_GoalNo"><div class="ew-table-header-caption"><?php echo $goal_list->GoalNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GoalNo" class="<?php echo $goal_list->GoalNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $goal_list->SortUrl($goal_list->GoalNo) ?>', 1);"><div id="elh_goal_GoalNo" class="goal_GoalNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $goal_list->GoalNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($goal_list->GoalNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($goal_list->GoalNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($goal_list->GoalName->Visible) { // GoalName ?>
	<?php if ($goal_list->SortUrl($goal_list->GoalName) == "") { ?>
		<th data-name="GoalName" class="<?php echo $goal_list->GoalName->headerCellClass() ?>"><div id="elh_goal_GoalName" class="goal_GoalName"><div class="ew-table-header-caption"><?php echo $goal_list->GoalName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="GoalName" class="<?php echo $goal_list->GoalName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $goal_list->SortUrl($goal_list->GoalName) ?>', 1);"><div id="elh_goal_GoalName" class="goal_GoalName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $goal_list->GoalName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($goal_list->GoalName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($goal_list->GoalName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($goal_list->LACode->Visible) { // LACode ?>
	<?php if ($goal_list->SortUrl($goal_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $goal_list->LACode->headerCellClass() ?>"><div id="elh_goal_LACode" class="goal_LACode"><div class="ew-table-header-caption"><?php echo $goal_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $goal_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $goal_list->SortUrl($goal_list->LACode) ?>', 1);"><div id="elh_goal_LACode" class="goal_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $goal_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($goal_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($goal_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$goal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($goal_list->ExportAll && $goal_list->isExport()) {
	$goal_list->StopRecord = $goal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($goal_list->TotalRecords > $goal_list->StartRecord + $goal_list->DisplayRecords - 1)
		$goal_list->StopRecord = $goal_list->StartRecord + $goal_list->DisplayRecords - 1;
	else
		$goal_list->StopRecord = $goal_list->TotalRecords;
}
$goal_list->RecordCount = $goal_list->StartRecord - 1;
if ($goal_list->Recordset && !$goal_list->Recordset->EOF) {
	$goal_list->Recordset->moveFirst();
	$selectLimit = $goal_list->UseSelectLimit;
	if (!$selectLimit && $goal_list->StartRecord > 1)
		$goal_list->Recordset->move($goal_list->StartRecord - 1);
} elseif (!$goal->AllowAddDeleteRow && $goal_list->StopRecord == 0) {
	$goal_list->StopRecord = $goal->GridAddRowCount;
}

// Initialize aggregate
$goal->RowType = ROWTYPE_AGGREGATEINIT;
$goal->resetAttributes();
$goal_list->renderRow();
while ($goal_list->RecordCount < $goal_list->StopRecord) {
	$goal_list->RecordCount++;
	if ($goal_list->RecordCount >= $goal_list->StartRecord) {
		$goal_list->RowCount++;

		// Set up key count
		$goal_list->KeyCount = $goal_list->RowIndex;

		// Init row class and style
		$goal->resetAttributes();
		$goal->CssClass = "";
		if ($goal_list->isGridAdd()) {
		} else {
			$goal_list->loadRowValues($goal_list->Recordset); // Load row values
		}
		$goal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$goal->RowAttrs->merge(["data-rowindex" => $goal_list->RowCount, "id" => "r" . $goal_list->RowCount . "_goal", "data-rowtype" => $goal->RowType]);

		// Render row
		$goal_list->renderRow();

		// Render list options
		$goal_list->renderListOptions();
?>
	<tr <?php echo $goal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$goal_list->ListOptions->render("body", "left", $goal_list->RowCount);
?>
	<?php if ($goal_list->StrategicObjectiveCode->Visible) { // StrategicObjectiveCode ?>
		<td data-name="StrategicObjectiveCode" <?php echo $goal_list->StrategicObjectiveCode->cellAttributes() ?>>
<span id="el<?php echo $goal_list->RowCount ?>_goal_StrategicObjectiveCode">
<span<?php echo $goal_list->StrategicObjectiveCode->viewAttributes() ?>><?php echo $goal_list->StrategicObjectiveCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($goal_list->GoalNo->Visible) { // GoalNo ?>
		<td data-name="GoalNo" <?php echo $goal_list->GoalNo->cellAttributes() ?>>
<span id="el<?php echo $goal_list->RowCount ?>_goal_GoalNo">
<span<?php echo $goal_list->GoalNo->viewAttributes() ?>><?php echo $goal_list->GoalNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($goal_list->GoalName->Visible) { // GoalName ?>
		<td data-name="GoalName" <?php echo $goal_list->GoalName->cellAttributes() ?>>
<span id="el<?php echo $goal_list->RowCount ?>_goal_GoalName">
<span<?php echo $goal_list->GoalName->viewAttributes() ?>><?php echo $goal_list->GoalName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($goal_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $goal_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $goal_list->RowCount ?>_goal_LACode">
<span<?php echo $goal_list->LACode->viewAttributes() ?>><?php echo $goal_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$goal_list->ListOptions->render("body", "right", $goal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$goal_list->isGridAdd())
		$goal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$goal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($goal_list->Recordset)
	$goal_list->Recordset->Close();
?>
<?php if (!$goal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$goal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $goal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $goal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($goal_list->TotalRecords == 0 && !$goal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $goal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$goal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$goal_list->isExport()) { ?>
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
$goal_list->terminate();
?>