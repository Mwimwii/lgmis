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
$professional_level_list = new professional_level_list();

// Run the page
$professional_level_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_level_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$professional_level_list->isExport()) { ?>
<script>
var fprofessional_levellist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprofessional_levellist = currentForm = new ew.Form("fprofessional_levellist", "list");
	fprofessional_levellist.formKeyCountName = '<?php echo $professional_level_list->FormKeyCountName ?>';
	loadjs.done("fprofessional_levellist");
});
var fprofessional_levellistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprofessional_levellistsrch = currentSearchForm = new ew.Form("fprofessional_levellistsrch");

	// Dynamic selection lists
	// Filters

	fprofessional_levellistsrch.filterList = <?php echo $professional_level_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprofessional_levellistsrch.initSearchPanel = true;
	loadjs.done("fprofessional_levellistsrch");
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
<?php if (!$professional_level_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($professional_level_list->TotalRecords > 0 && $professional_level_list->ExportOptions->visible()) { ?>
<?php $professional_level_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($professional_level_list->ImportOptions->visible()) { ?>
<?php $professional_level_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($professional_level_list->SearchOptions->visible()) { ?>
<?php $professional_level_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($professional_level_list->FilterOptions->visible()) { ?>
<?php $professional_level_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$professional_level_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$professional_level_list->isExport() && !$professional_level->CurrentAction) { ?>
<form name="fprofessional_levellistsrch" id="fprofessional_levellistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprofessional_levellistsrch-search-panel" class="<?php echo $professional_level_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="professional_level">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $professional_level_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($professional_level_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($professional_level_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $professional_level_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($professional_level_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($professional_level_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($professional_level_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($professional_level_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $professional_level_list->showPageHeader(); ?>
<?php
$professional_level_list->showMessage();
?>
<?php if ($professional_level_list->TotalRecords > 0 || $professional_level->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($professional_level_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> professional_level">
<?php if (!$professional_level_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$professional_level_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_level_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $professional_level_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprofessional_levellist" id="fprofessional_levellist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_level">
<div id="gmp_professional_level" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($professional_level_list->TotalRecords > 0 || $professional_level_list->isGridEdit()) { ?>
<table id="tbl_professional_levellist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$professional_level->RowType = ROWTYPE_HEADER;

// Render list options
$professional_level_list->renderListOptions();

// Render list options (header, left)
$professional_level_list->ListOptions->render("header", "left");
?>
<?php if ($professional_level_list->ProfessionalLevel->Visible) { // ProfessionalLevel ?>
	<?php if ($professional_level_list->SortUrl($professional_level_list->ProfessionalLevel) == "") { ?>
		<th data-name="ProfessionalLevel" class="<?php echo $professional_level_list->ProfessionalLevel->headerCellClass() ?>"><div id="elh_professional_level_ProfessionalLevel" class="professional_level_ProfessionalLevel"><div class="ew-table-header-caption"><?php echo $professional_level_list->ProfessionalLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalLevel" class="<?php echo $professional_level_list->ProfessionalLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_level_list->SortUrl($professional_level_list->ProfessionalLevel) ?>', 1);"><div id="elh_professional_level_ProfessionalLevel" class="professional_level_ProfessionalLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_level_list->ProfessionalLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($professional_level_list->ProfessionalLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_level_list->ProfessionalLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professional_level_list->ProfessionalName->Visible) { // ProfessionalName ?>
	<?php if ($professional_level_list->SortUrl($professional_level_list->ProfessionalName) == "") { ?>
		<th data-name="ProfessionalName" class="<?php echo $professional_level_list->ProfessionalName->headerCellClass() ?>"><div id="elh_professional_level_ProfessionalName" class="professional_level_ProfessionalName"><div class="ew-table-header-caption"><?php echo $professional_level_list->ProfessionalName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalName" class="<?php echo $professional_level_list->ProfessionalName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_level_list->SortUrl($professional_level_list->ProfessionalName) ?>', 1);"><div id="elh_professional_level_ProfessionalName" class="professional_level_ProfessionalName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_level_list->ProfessionalName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professional_level_list->ProfessionalName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_level_list->ProfessionalName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professional_level_list->ProfessionalDesc->Visible) { // ProfessionalDesc ?>
	<?php if ($professional_level_list->SortUrl($professional_level_list->ProfessionalDesc) == "") { ?>
		<th data-name="ProfessionalDesc" class="<?php echo $professional_level_list->ProfessionalDesc->headerCellClass() ?>"><div id="elh_professional_level_ProfessionalDesc" class="professional_level_ProfessionalDesc"><div class="ew-table-header-caption"><?php echo $professional_level_list->ProfessionalDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalDesc" class="<?php echo $professional_level_list->ProfessionalDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_level_list->SortUrl($professional_level_list->ProfessionalDesc) ?>', 1);"><div id="elh_professional_level_ProfessionalDesc" class="professional_level_ProfessionalDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_level_list->ProfessionalDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professional_level_list->ProfessionalDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_level_list->ProfessionalDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professional_level_list->LastUserID->Visible) { // LastUserID ?>
	<?php if ($professional_level_list->SortUrl($professional_level_list->LastUserID) == "") { ?>
		<th data-name="LastUserID" class="<?php echo $professional_level_list->LastUserID->headerCellClass() ?>"><div id="elh_professional_level_LastUserID" class="professional_level_LastUserID"><div class="ew-table-header-caption"><?php echo $professional_level_list->LastUserID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUserID" class="<?php echo $professional_level_list->LastUserID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_level_list->SortUrl($professional_level_list->LastUserID) ?>', 1);"><div id="elh_professional_level_LastUserID" class="professional_level_LastUserID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_level_list->LastUserID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professional_level_list->LastUserID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_level_list->LastUserID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professional_level_list->LastUpdated->Visible) { // LastUpdated ?>
	<?php if ($professional_level_list->SortUrl($professional_level_list->LastUpdated) == "") { ?>
		<th data-name="LastUpdated" class="<?php echo $professional_level_list->LastUpdated->headerCellClass() ?>"><div id="elh_professional_level_LastUpdated" class="professional_level_LastUpdated"><div class="ew-table-header-caption"><?php echo $professional_level_list->LastUpdated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdated" class="<?php echo $professional_level_list->LastUpdated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_level_list->SortUrl($professional_level_list->LastUpdated) ?>', 1);"><div id="elh_professional_level_LastUpdated" class="professional_level_LastUpdated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_level_list->LastUpdated->caption() ?></span><span class="ew-table-header-sort"><?php if ($professional_level_list->LastUpdated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_level_list->LastUpdated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$professional_level_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($professional_level_list->ExportAll && $professional_level_list->isExport()) {
	$professional_level_list->StopRecord = $professional_level_list->TotalRecords;
} else {

	// Set the last record to display
	if ($professional_level_list->TotalRecords > $professional_level_list->StartRecord + $professional_level_list->DisplayRecords - 1)
		$professional_level_list->StopRecord = $professional_level_list->StartRecord + $professional_level_list->DisplayRecords - 1;
	else
		$professional_level_list->StopRecord = $professional_level_list->TotalRecords;
}
$professional_level_list->RecordCount = $professional_level_list->StartRecord - 1;
if ($professional_level_list->Recordset && !$professional_level_list->Recordset->EOF) {
	$professional_level_list->Recordset->moveFirst();
	$selectLimit = $professional_level_list->UseSelectLimit;
	if (!$selectLimit && $professional_level_list->StartRecord > 1)
		$professional_level_list->Recordset->move($professional_level_list->StartRecord - 1);
} elseif (!$professional_level->AllowAddDeleteRow && $professional_level_list->StopRecord == 0) {
	$professional_level_list->StopRecord = $professional_level->GridAddRowCount;
}

// Initialize aggregate
$professional_level->RowType = ROWTYPE_AGGREGATEINIT;
$professional_level->resetAttributes();
$professional_level_list->renderRow();
while ($professional_level_list->RecordCount < $professional_level_list->StopRecord) {
	$professional_level_list->RecordCount++;
	if ($professional_level_list->RecordCount >= $professional_level_list->StartRecord) {
		$professional_level_list->RowCount++;

		// Set up key count
		$professional_level_list->KeyCount = $professional_level_list->RowIndex;

		// Init row class and style
		$professional_level->resetAttributes();
		$professional_level->CssClass = "";
		if ($professional_level_list->isGridAdd()) {
		} else {
			$professional_level_list->loadRowValues($professional_level_list->Recordset); // Load row values
		}
		$professional_level->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$professional_level->RowAttrs->merge(["data-rowindex" => $professional_level_list->RowCount, "id" => "r" . $professional_level_list->RowCount . "_professional_level", "data-rowtype" => $professional_level->RowType]);

		// Render row
		$professional_level_list->renderRow();

		// Render list options
		$professional_level_list->renderListOptions();
?>
	<tr <?php echo $professional_level->rowAttributes() ?>>
<?php

// Render list options (body, left)
$professional_level_list->ListOptions->render("body", "left", $professional_level_list->RowCount);
?>
	<?php if ($professional_level_list->ProfessionalLevel->Visible) { // ProfessionalLevel ?>
		<td data-name="ProfessionalLevel" <?php echo $professional_level_list->ProfessionalLevel->cellAttributes() ?>>
<span id="el<?php echo $professional_level_list->RowCount ?>_professional_level_ProfessionalLevel">
<span<?php echo $professional_level_list->ProfessionalLevel->viewAttributes() ?>><?php echo $professional_level_list->ProfessionalLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professional_level_list->ProfessionalName->Visible) { // ProfessionalName ?>
		<td data-name="ProfessionalName" <?php echo $professional_level_list->ProfessionalName->cellAttributes() ?>>
<span id="el<?php echo $professional_level_list->RowCount ?>_professional_level_ProfessionalName">
<span<?php echo $professional_level_list->ProfessionalName->viewAttributes() ?>><?php echo $professional_level_list->ProfessionalName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professional_level_list->ProfessionalDesc->Visible) { // ProfessionalDesc ?>
		<td data-name="ProfessionalDesc" <?php echo $professional_level_list->ProfessionalDesc->cellAttributes() ?>>
<span id="el<?php echo $professional_level_list->RowCount ?>_professional_level_ProfessionalDesc">
<span<?php echo $professional_level_list->ProfessionalDesc->viewAttributes() ?>><?php echo $professional_level_list->ProfessionalDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professional_level_list->LastUserID->Visible) { // LastUserID ?>
		<td data-name="LastUserID" <?php echo $professional_level_list->LastUserID->cellAttributes() ?>>
<span id="el<?php echo $professional_level_list->RowCount ?>_professional_level_LastUserID">
<span<?php echo $professional_level_list->LastUserID->viewAttributes() ?>><?php echo $professional_level_list->LastUserID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professional_level_list->LastUpdated->Visible) { // LastUpdated ?>
		<td data-name="LastUpdated" <?php echo $professional_level_list->LastUpdated->cellAttributes() ?>>
<span id="el<?php echo $professional_level_list->RowCount ?>_professional_level_LastUpdated">
<span<?php echo $professional_level_list->LastUpdated->viewAttributes() ?>><?php echo $professional_level_list->LastUpdated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$professional_level_list->ListOptions->render("body", "right", $professional_level_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$professional_level_list->isGridAdd())
		$professional_level_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$professional_level->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($professional_level_list->Recordset)
	$professional_level_list->Recordset->Close();
?>
<?php if (!$professional_level_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$professional_level_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_level_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $professional_level_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($professional_level_list->TotalRecords == 0 && !$professional_level->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $professional_level_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$professional_level_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$professional_level_list->isExport()) { ?>
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
$professional_level_list->terminate();
?>