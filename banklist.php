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
$bank_list = new bank_list();

// Run the page
$bank_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bank_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bank_list->isExport()) { ?>
<script>
var fbanklist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbanklist = currentForm = new ew.Form("fbanklist", "list");
	fbanklist.formKeyCountName = '<?php echo $bank_list->FormKeyCountName ?>';
	loadjs.done("fbanklist");
});
var fbanklistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbanklistsrch = currentSearchForm = new ew.Form("fbanklistsrch");

	// Dynamic selection lists
	// Filters

	fbanklistsrch.filterList = <?php echo $bank_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbanklistsrch.initSearchPanel = true;
	loadjs.done("fbanklistsrch");
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
<?php if (!$bank_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bank_list->TotalRecords > 0 && $bank_list->ExportOptions->visible()) { ?>
<?php $bank_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bank_list->ImportOptions->visible()) { ?>
<?php $bank_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bank_list->SearchOptions->visible()) { ?>
<?php $bank_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bank_list->FilterOptions->visible()) { ?>
<?php $bank_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$bank_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bank_list->isExport() && !$bank->CurrentAction) { ?>
<form name="fbanklistsrch" id="fbanklistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbanklistsrch-search-panel" class="<?php echo $bank_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bank">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $bank_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bank_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bank_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bank_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bank_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bank_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bank_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bank_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bank_list->showPageHeader(); ?>
<?php
$bank_list->showMessage();
?>
<?php if ($bank_list->TotalRecords > 0 || $bank->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bank_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bank">
<?php if (!$bank_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bank_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bank_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbanklist" id="fbanklist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bank">
<div id="gmp_bank" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bank_list->TotalRecords > 0 || $bank_list->isGridEdit()) { ?>
<table id="tbl_banklist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bank->RowType = ROWTYPE_HEADER;

// Render list options
$bank_list->renderListOptions();

// Render list options (header, left)
$bank_list->ListOptions->render("header", "left");
?>
<?php if ($bank_list->BankCode->Visible) { // BankCode ?>
	<?php if ($bank_list->SortUrl($bank_list->BankCode) == "") { ?>
		<th data-name="BankCode" class="<?php echo $bank_list->BankCode->headerCellClass() ?>"><div id="elh_bank_BankCode" class="bank_BankCode"><div class="ew-table-header-caption"><?php echo $bank_list->BankCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankCode" class="<?php echo $bank_list->BankCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_list->SortUrl($bank_list->BankCode) ?>', 1);"><div id="elh_bank_BankCode" class="bank_BankCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_list->BankCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_list->BankCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_list->BankCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_list->BankShortName->Visible) { // BankShortName ?>
	<?php if ($bank_list->SortUrl($bank_list->BankShortName) == "") { ?>
		<th data-name="BankShortName" class="<?php echo $bank_list->BankShortName->headerCellClass() ?>"><div id="elh_bank_BankShortName" class="bank_BankShortName"><div class="ew-table-header-caption"><?php echo $bank_list->BankShortName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankShortName" class="<?php echo $bank_list->BankShortName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_list->SortUrl($bank_list->BankShortName) ?>', 1);"><div id="elh_bank_BankShortName" class="bank_BankShortName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_list->BankShortName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_list->BankShortName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_list->BankShortName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bank_list->BankName->Visible) { // BankName ?>
	<?php if ($bank_list->SortUrl($bank_list->BankName) == "") { ?>
		<th data-name="BankName" class="<?php echo $bank_list->BankName->headerCellClass() ?>"><div id="elh_bank_BankName" class="bank_BankName"><div class="ew-table-header-caption"><?php echo $bank_list->BankName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankName" class="<?php echo $bank_list->BankName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bank_list->SortUrl($bank_list->BankName) ?>', 1);"><div id="elh_bank_BankName" class="bank_BankName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bank_list->BankName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bank_list->BankName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bank_list->BankName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bank_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bank_list->ExportAll && $bank_list->isExport()) {
	$bank_list->StopRecord = $bank_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bank_list->TotalRecords > $bank_list->StartRecord + $bank_list->DisplayRecords - 1)
		$bank_list->StopRecord = $bank_list->StartRecord + $bank_list->DisplayRecords - 1;
	else
		$bank_list->StopRecord = $bank_list->TotalRecords;
}
$bank_list->RecordCount = $bank_list->StartRecord - 1;
if ($bank_list->Recordset && !$bank_list->Recordset->EOF) {
	$bank_list->Recordset->moveFirst();
	$selectLimit = $bank_list->UseSelectLimit;
	if (!$selectLimit && $bank_list->StartRecord > 1)
		$bank_list->Recordset->move($bank_list->StartRecord - 1);
} elseif (!$bank->AllowAddDeleteRow && $bank_list->StopRecord == 0) {
	$bank_list->StopRecord = $bank->GridAddRowCount;
}

// Initialize aggregate
$bank->RowType = ROWTYPE_AGGREGATEINIT;
$bank->resetAttributes();
$bank_list->renderRow();
while ($bank_list->RecordCount < $bank_list->StopRecord) {
	$bank_list->RecordCount++;
	if ($bank_list->RecordCount >= $bank_list->StartRecord) {
		$bank_list->RowCount++;

		// Set up key count
		$bank_list->KeyCount = $bank_list->RowIndex;

		// Init row class and style
		$bank->resetAttributes();
		$bank->CssClass = "";
		if ($bank_list->isGridAdd()) {
		} else {
			$bank_list->loadRowValues($bank_list->Recordset); // Load row values
		}
		$bank->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bank->RowAttrs->merge(["data-rowindex" => $bank_list->RowCount, "id" => "r" . $bank_list->RowCount . "_bank", "data-rowtype" => $bank->RowType]);

		// Render row
		$bank_list->renderRow();

		// Render list options
		$bank_list->renderListOptions();
?>
	<tr <?php echo $bank->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bank_list->ListOptions->render("body", "left", $bank_list->RowCount);
?>
	<?php if ($bank_list->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode" <?php echo $bank_list->BankCode->cellAttributes() ?>>
<span id="el<?php echo $bank_list->RowCount ?>_bank_BankCode">
<span<?php echo $bank_list->BankCode->viewAttributes() ?>><?php echo $bank_list->BankCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_list->BankShortName->Visible) { // BankShortName ?>
		<td data-name="BankShortName" <?php echo $bank_list->BankShortName->cellAttributes() ?>>
<span id="el<?php echo $bank_list->RowCount ?>_bank_BankShortName">
<span<?php echo $bank_list->BankShortName->viewAttributes() ?>><?php echo $bank_list->BankShortName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bank_list->BankName->Visible) { // BankName ?>
		<td data-name="BankName" <?php echo $bank_list->BankName->cellAttributes() ?>>
<span id="el<?php echo $bank_list->RowCount ?>_bank_BankName">
<span<?php echo $bank_list->BankName->viewAttributes() ?>><?php echo $bank_list->BankName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bank_list->ListOptions->render("body", "right", $bank_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bank_list->isGridAdd())
		$bank_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bank->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bank_list->Recordset)
	$bank_list->Recordset->Close();
?>
<?php if (!$bank_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bank_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bank_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bank_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bank_list->TotalRecords == 0 && !$bank->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bank_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bank_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bank_list->isExport()) { ?>
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
$bank_list->terminate();
?>