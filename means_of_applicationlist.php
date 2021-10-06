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
$means_of_application_list = new means_of_application_list();

// Run the page
$means_of_application_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$means_of_application_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$means_of_application_list->isExport()) { ?>
<script>
var fmeans_of_applicationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmeans_of_applicationlist = currentForm = new ew.Form("fmeans_of_applicationlist", "list");
	fmeans_of_applicationlist.formKeyCountName = '<?php echo $means_of_application_list->FormKeyCountName ?>';
	loadjs.done("fmeans_of_applicationlist");
});
var fmeans_of_applicationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmeans_of_applicationlistsrch = currentSearchForm = new ew.Form("fmeans_of_applicationlistsrch");

	// Dynamic selection lists
	// Filters

	fmeans_of_applicationlistsrch.filterList = <?php echo $means_of_application_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmeans_of_applicationlistsrch.initSearchPanel = true;
	loadjs.done("fmeans_of_applicationlistsrch");
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
<?php if (!$means_of_application_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($means_of_application_list->TotalRecords > 0 && $means_of_application_list->ExportOptions->visible()) { ?>
<?php $means_of_application_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($means_of_application_list->ImportOptions->visible()) { ?>
<?php $means_of_application_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($means_of_application_list->SearchOptions->visible()) { ?>
<?php $means_of_application_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($means_of_application_list->FilterOptions->visible()) { ?>
<?php $means_of_application_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$means_of_application_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$means_of_application_list->isExport() && !$means_of_application->CurrentAction) { ?>
<form name="fmeans_of_applicationlistsrch" id="fmeans_of_applicationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmeans_of_applicationlistsrch-search-panel" class="<?php echo $means_of_application_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="means_of_application">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $means_of_application_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($means_of_application_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($means_of_application_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $means_of_application_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($means_of_application_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($means_of_application_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($means_of_application_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($means_of_application_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $means_of_application_list->showPageHeader(); ?>
<?php
$means_of_application_list->showMessage();
?>
<?php if ($means_of_application_list->TotalRecords > 0 || $means_of_application->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($means_of_application_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> means_of_application">
<?php if (!$means_of_application_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$means_of_application_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $means_of_application_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $means_of_application_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmeans_of_applicationlist" id="fmeans_of_applicationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="means_of_application">
<div id="gmp_means_of_application" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($means_of_application_list->TotalRecords > 0 || $means_of_application_list->isGridEdit()) { ?>
<table id="tbl_means_of_applicationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$means_of_application->RowType = ROWTYPE_HEADER;

// Render list options
$means_of_application_list->renderListOptions();

// Render list options (header, left)
$means_of_application_list->ListOptions->render("header", "left");
?>
<?php if ($means_of_application_list->ChoiceCode->Visible) { // ChoiceCode ?>
	<?php if ($means_of_application_list->SortUrl($means_of_application_list->ChoiceCode) == "") { ?>
		<th data-name="ChoiceCode" class="<?php echo $means_of_application_list->ChoiceCode->headerCellClass() ?>"><div id="elh_means_of_application_ChoiceCode" class="means_of_application_ChoiceCode"><div class="ew-table-header-caption"><?php echo $means_of_application_list->ChoiceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChoiceCode" class="<?php echo $means_of_application_list->ChoiceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $means_of_application_list->SortUrl($means_of_application_list->ChoiceCode) ?>', 1);"><div id="elh_means_of_application_ChoiceCode" class="means_of_application_ChoiceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $means_of_application_list->ChoiceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($means_of_application_list->ChoiceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($means_of_application_list->ChoiceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($means_of_application_list->Application->Visible) { // Application ?>
	<?php if ($means_of_application_list->SortUrl($means_of_application_list->Application) == "") { ?>
		<th data-name="Application" class="<?php echo $means_of_application_list->Application->headerCellClass() ?>"><div id="elh_means_of_application_Application" class="means_of_application_Application"><div class="ew-table-header-caption"><?php echo $means_of_application_list->Application->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Application" class="<?php echo $means_of_application_list->Application->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $means_of_application_list->SortUrl($means_of_application_list->Application) ?>', 1);"><div id="elh_means_of_application_Application" class="means_of_application_Application">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $means_of_application_list->Application->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($means_of_application_list->Application->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($means_of_application_list->Application->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$means_of_application_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($means_of_application_list->ExportAll && $means_of_application_list->isExport()) {
	$means_of_application_list->StopRecord = $means_of_application_list->TotalRecords;
} else {

	// Set the last record to display
	if ($means_of_application_list->TotalRecords > $means_of_application_list->StartRecord + $means_of_application_list->DisplayRecords - 1)
		$means_of_application_list->StopRecord = $means_of_application_list->StartRecord + $means_of_application_list->DisplayRecords - 1;
	else
		$means_of_application_list->StopRecord = $means_of_application_list->TotalRecords;
}
$means_of_application_list->RecordCount = $means_of_application_list->StartRecord - 1;
if ($means_of_application_list->Recordset && !$means_of_application_list->Recordset->EOF) {
	$means_of_application_list->Recordset->moveFirst();
	$selectLimit = $means_of_application_list->UseSelectLimit;
	if (!$selectLimit && $means_of_application_list->StartRecord > 1)
		$means_of_application_list->Recordset->move($means_of_application_list->StartRecord - 1);
} elseif (!$means_of_application->AllowAddDeleteRow && $means_of_application_list->StopRecord == 0) {
	$means_of_application_list->StopRecord = $means_of_application->GridAddRowCount;
}

// Initialize aggregate
$means_of_application->RowType = ROWTYPE_AGGREGATEINIT;
$means_of_application->resetAttributes();
$means_of_application_list->renderRow();
while ($means_of_application_list->RecordCount < $means_of_application_list->StopRecord) {
	$means_of_application_list->RecordCount++;
	if ($means_of_application_list->RecordCount >= $means_of_application_list->StartRecord) {
		$means_of_application_list->RowCount++;

		// Set up key count
		$means_of_application_list->KeyCount = $means_of_application_list->RowIndex;

		// Init row class and style
		$means_of_application->resetAttributes();
		$means_of_application->CssClass = "";
		if ($means_of_application_list->isGridAdd()) {
		} else {
			$means_of_application_list->loadRowValues($means_of_application_list->Recordset); // Load row values
		}
		$means_of_application->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$means_of_application->RowAttrs->merge(["data-rowindex" => $means_of_application_list->RowCount, "id" => "r" . $means_of_application_list->RowCount . "_means_of_application", "data-rowtype" => $means_of_application->RowType]);

		// Render row
		$means_of_application_list->renderRow();

		// Render list options
		$means_of_application_list->renderListOptions();
?>
	<tr <?php echo $means_of_application->rowAttributes() ?>>
<?php

// Render list options (body, left)
$means_of_application_list->ListOptions->render("body", "left", $means_of_application_list->RowCount);
?>
	<?php if ($means_of_application_list->ChoiceCode->Visible) { // ChoiceCode ?>
		<td data-name="ChoiceCode" <?php echo $means_of_application_list->ChoiceCode->cellAttributes() ?>>
<span id="el<?php echo $means_of_application_list->RowCount ?>_means_of_application_ChoiceCode">
<span<?php echo $means_of_application_list->ChoiceCode->viewAttributes() ?>><?php echo $means_of_application_list->ChoiceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($means_of_application_list->Application->Visible) { // Application ?>
		<td data-name="Application" <?php echo $means_of_application_list->Application->cellAttributes() ?>>
<span id="el<?php echo $means_of_application_list->RowCount ?>_means_of_application_Application">
<span<?php echo $means_of_application_list->Application->viewAttributes() ?>><?php echo $means_of_application_list->Application->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$means_of_application_list->ListOptions->render("body", "right", $means_of_application_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$means_of_application_list->isGridAdd())
		$means_of_application_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$means_of_application->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($means_of_application_list->Recordset)
	$means_of_application_list->Recordset->Close();
?>
<?php if (!$means_of_application_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$means_of_application_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $means_of_application_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $means_of_application_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($means_of_application_list->TotalRecords == 0 && !$means_of_application->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $means_of_application_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$means_of_application_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$means_of_application_list->isExport()) { ?>
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
$means_of_application_list->terminate();
?>