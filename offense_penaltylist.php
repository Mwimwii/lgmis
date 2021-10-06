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
$offense_penalty_list = new offense_penalty_list();

// Run the page
$offense_penalty_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$offense_penalty_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$offense_penalty_list->isExport()) { ?>
<script>
var foffense_penaltylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	foffense_penaltylist = currentForm = new ew.Form("foffense_penaltylist", "list");
	foffense_penaltylist.formKeyCountName = '<?php echo $offense_penalty_list->FormKeyCountName ?>';
	loadjs.done("foffense_penaltylist");
});
var foffense_penaltylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	foffense_penaltylistsrch = currentSearchForm = new ew.Form("foffense_penaltylistsrch");

	// Dynamic selection lists
	// Filters

	foffense_penaltylistsrch.filterList = <?php echo $offense_penalty_list->getFilterList() ?>;

	// Init search panel as collapsed
	foffense_penaltylistsrch.initSearchPanel = true;
	loadjs.done("foffense_penaltylistsrch");
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
<?php if (!$offense_penalty_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($offense_penalty_list->TotalRecords > 0 && $offense_penalty_list->ExportOptions->visible()) { ?>
<?php $offense_penalty_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($offense_penalty_list->ImportOptions->visible()) { ?>
<?php $offense_penalty_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($offense_penalty_list->SearchOptions->visible()) { ?>
<?php $offense_penalty_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($offense_penalty_list->FilterOptions->visible()) { ?>
<?php $offense_penalty_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$offense_penalty_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$offense_penalty_list->isExport() && !$offense_penalty->CurrentAction) { ?>
<form name="foffense_penaltylistsrch" id="foffense_penaltylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="foffense_penaltylistsrch-search-panel" class="<?php echo $offense_penalty_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="offense_penalty">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $offense_penalty_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($offense_penalty_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($offense_penalty_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $offense_penalty_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($offense_penalty_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($offense_penalty_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($offense_penalty_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($offense_penalty_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $offense_penalty_list->showPageHeader(); ?>
<?php
$offense_penalty_list->showMessage();
?>
<?php if ($offense_penalty_list->TotalRecords > 0 || $offense_penalty->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($offense_penalty_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> offense_penalty">
<?php if (!$offense_penalty_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$offense_penalty_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_penalty_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $offense_penalty_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="foffense_penaltylist" id="foffense_penaltylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="offense_penalty">
<div id="gmp_offense_penalty" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($offense_penalty_list->TotalRecords > 0 || $offense_penalty_list->isGridEdit()) { ?>
<table id="tbl_offense_penaltylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$offense_penalty->RowType = ROWTYPE_HEADER;

// Render list options
$offense_penalty_list->renderListOptions();

// Render list options (header, left)
$offense_penalty_list->ListOptions->render("header", "left");
?>
<?php if ($offense_penalty_list->OffenseCode->Visible) { // OffenseCode ?>
	<?php if ($offense_penalty_list->SortUrl($offense_penalty_list->OffenseCode) == "") { ?>
		<th data-name="OffenseCode" class="<?php echo $offense_penalty_list->OffenseCode->headerCellClass() ?>"><div id="elh_offense_penalty_OffenseCode" class="offense_penalty_OffenseCode"><div class="ew-table-header-caption"><?php echo $offense_penalty_list->OffenseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCode" class="<?php echo $offense_penalty_list->OffenseCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_penalty_list->SortUrl($offense_penalty_list->OffenseCode) ?>', 1);"><div id="elh_offense_penalty_OffenseCode" class="offense_penalty_OffenseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_penalty_list->OffenseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($offense_penalty_list->OffenseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_penalty_list->OffenseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($offense_penalty_list->OffenseCategory->Visible) { // OffenseCategory ?>
	<?php if ($offense_penalty_list->SortUrl($offense_penalty_list->OffenseCategory) == "") { ?>
		<th data-name="OffenseCategory" class="<?php echo $offense_penalty_list->OffenseCategory->headerCellClass() ?>"><div id="elh_offense_penalty_OffenseCategory" class="offense_penalty_OffenseCategory"><div class="ew-table-header-caption"><?php echo $offense_penalty_list->OffenseCategory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseCategory" class="<?php echo $offense_penalty_list->OffenseCategory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_penalty_list->SortUrl($offense_penalty_list->OffenseCategory) ?>', 1);"><div id="elh_offense_penalty_OffenseCategory" class="offense_penalty_OffenseCategory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_penalty_list->OffenseCategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($offense_penalty_list->OffenseCategory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_penalty_list->OffenseCategory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($offense_penalty_list->OffenseName->Visible) { // OffenseName ?>
	<?php if ($offense_penalty_list->SortUrl($offense_penalty_list->OffenseName) == "") { ?>
		<th data-name="OffenseName" class="<?php echo $offense_penalty_list->OffenseName->headerCellClass() ?>"><div id="elh_offense_penalty_OffenseName" class="offense_penalty_OffenseName"><div class="ew-table-header-caption"><?php echo $offense_penalty_list->OffenseName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="OffenseName" class="<?php echo $offense_penalty_list->OffenseName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_penalty_list->SortUrl($offense_penalty_list->OffenseName) ?>', 1);"><div id="elh_offense_penalty_OffenseName" class="offense_penalty_OffenseName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_penalty_list->OffenseName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($offense_penalty_list->OffenseName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_penalty_list->OffenseName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($offense_penalty_list->Frequency->Visible) { // Frequency ?>
	<?php if ($offense_penalty_list->SortUrl($offense_penalty_list->Frequency) == "") { ?>
		<th data-name="Frequency" class="<?php echo $offense_penalty_list->Frequency->headerCellClass() ?>"><div id="elh_offense_penalty_Frequency" class="offense_penalty_Frequency"><div class="ew-table-header-caption"><?php echo $offense_penalty_list->Frequency->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Frequency" class="<?php echo $offense_penalty_list->Frequency->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_penalty_list->SortUrl($offense_penalty_list->Frequency) ?>', 1);"><div id="elh_offense_penalty_Frequency" class="offense_penalty_Frequency">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_penalty_list->Frequency->caption() ?></span><span class="ew-table-header-sort"><?php if ($offense_penalty_list->Frequency->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_penalty_list->Frequency->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($offense_penalty_list->AppropriateAction->Visible) { // AppropriateAction ?>
	<?php if ($offense_penalty_list->SortUrl($offense_penalty_list->AppropriateAction) == "") { ?>
		<th data-name="AppropriateAction" class="<?php echo $offense_penalty_list->AppropriateAction->headerCellClass() ?>"><div id="elh_offense_penalty_AppropriateAction" class="offense_penalty_AppropriateAction"><div class="ew-table-header-caption"><?php echo $offense_penalty_list->AppropriateAction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AppropriateAction" class="<?php echo $offense_penalty_list->AppropriateAction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_penalty_list->SortUrl($offense_penalty_list->AppropriateAction) ?>', 1);"><div id="elh_offense_penalty_AppropriateAction" class="offense_penalty_AppropriateAction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_penalty_list->AppropriateAction->caption() ?></span><span class="ew-table-header-sort"><?php if ($offense_penalty_list->AppropriateAction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_penalty_list->AppropriateAction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($offense_penalty_list->Authority->Visible) { // Authority ?>
	<?php if ($offense_penalty_list->SortUrl($offense_penalty_list->Authority) == "") { ?>
		<th data-name="Authority" class="<?php echo $offense_penalty_list->Authority->headerCellClass() ?>"><div id="elh_offense_penalty_Authority" class="offense_penalty_Authority"><div class="ew-table-header-caption"><?php echo $offense_penalty_list->Authority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Authority" class="<?php echo $offense_penalty_list->Authority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $offense_penalty_list->SortUrl($offense_penalty_list->Authority) ?>', 1);"><div id="elh_offense_penalty_Authority" class="offense_penalty_Authority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $offense_penalty_list->Authority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($offense_penalty_list->Authority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($offense_penalty_list->Authority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$offense_penalty_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($offense_penalty_list->ExportAll && $offense_penalty_list->isExport()) {
	$offense_penalty_list->StopRecord = $offense_penalty_list->TotalRecords;
} else {

	// Set the last record to display
	if ($offense_penalty_list->TotalRecords > $offense_penalty_list->StartRecord + $offense_penalty_list->DisplayRecords - 1)
		$offense_penalty_list->StopRecord = $offense_penalty_list->StartRecord + $offense_penalty_list->DisplayRecords - 1;
	else
		$offense_penalty_list->StopRecord = $offense_penalty_list->TotalRecords;
}
$offense_penalty_list->RecordCount = $offense_penalty_list->StartRecord - 1;
if ($offense_penalty_list->Recordset && !$offense_penalty_list->Recordset->EOF) {
	$offense_penalty_list->Recordset->moveFirst();
	$selectLimit = $offense_penalty_list->UseSelectLimit;
	if (!$selectLimit && $offense_penalty_list->StartRecord > 1)
		$offense_penalty_list->Recordset->move($offense_penalty_list->StartRecord - 1);
} elseif (!$offense_penalty->AllowAddDeleteRow && $offense_penalty_list->StopRecord == 0) {
	$offense_penalty_list->StopRecord = $offense_penalty->GridAddRowCount;
}

// Initialize aggregate
$offense_penalty->RowType = ROWTYPE_AGGREGATEINIT;
$offense_penalty->resetAttributes();
$offense_penalty_list->renderRow();
while ($offense_penalty_list->RecordCount < $offense_penalty_list->StopRecord) {
	$offense_penalty_list->RecordCount++;
	if ($offense_penalty_list->RecordCount >= $offense_penalty_list->StartRecord) {
		$offense_penalty_list->RowCount++;

		// Set up key count
		$offense_penalty_list->KeyCount = $offense_penalty_list->RowIndex;

		// Init row class and style
		$offense_penalty->resetAttributes();
		$offense_penalty->CssClass = "";
		if ($offense_penalty_list->isGridAdd()) {
		} else {
			$offense_penalty_list->loadRowValues($offense_penalty_list->Recordset); // Load row values
		}
		$offense_penalty->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$offense_penalty->RowAttrs->merge(["data-rowindex" => $offense_penalty_list->RowCount, "id" => "r" . $offense_penalty_list->RowCount . "_offense_penalty", "data-rowtype" => $offense_penalty->RowType]);

		// Render row
		$offense_penalty_list->renderRow();

		// Render list options
		$offense_penalty_list->renderListOptions();
?>
	<tr <?php echo $offense_penalty->rowAttributes() ?>>
<?php

// Render list options (body, left)
$offense_penalty_list->ListOptions->render("body", "left", $offense_penalty_list->RowCount);
?>
	<?php if ($offense_penalty_list->OffenseCode->Visible) { // OffenseCode ?>
		<td data-name="OffenseCode" <?php echo $offense_penalty_list->OffenseCode->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_list->RowCount ?>_offense_penalty_OffenseCode">
<span<?php echo $offense_penalty_list->OffenseCode->viewAttributes() ?>><?php echo $offense_penalty_list->OffenseCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($offense_penalty_list->OffenseCategory->Visible) { // OffenseCategory ?>
		<td data-name="OffenseCategory" <?php echo $offense_penalty_list->OffenseCategory->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_list->RowCount ?>_offense_penalty_OffenseCategory">
<span<?php echo $offense_penalty_list->OffenseCategory->viewAttributes() ?>><?php echo $offense_penalty_list->OffenseCategory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($offense_penalty_list->OffenseName->Visible) { // OffenseName ?>
		<td data-name="OffenseName" <?php echo $offense_penalty_list->OffenseName->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_list->RowCount ?>_offense_penalty_OffenseName">
<span<?php echo $offense_penalty_list->OffenseName->viewAttributes() ?>><?php echo $offense_penalty_list->OffenseName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($offense_penalty_list->Frequency->Visible) { // Frequency ?>
		<td data-name="Frequency" <?php echo $offense_penalty_list->Frequency->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_list->RowCount ?>_offense_penalty_Frequency">
<span<?php echo $offense_penalty_list->Frequency->viewAttributes() ?>><?php echo $offense_penalty_list->Frequency->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($offense_penalty_list->AppropriateAction->Visible) { // AppropriateAction ?>
		<td data-name="AppropriateAction" <?php echo $offense_penalty_list->AppropriateAction->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_list->RowCount ?>_offense_penalty_AppropriateAction">
<span<?php echo $offense_penalty_list->AppropriateAction->viewAttributes() ?>><?php echo $offense_penalty_list->AppropriateAction->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($offense_penalty_list->Authority->Visible) { // Authority ?>
		<td data-name="Authority" <?php echo $offense_penalty_list->Authority->cellAttributes() ?>>
<span id="el<?php echo $offense_penalty_list->RowCount ?>_offense_penalty_Authority">
<span<?php echo $offense_penalty_list->Authority->viewAttributes() ?>><?php echo $offense_penalty_list->Authority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$offense_penalty_list->ListOptions->render("body", "right", $offense_penalty_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$offense_penalty_list->isGridAdd())
		$offense_penalty_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$offense_penalty->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($offense_penalty_list->Recordset)
	$offense_penalty_list->Recordset->Close();
?>
<?php if (!$offense_penalty_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$offense_penalty_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $offense_penalty_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $offense_penalty_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($offense_penalty_list->TotalRecords == 0 && !$offense_penalty->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $offense_penalty_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$offense_penalty_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$offense_penalty_list->isExport()) { ?>
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
$offense_penalty_list->terminate();
?>