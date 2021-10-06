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
$action_type_list = new action_type_list();

// Run the page
$action_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$action_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$action_type_list->isExport()) { ?>
<script>
var faction_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	faction_typelist = currentForm = new ew.Form("faction_typelist", "list");
	faction_typelist.formKeyCountName = '<?php echo $action_type_list->FormKeyCountName ?>';
	loadjs.done("faction_typelist");
});
var faction_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	faction_typelistsrch = currentSearchForm = new ew.Form("faction_typelistsrch");

	// Dynamic selection lists
	// Filters

	faction_typelistsrch.filterList = <?php echo $action_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	faction_typelistsrch.initSearchPanel = true;
	loadjs.done("faction_typelistsrch");
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
<?php if (!$action_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($action_type_list->TotalRecords > 0 && $action_type_list->ExportOptions->visible()) { ?>
<?php $action_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($action_type_list->ImportOptions->visible()) { ?>
<?php $action_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($action_type_list->SearchOptions->visible()) { ?>
<?php $action_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($action_type_list->FilterOptions->visible()) { ?>
<?php $action_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$action_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$action_type_list->isExport() && !$action_type->CurrentAction) { ?>
<form name="faction_typelistsrch" id="faction_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="faction_typelistsrch-search-panel" class="<?php echo $action_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="action_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $action_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($action_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($action_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $action_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($action_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($action_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($action_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($action_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $action_type_list->showPageHeader(); ?>
<?php
$action_type_list->showMessage();
?>
<?php if ($action_type_list->TotalRecords > 0 || $action_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($action_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> action_type">
<?php if (!$action_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$action_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $action_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $action_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="faction_typelist" id="faction_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="action_type">
<div id="gmp_action_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($action_type_list->TotalRecords > 0 || $action_type_list->isGridEdit()) { ?>
<table id="tbl_action_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$action_type->RowType = ROWTYPE_HEADER;

// Render list options
$action_type_list->renderListOptions();

// Render list options (header, left)
$action_type_list->ListOptions->render("header", "left");
?>
<?php if ($action_type_list->ActionType->Visible) { // ActionType ?>
	<?php if ($action_type_list->SortUrl($action_type_list->ActionType) == "") { ?>
		<th data-name="ActionType" class="<?php echo $action_type_list->ActionType->headerCellClass() ?>"><div id="elh_action_type_ActionType" class="action_type_ActionType"><div class="ew-table-header-caption"><?php echo $action_type_list->ActionType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActionType" class="<?php echo $action_type_list->ActionType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $action_type_list->SortUrl($action_type_list->ActionType) ?>', 1);"><div id="elh_action_type_ActionType" class="action_type_ActionType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $action_type_list->ActionType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($action_type_list->ActionType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($action_type_list->ActionType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$action_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($action_type_list->ExportAll && $action_type_list->isExport()) {
	$action_type_list->StopRecord = $action_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($action_type_list->TotalRecords > $action_type_list->StartRecord + $action_type_list->DisplayRecords - 1)
		$action_type_list->StopRecord = $action_type_list->StartRecord + $action_type_list->DisplayRecords - 1;
	else
		$action_type_list->StopRecord = $action_type_list->TotalRecords;
}
$action_type_list->RecordCount = $action_type_list->StartRecord - 1;
if ($action_type_list->Recordset && !$action_type_list->Recordset->EOF) {
	$action_type_list->Recordset->moveFirst();
	$selectLimit = $action_type_list->UseSelectLimit;
	if (!$selectLimit && $action_type_list->StartRecord > 1)
		$action_type_list->Recordset->move($action_type_list->StartRecord - 1);
} elseif (!$action_type->AllowAddDeleteRow && $action_type_list->StopRecord == 0) {
	$action_type_list->StopRecord = $action_type->GridAddRowCount;
}

// Initialize aggregate
$action_type->RowType = ROWTYPE_AGGREGATEINIT;
$action_type->resetAttributes();
$action_type_list->renderRow();
while ($action_type_list->RecordCount < $action_type_list->StopRecord) {
	$action_type_list->RecordCount++;
	if ($action_type_list->RecordCount >= $action_type_list->StartRecord) {
		$action_type_list->RowCount++;

		// Set up key count
		$action_type_list->KeyCount = $action_type_list->RowIndex;

		// Init row class and style
		$action_type->resetAttributes();
		$action_type->CssClass = "";
		if ($action_type_list->isGridAdd()) {
		} else {
			$action_type_list->loadRowValues($action_type_list->Recordset); // Load row values
		}
		$action_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$action_type->RowAttrs->merge(["data-rowindex" => $action_type_list->RowCount, "id" => "r" . $action_type_list->RowCount . "_action_type", "data-rowtype" => $action_type->RowType]);

		// Render row
		$action_type_list->renderRow();

		// Render list options
		$action_type_list->renderListOptions();
?>
	<tr <?php echo $action_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$action_type_list->ListOptions->render("body", "left", $action_type_list->RowCount);
?>
	<?php if ($action_type_list->ActionType->Visible) { // ActionType ?>
		<td data-name="ActionType" <?php echo $action_type_list->ActionType->cellAttributes() ?>>
<span id="el<?php echo $action_type_list->RowCount ?>_action_type_ActionType">
<span<?php echo $action_type_list->ActionType->viewAttributes() ?>><?php echo $action_type_list->ActionType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$action_type_list->ListOptions->render("body", "right", $action_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$action_type_list->isGridAdd())
		$action_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$action_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($action_type_list->Recordset)
	$action_type_list->Recordset->Close();
?>
<?php if (!$action_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$action_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $action_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $action_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($action_type_list->TotalRecords == 0 && !$action_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $action_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$action_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$action_type_list->isExport()) { ?>
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
$action_type_list->terminate();
?>