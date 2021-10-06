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
$physical_challenge_list = new physical_challenge_list();

// Run the page
$physical_challenge_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$physical_challenge_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$physical_challenge_list->isExport()) { ?>
<script>
var fphysical_challengelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fphysical_challengelist = currentForm = new ew.Form("fphysical_challengelist", "list");
	fphysical_challengelist.formKeyCountName = '<?php echo $physical_challenge_list->FormKeyCountName ?>';
	loadjs.done("fphysical_challengelist");
});
var fphysical_challengelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fphysical_challengelistsrch = currentSearchForm = new ew.Form("fphysical_challengelistsrch");

	// Dynamic selection lists
	// Filters

	fphysical_challengelistsrch.filterList = <?php echo $physical_challenge_list->getFilterList() ?>;

	// Init search panel as collapsed
	fphysical_challengelistsrch.initSearchPanel = true;
	loadjs.done("fphysical_challengelistsrch");
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
<?php if (!$physical_challenge_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($physical_challenge_list->TotalRecords > 0 && $physical_challenge_list->ExportOptions->visible()) { ?>
<?php $physical_challenge_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($physical_challenge_list->ImportOptions->visible()) { ?>
<?php $physical_challenge_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($physical_challenge_list->SearchOptions->visible()) { ?>
<?php $physical_challenge_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($physical_challenge_list->FilterOptions->visible()) { ?>
<?php $physical_challenge_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$physical_challenge_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$physical_challenge_list->isExport() && !$physical_challenge->CurrentAction) { ?>
<form name="fphysical_challengelistsrch" id="fphysical_challengelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fphysical_challengelistsrch-search-panel" class="<?php echo $physical_challenge_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="physical_challenge">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $physical_challenge_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($physical_challenge_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($physical_challenge_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $physical_challenge_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($physical_challenge_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($physical_challenge_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($physical_challenge_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($physical_challenge_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $physical_challenge_list->showPageHeader(); ?>
<?php
$physical_challenge_list->showMessage();
?>
<?php if ($physical_challenge_list->TotalRecords > 0 || $physical_challenge->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($physical_challenge_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> physical_challenge">
<?php if (!$physical_challenge_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$physical_challenge_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $physical_challenge_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $physical_challenge_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fphysical_challengelist" id="fphysical_challengelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="physical_challenge">
<div id="gmp_physical_challenge" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($physical_challenge_list->TotalRecords > 0 || $physical_challenge_list->isGridEdit()) { ?>
<table id="tbl_physical_challengelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$physical_challenge->RowType = ROWTYPE_HEADER;

// Render list options
$physical_challenge_list->renderListOptions();

// Render list options (header, left)
$physical_challenge_list->ListOptions->render("header", "left");
?>
<?php if ($physical_challenge_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
	<?php if ($physical_challenge_list->SortUrl($physical_challenge_list->PhysicalChallenge) == "") { ?>
		<th data-name="PhysicalChallenge" class="<?php echo $physical_challenge_list->PhysicalChallenge->headerCellClass() ?>"><div id="elh_physical_challenge_PhysicalChallenge" class="physical_challenge_PhysicalChallenge"><div class="ew-table-header-caption"><?php echo $physical_challenge_list->PhysicalChallenge->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalChallenge" class="<?php echo $physical_challenge_list->PhysicalChallenge->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $physical_challenge_list->SortUrl($physical_challenge_list->PhysicalChallenge) ?>', 1);"><div id="elh_physical_challenge_PhysicalChallenge" class="physical_challenge_PhysicalChallenge">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $physical_challenge_list->PhysicalChallenge->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($physical_challenge_list->PhysicalChallenge->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($physical_challenge_list->PhysicalChallenge->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$physical_challenge_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($physical_challenge_list->ExportAll && $physical_challenge_list->isExport()) {
	$physical_challenge_list->StopRecord = $physical_challenge_list->TotalRecords;
} else {

	// Set the last record to display
	if ($physical_challenge_list->TotalRecords > $physical_challenge_list->StartRecord + $physical_challenge_list->DisplayRecords - 1)
		$physical_challenge_list->StopRecord = $physical_challenge_list->StartRecord + $physical_challenge_list->DisplayRecords - 1;
	else
		$physical_challenge_list->StopRecord = $physical_challenge_list->TotalRecords;
}
$physical_challenge_list->RecordCount = $physical_challenge_list->StartRecord - 1;
if ($physical_challenge_list->Recordset && !$physical_challenge_list->Recordset->EOF) {
	$physical_challenge_list->Recordset->moveFirst();
	$selectLimit = $physical_challenge_list->UseSelectLimit;
	if (!$selectLimit && $physical_challenge_list->StartRecord > 1)
		$physical_challenge_list->Recordset->move($physical_challenge_list->StartRecord - 1);
} elseif (!$physical_challenge->AllowAddDeleteRow && $physical_challenge_list->StopRecord == 0) {
	$physical_challenge_list->StopRecord = $physical_challenge->GridAddRowCount;
}

// Initialize aggregate
$physical_challenge->RowType = ROWTYPE_AGGREGATEINIT;
$physical_challenge->resetAttributes();
$physical_challenge_list->renderRow();
while ($physical_challenge_list->RecordCount < $physical_challenge_list->StopRecord) {
	$physical_challenge_list->RecordCount++;
	if ($physical_challenge_list->RecordCount >= $physical_challenge_list->StartRecord) {
		$physical_challenge_list->RowCount++;

		// Set up key count
		$physical_challenge_list->KeyCount = $physical_challenge_list->RowIndex;

		// Init row class and style
		$physical_challenge->resetAttributes();
		$physical_challenge->CssClass = "";
		if ($physical_challenge_list->isGridAdd()) {
		} else {
			$physical_challenge_list->loadRowValues($physical_challenge_list->Recordset); // Load row values
		}
		$physical_challenge->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$physical_challenge->RowAttrs->merge(["data-rowindex" => $physical_challenge_list->RowCount, "id" => "r" . $physical_challenge_list->RowCount . "_physical_challenge", "data-rowtype" => $physical_challenge->RowType]);

		// Render row
		$physical_challenge_list->renderRow();

		// Render list options
		$physical_challenge_list->renderListOptions();
?>
	<tr <?php echo $physical_challenge->rowAttributes() ?>>
<?php

// Render list options (body, left)
$physical_challenge_list->ListOptions->render("body", "left", $physical_challenge_list->RowCount);
?>
	<?php if ($physical_challenge_list->PhysicalChallenge->Visible) { // PhysicalChallenge ?>
		<td data-name="PhysicalChallenge" <?php echo $physical_challenge_list->PhysicalChallenge->cellAttributes() ?>>
<span id="el<?php echo $physical_challenge_list->RowCount ?>_physical_challenge_PhysicalChallenge">
<span<?php echo $physical_challenge_list->PhysicalChallenge->viewAttributes() ?>><?php echo $physical_challenge_list->PhysicalChallenge->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$physical_challenge_list->ListOptions->render("body", "right", $physical_challenge_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$physical_challenge_list->isGridAdd())
		$physical_challenge_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$physical_challenge->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($physical_challenge_list->Recordset)
	$physical_challenge_list->Recordset->Close();
?>
<?php if (!$physical_challenge_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$physical_challenge_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $physical_challenge_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $physical_challenge_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($physical_challenge_list->TotalRecords == 0 && !$physical_challenge->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $physical_challenge_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$physical_challenge_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$physical_challenge_list->isExport()) { ?>
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
$physical_challenge_list->terminate();
?>