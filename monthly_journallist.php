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
$monthly_journal_list = new monthly_journal_list();

// Run the page
$monthly_journal_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$monthly_journal_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$monthly_journal_list->isExport()) { ?>
<script>
var fmonthly_journallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmonthly_journallist = currentForm = new ew.Form("fmonthly_journallist", "list");
	fmonthly_journallist.formKeyCountName = '<?php echo $monthly_journal_list->FormKeyCountName ?>';
	loadjs.done("fmonthly_journallist");
});
var fmonthly_journallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmonthly_journallistsrch = currentSearchForm = new ew.Form("fmonthly_journallistsrch");

	// Dynamic selection lists
	// Filters

	fmonthly_journallistsrch.filterList = <?php echo $monthly_journal_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmonthly_journallistsrch.initSearchPanel = true;
	loadjs.done("fmonthly_journallistsrch");
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
<?php if (!$monthly_journal_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($monthly_journal_list->TotalRecords > 0 && $monthly_journal_list->ExportOptions->visible()) { ?>
<?php $monthly_journal_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_journal_list->ImportOptions->visible()) { ?>
<?php $monthly_journal_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_journal_list->SearchOptions->visible()) { ?>
<?php $monthly_journal_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($monthly_journal_list->FilterOptions->visible()) { ?>
<?php $monthly_journal_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$monthly_journal_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$monthly_journal_list->isExport() && !$monthly_journal->CurrentAction) { ?>
<form name="fmonthly_journallistsrch" id="fmonthly_journallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmonthly_journallistsrch-search-panel" class="<?php echo $monthly_journal_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="monthly_journal">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $monthly_journal_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($monthly_journal_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($monthly_journal_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $monthly_journal_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($monthly_journal_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($monthly_journal_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($monthly_journal_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($monthly_journal_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $monthly_journal_list->showPageHeader(); ?>
<?php
$monthly_journal_list->showMessage();
?>
<?php if ($monthly_journal_list->TotalRecords > 0 || $monthly_journal->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($monthly_journal_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> monthly_journal">
<?php if (!$monthly_journal_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$monthly_journal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_journal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $monthly_journal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmonthly_journallist" id="fmonthly_journallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="monthly_journal">
<div id="gmp_monthly_journal" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($monthly_journal_list->TotalRecords > 0 || $monthly_journal_list->isGridEdit()) { ?>
<table id="tbl_monthly_journallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$monthly_journal->RowType = ROWTYPE_HEADER;

// Render list options
$monthly_journal_list->renderListOptions();

// Render list options (header, left)
$monthly_journal_list->ListOptions->render("header", "left");
?>
<?php if ($monthly_journal_list->CREDIT->Visible) { // CREDIT ?>
	<?php if ($monthly_journal_list->SortUrl($monthly_journal_list->CREDIT) == "") { ?>
		<th data-name="CREDIT" class="<?php echo $monthly_journal_list->CREDIT->headerCellClass() ?>"><div id="elh_monthly_journal_CREDIT" class="monthly_journal_CREDIT"><div class="ew-table-header-caption"><?php echo $monthly_journal_list->CREDIT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CREDIT" class="<?php echo $monthly_journal_list->CREDIT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_journal_list->SortUrl($monthly_journal_list->CREDIT) ?>', 1);"><div id="elh_monthly_journal_CREDIT" class="monthly_journal_CREDIT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_journal_list->CREDIT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_journal_list->CREDIT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_journal_list->CREDIT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_journal_list->DEBIT->Visible) { // DEBIT ?>
	<?php if ($monthly_journal_list->SortUrl($monthly_journal_list->DEBIT) == "") { ?>
		<th data-name="DEBIT" class="<?php echo $monthly_journal_list->DEBIT->headerCellClass() ?>"><div id="elh_monthly_journal_DEBIT" class="monthly_journal_DEBIT"><div class="ew-table-header-caption"><?php echo $monthly_journal_list->DEBIT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DEBIT" class="<?php echo $monthly_journal_list->DEBIT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_journal_list->SortUrl($monthly_journal_list->DEBIT) ?>', 1);"><div id="elh_monthly_journal_DEBIT" class="monthly_journal_DEBIT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_journal_list->DEBIT->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_journal_list->DEBIT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_journal_list->DEBIT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($monthly_journal_list->_->Visible) { // - ?>
	<?php if ($monthly_journal_list->SortUrl($monthly_journal_list->_) == "") { ?>
		<th data-name="_" class="<?php echo $monthly_journal_list->_->headerCellClass() ?>"><div id="elh_monthly_journal__" class="monthly_journal__"><div class="ew-table-header-caption"><?php echo $monthly_journal_list->_->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_" class="<?php echo $monthly_journal_list->_->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $monthly_journal_list->SortUrl($monthly_journal_list->_) ?>', 1);"><div id="elh_monthly_journal__" class="monthly_journal__">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $monthly_journal_list->_->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($monthly_journal_list->_->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($monthly_journal_list->_->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$monthly_journal_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($monthly_journal_list->ExportAll && $monthly_journal_list->isExport()) {
	$monthly_journal_list->StopRecord = $monthly_journal_list->TotalRecords;
} else {

	// Set the last record to display
	if ($monthly_journal_list->TotalRecords > $monthly_journal_list->StartRecord + $monthly_journal_list->DisplayRecords - 1)
		$monthly_journal_list->StopRecord = $monthly_journal_list->StartRecord + $monthly_journal_list->DisplayRecords - 1;
	else
		$monthly_journal_list->StopRecord = $monthly_journal_list->TotalRecords;
}
$monthly_journal_list->RecordCount = $monthly_journal_list->StartRecord - 1;
if ($monthly_journal_list->Recordset && !$monthly_journal_list->Recordset->EOF) {
	$monthly_journal_list->Recordset->moveFirst();
	$selectLimit = $monthly_journal_list->UseSelectLimit;
	if (!$selectLimit && $monthly_journal_list->StartRecord > 1)
		$monthly_journal_list->Recordset->move($monthly_journal_list->StartRecord - 1);
} elseif (!$monthly_journal->AllowAddDeleteRow && $monthly_journal_list->StopRecord == 0) {
	$monthly_journal_list->StopRecord = $monthly_journal->GridAddRowCount;
}

// Initialize aggregate
$monthly_journal->RowType = ROWTYPE_AGGREGATEINIT;
$monthly_journal->resetAttributes();
$monthly_journal_list->renderRow();
while ($monthly_journal_list->RecordCount < $monthly_journal_list->StopRecord) {
	$monthly_journal_list->RecordCount++;
	if ($monthly_journal_list->RecordCount >= $monthly_journal_list->StartRecord) {
		$monthly_journal_list->RowCount++;

		// Set up key count
		$monthly_journal_list->KeyCount = $monthly_journal_list->RowIndex;

		// Init row class and style
		$monthly_journal->resetAttributes();
		$monthly_journal->CssClass = "";
		if ($monthly_journal_list->isGridAdd()) {
		} else {
			$monthly_journal_list->loadRowValues($monthly_journal_list->Recordset); // Load row values
		}
		$monthly_journal->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$monthly_journal->RowAttrs->merge(["data-rowindex" => $monthly_journal_list->RowCount, "id" => "r" . $monthly_journal_list->RowCount . "_monthly_journal", "data-rowtype" => $monthly_journal->RowType]);

		// Render row
		$monthly_journal_list->renderRow();

		// Render list options
		$monthly_journal_list->renderListOptions();
?>
	<tr <?php echo $monthly_journal->rowAttributes() ?>>
<?php

// Render list options (body, left)
$monthly_journal_list->ListOptions->render("body", "left", $monthly_journal_list->RowCount);
?>
	<?php if ($monthly_journal_list->CREDIT->Visible) { // CREDIT ?>
		<td data-name="CREDIT" <?php echo $monthly_journal_list->CREDIT->cellAttributes() ?>>
<span id="el<?php echo $monthly_journal_list->RowCount ?>_monthly_journal_CREDIT">
<span<?php echo $monthly_journal_list->CREDIT->viewAttributes() ?>><?php echo $monthly_journal_list->CREDIT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_journal_list->DEBIT->Visible) { // DEBIT ?>
		<td data-name="DEBIT" <?php echo $monthly_journal_list->DEBIT->cellAttributes() ?>>
<span id="el<?php echo $monthly_journal_list->RowCount ?>_monthly_journal_DEBIT">
<span<?php echo $monthly_journal_list->DEBIT->viewAttributes() ?>><?php echo $monthly_journal_list->DEBIT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($monthly_journal_list->_->Visible) { // - ?>
		<td data-name="_" <?php echo $monthly_journal_list->_->cellAttributes() ?>>
<span id="el<?php echo $monthly_journal_list->RowCount ?>_monthly_journal__">
<span<?php echo $monthly_journal_list->_->viewAttributes() ?>><?php echo $monthly_journal_list->_->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$monthly_journal_list->ListOptions->render("body", "right", $monthly_journal_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$monthly_journal_list->isGridAdd())
		$monthly_journal_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$monthly_journal->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($monthly_journal_list->Recordset)
	$monthly_journal_list->Recordset->Close();
?>
<?php if (!$monthly_journal_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$monthly_journal_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $monthly_journal_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $monthly_journal_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($monthly_journal_list->TotalRecords == 0 && !$monthly_journal->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $monthly_journal_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$monthly_journal_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$monthly_journal_list->isExport()) { ?>
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
$monthly_journal_list->terminate();
?>