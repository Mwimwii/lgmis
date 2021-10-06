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
$moim_account_list = new moim_account_list();

// Run the page
$moim_account_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$moim_account_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$moim_account_list->isExport()) { ?>
<script>
var fmoim_accountlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmoim_accountlist = currentForm = new ew.Form("fmoim_accountlist", "list");
	fmoim_accountlist.formKeyCountName = '<?php echo $moim_account_list->FormKeyCountName ?>';
	loadjs.done("fmoim_accountlist");
});
var fmoim_accountlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmoim_accountlistsrch = currentSearchForm = new ew.Form("fmoim_accountlistsrch");

	// Dynamic selection lists
	// Filters

	fmoim_accountlistsrch.filterList = <?php echo $moim_account_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmoim_accountlistsrch.initSearchPanel = true;
	loadjs.done("fmoim_accountlistsrch");
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
<?php if (!$moim_account_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($moim_account_list->TotalRecords > 0 && $moim_account_list->ExportOptions->visible()) { ?>
<?php $moim_account_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($moim_account_list->ImportOptions->visible()) { ?>
<?php $moim_account_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($moim_account_list->SearchOptions->visible()) { ?>
<?php $moim_account_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($moim_account_list->FilterOptions->visible()) { ?>
<?php $moim_account_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$moim_account_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$moim_account_list->isExport() && !$moim_account->CurrentAction) { ?>
<form name="fmoim_accountlistsrch" id="fmoim_accountlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmoim_accountlistsrch-search-panel" class="<?php echo $moim_account_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="moim_account">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $moim_account_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($moim_account_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($moim_account_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $moim_account_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($moim_account_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($moim_account_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($moim_account_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($moim_account_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $moim_account_list->showPageHeader(); ?>
<?php
$moim_account_list->showMessage();
?>
<?php if ($moim_account_list->TotalRecords > 0 || $moim_account->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($moim_account_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> moim_account">
<?php if (!$moim_account_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$moim_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $moim_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $moim_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmoim_accountlist" id="fmoim_accountlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="moim_account">
<div id="gmp_moim_account" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($moim_account_list->TotalRecords > 0 || $moim_account_list->isGridEdit()) { ?>
<table id="tbl_moim_accountlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$moim_account->RowType = ROWTYPE_HEADER;

// Render list options
$moim_account_list->renderListOptions();

// Render list options (header, left)
$moim_account_list->ListOptions->render("header", "left");
?>
<?php if ($moim_account_list->moim_code->Visible) { // moim_code ?>
	<?php if ($moim_account_list->SortUrl($moim_account_list->moim_code) == "") { ?>
		<th data-name="moim_code" class="<?php echo $moim_account_list->moim_code->headerCellClass() ?>"><div id="elh_moim_account_moim_code" class="moim_account_moim_code"><div class="ew-table-header-caption"><?php echo $moim_account_list->moim_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="moim_code" class="<?php echo $moim_account_list->moim_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $moim_account_list->SortUrl($moim_account_list->moim_code) ?>', 1);"><div id="elh_moim_account_moim_code" class="moim_account_moim_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $moim_account_list->moim_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($moim_account_list->moim_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($moim_account_list->moim_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($moim_account_list->moim_name->Visible) { // moim_name ?>
	<?php if ($moim_account_list->SortUrl($moim_account_list->moim_name) == "") { ?>
		<th data-name="moim_name" class="<?php echo $moim_account_list->moim_name->headerCellClass() ?>"><div id="elh_moim_account_moim_name" class="moim_account_moim_name"><div class="ew-table-header-caption"><?php echo $moim_account_list->moim_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="moim_name" class="<?php echo $moim_account_list->moim_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $moim_account_list->SortUrl($moim_account_list->moim_name) ?>', 1);"><div id="elh_moim_account_moim_name" class="moim_account_moim_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $moim_account_list->moim_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($moim_account_list->moim_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($moim_account_list->moim_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($moim_account_list->account_code->Visible) { // account_code ?>
	<?php if ($moim_account_list->SortUrl($moim_account_list->account_code) == "") { ?>
		<th data-name="account_code" class="<?php echo $moim_account_list->account_code->headerCellClass() ?>"><div id="elh_moim_account_account_code" class="moim_account_account_code"><div class="ew-table-header-caption"><?php echo $moim_account_list->account_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="account_code" class="<?php echo $moim_account_list->account_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $moim_account_list->SortUrl($moim_account_list->account_code) ?>', 1);"><div id="elh_moim_account_account_code" class="moim_account_account_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $moim_account_list->account_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($moim_account_list->account_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($moim_account_list->account_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($moim_account_list->account_name->Visible) { // account_name ?>
	<?php if ($moim_account_list->SortUrl($moim_account_list->account_name) == "") { ?>
		<th data-name="account_name" class="<?php echo $moim_account_list->account_name->headerCellClass() ?>"><div id="elh_moim_account_account_name" class="moim_account_account_name"><div class="ew-table-header-caption"><?php echo $moim_account_list->account_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="account_name" class="<?php echo $moim_account_list->account_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $moim_account_list->SortUrl($moim_account_list->account_name) ?>', 1);"><div id="elh_moim_account_account_name" class="moim_account_account_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $moim_account_list->account_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($moim_account_list->account_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($moim_account_list->account_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$moim_account_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($moim_account_list->ExportAll && $moim_account_list->isExport()) {
	$moim_account_list->StopRecord = $moim_account_list->TotalRecords;
} else {

	// Set the last record to display
	if ($moim_account_list->TotalRecords > $moim_account_list->StartRecord + $moim_account_list->DisplayRecords - 1)
		$moim_account_list->StopRecord = $moim_account_list->StartRecord + $moim_account_list->DisplayRecords - 1;
	else
		$moim_account_list->StopRecord = $moim_account_list->TotalRecords;
}
$moim_account_list->RecordCount = $moim_account_list->StartRecord - 1;
if ($moim_account_list->Recordset && !$moim_account_list->Recordset->EOF) {
	$moim_account_list->Recordset->moveFirst();
	$selectLimit = $moim_account_list->UseSelectLimit;
	if (!$selectLimit && $moim_account_list->StartRecord > 1)
		$moim_account_list->Recordset->move($moim_account_list->StartRecord - 1);
} elseif (!$moim_account->AllowAddDeleteRow && $moim_account_list->StopRecord == 0) {
	$moim_account_list->StopRecord = $moim_account->GridAddRowCount;
}

// Initialize aggregate
$moim_account->RowType = ROWTYPE_AGGREGATEINIT;
$moim_account->resetAttributes();
$moim_account_list->renderRow();
while ($moim_account_list->RecordCount < $moim_account_list->StopRecord) {
	$moim_account_list->RecordCount++;
	if ($moim_account_list->RecordCount >= $moim_account_list->StartRecord) {
		$moim_account_list->RowCount++;

		// Set up key count
		$moim_account_list->KeyCount = $moim_account_list->RowIndex;

		// Init row class and style
		$moim_account->resetAttributes();
		$moim_account->CssClass = "";
		if ($moim_account_list->isGridAdd()) {
		} else {
			$moim_account_list->loadRowValues($moim_account_list->Recordset); // Load row values
		}
		$moim_account->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$moim_account->RowAttrs->merge(["data-rowindex" => $moim_account_list->RowCount, "id" => "r" . $moim_account_list->RowCount . "_moim_account", "data-rowtype" => $moim_account->RowType]);

		// Render row
		$moim_account_list->renderRow();

		// Render list options
		$moim_account_list->renderListOptions();
?>
	<tr <?php echo $moim_account->rowAttributes() ?>>
<?php

// Render list options (body, left)
$moim_account_list->ListOptions->render("body", "left", $moim_account_list->RowCount);
?>
	<?php if ($moim_account_list->moim_code->Visible) { // moim_code ?>
		<td data-name="moim_code" <?php echo $moim_account_list->moim_code->cellAttributes() ?>>
<span id="el<?php echo $moim_account_list->RowCount ?>_moim_account_moim_code">
<span<?php echo $moim_account_list->moim_code->viewAttributes() ?>><?php echo $moim_account_list->moim_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($moim_account_list->moim_name->Visible) { // moim_name ?>
		<td data-name="moim_name" <?php echo $moim_account_list->moim_name->cellAttributes() ?>>
<span id="el<?php echo $moim_account_list->RowCount ?>_moim_account_moim_name">
<span<?php echo $moim_account_list->moim_name->viewAttributes() ?>><?php echo $moim_account_list->moim_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($moim_account_list->account_code->Visible) { // account_code ?>
		<td data-name="account_code" <?php echo $moim_account_list->account_code->cellAttributes() ?>>
<span id="el<?php echo $moim_account_list->RowCount ?>_moim_account_account_code">
<span<?php echo $moim_account_list->account_code->viewAttributes() ?>><?php echo $moim_account_list->account_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($moim_account_list->account_name->Visible) { // account_name ?>
		<td data-name="account_name" <?php echo $moim_account_list->account_name->cellAttributes() ?>>
<span id="el<?php echo $moim_account_list->RowCount ?>_moim_account_account_name">
<span<?php echo $moim_account_list->account_name->viewAttributes() ?>><?php echo $moim_account_list->account_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$moim_account_list->ListOptions->render("body", "right", $moim_account_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$moim_account_list->isGridAdd())
		$moim_account_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$moim_account->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($moim_account_list->Recordset)
	$moim_account_list->Recordset->Close();
?>
<?php if (!$moim_account_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$moim_account_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $moim_account_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $moim_account_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($moim_account_list->TotalRecords == 0 && !$moim_account->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $moim_account_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$moim_account_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$moim_account_list->isExport()) { ?>
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
$moim_account_list->terminate();
?>