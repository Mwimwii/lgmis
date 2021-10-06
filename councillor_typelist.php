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
$councillor_type_list = new councillor_type_list();

// Run the page
$councillor_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillor_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillor_type_list->isExport()) { ?>
<script>
var fcouncillor_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncillor_typelist = currentForm = new ew.Form("fcouncillor_typelist", "list");
	fcouncillor_typelist.formKeyCountName = '<?php echo $councillor_type_list->FormKeyCountName ?>';
	loadjs.done("fcouncillor_typelist");
});
var fcouncillor_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncillor_typelistsrch = currentSearchForm = new ew.Form("fcouncillor_typelistsrch");

	// Dynamic selection lists
	// Filters

	fcouncillor_typelistsrch.filterList = <?php echo $councillor_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncillor_typelistsrch.initSearchPanel = true;
	loadjs.done("fcouncillor_typelistsrch");
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
<?php if (!$councillor_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($councillor_type_list->TotalRecords > 0 && $councillor_type_list->ExportOptions->visible()) { ?>
<?php $councillor_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_type_list->ImportOptions->visible()) { ?>
<?php $councillor_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_type_list->SearchOptions->visible()) { ?>
<?php $councillor_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($councillor_type_list->FilterOptions->visible()) { ?>
<?php $councillor_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$councillor_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$councillor_type_list->isExport() && !$councillor_type->CurrentAction) { ?>
<form name="fcouncillor_typelistsrch" id="fcouncillor_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncillor_typelistsrch-search-panel" class="<?php echo $councillor_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="councillor_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $councillor_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($councillor_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($councillor_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $councillor_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($councillor_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($councillor_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($councillor_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($councillor_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $councillor_type_list->showPageHeader(); ?>
<?php
$councillor_type_list->showMessage();
?>
<?php if ($councillor_type_list->TotalRecords > 0 || $councillor_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillor_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillor_type">
<?php if (!$councillor_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$councillor_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillor_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncillor_typelist" id="fcouncillor_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillor_type">
<div id="gmp_councillor_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($councillor_type_list->TotalRecords > 0 || $councillor_type_list->isGridEdit()) { ?>
<table id="tbl_councillor_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillor_type->RowType = ROWTYPE_HEADER;

// Render list options
$councillor_type_list->renderListOptions();

// Render list options (header, left)
$councillor_type_list->ListOptions->render("header", "left");
?>
<?php if ($councillor_type_list->CouncillorType->Visible) { // CouncillorType ?>
	<?php if ($councillor_type_list->SortUrl($councillor_type_list->CouncillorType) == "") { ?>
		<th data-name="CouncillorType" class="<?php echo $councillor_type_list->CouncillorType->headerCellClass() ?>"><div id="elh_councillor_type_CouncillorType" class="councillor_type_CouncillorType"><div class="ew-table-header-caption"><?php echo $councillor_type_list->CouncillorType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorType" class="<?php echo $councillor_type_list->CouncillorType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_type_list->SortUrl($councillor_type_list->CouncillorType) ?>', 1);"><div id="elh_councillor_type_CouncillorType" class="councillor_type_CouncillorType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_type_list->CouncillorType->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillor_type_list->CouncillorType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_type_list->CouncillorType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillor_type_list->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
	<?php if ($councillor_type_list->SortUrl($councillor_type_list->CouncillorTYpeName) == "") { ?>
		<th data-name="CouncillorTYpeName" class="<?php echo $councillor_type_list->CouncillorTYpeName->headerCellClass() ?>"><div id="elh_councillor_type_CouncillorTYpeName" class="councillor_type_CouncillorTYpeName"><div class="ew-table-header-caption"><?php echo $councillor_type_list->CouncillorTYpeName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorTYpeName" class="<?php echo $councillor_type_list->CouncillorTYpeName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillor_type_list->SortUrl($councillor_type_list->CouncillorTYpeName) ?>', 1);"><div id="elh_councillor_type_CouncillorTYpeName" class="councillor_type_CouncillorTYpeName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillor_type_list->CouncillorTYpeName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillor_type_list->CouncillorTYpeName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillor_type_list->CouncillorTYpeName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillor_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($councillor_type_list->ExportAll && $councillor_type_list->isExport()) {
	$councillor_type_list->StopRecord = $councillor_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($councillor_type_list->TotalRecords > $councillor_type_list->StartRecord + $councillor_type_list->DisplayRecords - 1)
		$councillor_type_list->StopRecord = $councillor_type_list->StartRecord + $councillor_type_list->DisplayRecords - 1;
	else
		$councillor_type_list->StopRecord = $councillor_type_list->TotalRecords;
}
$councillor_type_list->RecordCount = $councillor_type_list->StartRecord - 1;
if ($councillor_type_list->Recordset && !$councillor_type_list->Recordset->EOF) {
	$councillor_type_list->Recordset->moveFirst();
	$selectLimit = $councillor_type_list->UseSelectLimit;
	if (!$selectLimit && $councillor_type_list->StartRecord > 1)
		$councillor_type_list->Recordset->move($councillor_type_list->StartRecord - 1);
} elseif (!$councillor_type->AllowAddDeleteRow && $councillor_type_list->StopRecord == 0) {
	$councillor_type_list->StopRecord = $councillor_type->GridAddRowCount;
}

// Initialize aggregate
$councillor_type->RowType = ROWTYPE_AGGREGATEINIT;
$councillor_type->resetAttributes();
$councillor_type_list->renderRow();
while ($councillor_type_list->RecordCount < $councillor_type_list->StopRecord) {
	$councillor_type_list->RecordCount++;
	if ($councillor_type_list->RecordCount >= $councillor_type_list->StartRecord) {
		$councillor_type_list->RowCount++;

		// Set up key count
		$councillor_type_list->KeyCount = $councillor_type_list->RowIndex;

		// Init row class and style
		$councillor_type->resetAttributes();
		$councillor_type->CssClass = "";
		if ($councillor_type_list->isGridAdd()) {
		} else {
			$councillor_type_list->loadRowValues($councillor_type_list->Recordset); // Load row values
		}
		$councillor_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$councillor_type->RowAttrs->merge(["data-rowindex" => $councillor_type_list->RowCount, "id" => "r" . $councillor_type_list->RowCount . "_councillor_type", "data-rowtype" => $councillor_type->RowType]);

		// Render row
		$councillor_type_list->renderRow();

		// Render list options
		$councillor_type_list->renderListOptions();
?>
	<tr <?php echo $councillor_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillor_type_list->ListOptions->render("body", "left", $councillor_type_list->RowCount);
?>
	<?php if ($councillor_type_list->CouncillorType->Visible) { // CouncillorType ?>
		<td data-name="CouncillorType" <?php echo $councillor_type_list->CouncillorType->cellAttributes() ?>>
<span id="el<?php echo $councillor_type_list->RowCount ?>_councillor_type_CouncillorType">
<span<?php echo $councillor_type_list->CouncillorType->viewAttributes() ?>><?php echo $councillor_type_list->CouncillorType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillor_type_list->CouncillorTYpeName->Visible) { // CouncillorTYpeName ?>
		<td data-name="CouncillorTYpeName" <?php echo $councillor_type_list->CouncillorTYpeName->cellAttributes() ?>>
<span id="el<?php echo $councillor_type_list->RowCount ?>_councillor_type_CouncillorTYpeName">
<span<?php echo $councillor_type_list->CouncillorTYpeName->viewAttributes() ?>><?php echo $councillor_type_list->CouncillorTYpeName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillor_type_list->ListOptions->render("body", "right", $councillor_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$councillor_type_list->isGridAdd())
		$councillor_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$councillor_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillor_type_list->Recordset)
	$councillor_type_list->Recordset->Close();
?>
<?php if (!$councillor_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$councillor_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillor_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillor_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillor_type_list->TotalRecords == 0 && !$councillor_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillor_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$councillor_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillor_type_list->isExport()) { ?>
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
$councillor_type_list->terminate();
?>