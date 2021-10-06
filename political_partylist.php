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
$political_party_list = new political_party_list();

// Run the page
$political_party_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$political_party_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$political_party_list->isExport()) { ?>
<script>
var fpolitical_partylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpolitical_partylist = currentForm = new ew.Form("fpolitical_partylist", "list");
	fpolitical_partylist.formKeyCountName = '<?php echo $political_party_list->FormKeyCountName ?>';
	loadjs.done("fpolitical_partylist");
});
var fpolitical_partylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpolitical_partylistsrch = currentSearchForm = new ew.Form("fpolitical_partylistsrch");

	// Dynamic selection lists
	// Filters

	fpolitical_partylistsrch.filterList = <?php echo $political_party_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpolitical_partylistsrch.initSearchPanel = true;
	loadjs.done("fpolitical_partylistsrch");
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
<?php if (!$political_party_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($political_party_list->TotalRecords > 0 && $political_party_list->ExportOptions->visible()) { ?>
<?php $political_party_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($political_party_list->ImportOptions->visible()) { ?>
<?php $political_party_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($political_party_list->SearchOptions->visible()) { ?>
<?php $political_party_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($political_party_list->FilterOptions->visible()) { ?>
<?php $political_party_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$political_party_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$political_party_list->isExport() && !$political_party->CurrentAction) { ?>
<form name="fpolitical_partylistsrch" id="fpolitical_partylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpolitical_partylistsrch-search-panel" class="<?php echo $political_party_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="political_party">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $political_party_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($political_party_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($political_party_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $political_party_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($political_party_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($political_party_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($political_party_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($political_party_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $political_party_list->showPageHeader(); ?>
<?php
$political_party_list->showMessage();
?>
<?php if ($political_party_list->TotalRecords > 0 || $political_party->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($political_party_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> political_party">
<?php if (!$political_party_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$political_party_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $political_party_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $political_party_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpolitical_partylist" id="fpolitical_partylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="political_party">
<div id="gmp_political_party" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($political_party_list->TotalRecords > 0 || $political_party_list->isGridEdit()) { ?>
<table id="tbl_political_partylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$political_party->RowType = ROWTYPE_HEADER;

// Render list options
$political_party_list->renderListOptions();

// Render list options (header, left)
$political_party_list->ListOptions->render("header", "left");
?>
<?php if ($political_party_list->PoliticalParty->Visible) { // PoliticalParty ?>
	<?php if ($political_party_list->SortUrl($political_party_list->PoliticalParty) == "") { ?>
		<th data-name="PoliticalParty" class="<?php echo $political_party_list->PoliticalParty->headerCellClass() ?>"><div id="elh_political_party_PoliticalParty" class="political_party_PoliticalParty"><div class="ew-table-header-caption"><?php echo $political_party_list->PoliticalParty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PoliticalParty" class="<?php echo $political_party_list->PoliticalParty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $political_party_list->SortUrl($political_party_list->PoliticalParty) ?>', 1);"><div id="elh_political_party_PoliticalParty" class="political_party_PoliticalParty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $political_party_list->PoliticalParty->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($political_party_list->PoliticalParty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($political_party_list->PoliticalParty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($political_party_list->Remarks->Visible) { // Remarks ?>
	<?php if ($political_party_list->SortUrl($political_party_list->Remarks) == "") { ?>
		<th data-name="Remarks" class="<?php echo $political_party_list->Remarks->headerCellClass() ?>"><div id="elh_political_party_Remarks" class="political_party_Remarks"><div class="ew-table-header-caption"><?php echo $political_party_list->Remarks->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remarks" class="<?php echo $political_party_list->Remarks->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $political_party_list->SortUrl($political_party_list->Remarks) ?>', 1);"><div id="elh_political_party_Remarks" class="political_party_Remarks">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $political_party_list->Remarks->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($political_party_list->Remarks->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($political_party_list->Remarks->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$political_party_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($political_party_list->ExportAll && $political_party_list->isExport()) {
	$political_party_list->StopRecord = $political_party_list->TotalRecords;
} else {

	// Set the last record to display
	if ($political_party_list->TotalRecords > $political_party_list->StartRecord + $political_party_list->DisplayRecords - 1)
		$political_party_list->StopRecord = $political_party_list->StartRecord + $political_party_list->DisplayRecords - 1;
	else
		$political_party_list->StopRecord = $political_party_list->TotalRecords;
}
$political_party_list->RecordCount = $political_party_list->StartRecord - 1;
if ($political_party_list->Recordset && !$political_party_list->Recordset->EOF) {
	$political_party_list->Recordset->moveFirst();
	$selectLimit = $political_party_list->UseSelectLimit;
	if (!$selectLimit && $political_party_list->StartRecord > 1)
		$political_party_list->Recordset->move($political_party_list->StartRecord - 1);
} elseif (!$political_party->AllowAddDeleteRow && $political_party_list->StopRecord == 0) {
	$political_party_list->StopRecord = $political_party->GridAddRowCount;
}

// Initialize aggregate
$political_party->RowType = ROWTYPE_AGGREGATEINIT;
$political_party->resetAttributes();
$political_party_list->renderRow();
while ($political_party_list->RecordCount < $political_party_list->StopRecord) {
	$political_party_list->RecordCount++;
	if ($political_party_list->RecordCount >= $political_party_list->StartRecord) {
		$political_party_list->RowCount++;

		// Set up key count
		$political_party_list->KeyCount = $political_party_list->RowIndex;

		// Init row class and style
		$political_party->resetAttributes();
		$political_party->CssClass = "";
		if ($political_party_list->isGridAdd()) {
		} else {
			$political_party_list->loadRowValues($political_party_list->Recordset); // Load row values
		}
		$political_party->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$political_party->RowAttrs->merge(["data-rowindex" => $political_party_list->RowCount, "id" => "r" . $political_party_list->RowCount . "_political_party", "data-rowtype" => $political_party->RowType]);

		// Render row
		$political_party_list->renderRow();

		// Render list options
		$political_party_list->renderListOptions();
?>
	<tr <?php echo $political_party->rowAttributes() ?>>
<?php

// Render list options (body, left)
$political_party_list->ListOptions->render("body", "left", $political_party_list->RowCount);
?>
	<?php if ($political_party_list->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty" <?php echo $political_party_list->PoliticalParty->cellAttributes() ?>>
<span id="el<?php echo $political_party_list->RowCount ?>_political_party_PoliticalParty">
<span<?php echo $political_party_list->PoliticalParty->viewAttributes() ?>><?php echo $political_party_list->PoliticalParty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($political_party_list->Remarks->Visible) { // Remarks ?>
		<td data-name="Remarks" <?php echo $political_party_list->Remarks->cellAttributes() ?>>
<span id="el<?php echo $political_party_list->RowCount ?>_political_party_Remarks">
<span<?php echo $political_party_list->Remarks->viewAttributes() ?>><?php echo $political_party_list->Remarks->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$political_party_list->ListOptions->render("body", "right", $political_party_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$political_party_list->isGridAdd())
		$political_party_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$political_party->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($political_party_list->Recordset)
	$political_party_list->Recordset->Close();
?>
<?php if (!$political_party_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$political_party_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $political_party_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $political_party_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($political_party_list->TotalRecords == 0 && !$political_party->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $political_party_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$political_party_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$political_party_list->isExport()) { ?>
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
$political_party_list->terminate();
?>