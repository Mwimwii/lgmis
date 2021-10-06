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
$payroll_upload_list = new payroll_upload_list();

// Run the page
$payroll_upload_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_upload_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_upload_list->isExport()) { ?>
<script>
var fpayroll_uploadlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayroll_uploadlist = currentForm = new ew.Form("fpayroll_uploadlist", "list");
	fpayroll_uploadlist.formKeyCountName = '<?php echo $payroll_upload_list->FormKeyCountName ?>';
	loadjs.done("fpayroll_uploadlist");
});
var fpayroll_uploadlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayroll_uploadlistsrch = currentSearchForm = new ew.Form("fpayroll_uploadlistsrch");

	// Dynamic selection lists
	// Filters

	fpayroll_uploadlistsrch.filterList = <?php echo $payroll_upload_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayroll_uploadlistsrch.initSearchPanel = true;
	loadjs.done("fpayroll_uploadlistsrch");
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
<?php if (!$payroll_upload_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_upload_list->TotalRecords > 0 && $payroll_upload_list->ExportOptions->visible()) { ?>
<?php $payroll_upload_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_upload_list->ImportOptions->visible()) { ?>
<?php $payroll_upload_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_upload_list->SearchOptions->visible()) { ?>
<?php $payroll_upload_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_upload_list->FilterOptions->visible()) { ?>
<?php $payroll_upload_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payroll_upload_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_upload_list->isExport() && !$payroll_upload->CurrentAction) { ?>
<form name="fpayroll_uploadlistsrch" id="fpayroll_uploadlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayroll_uploadlistsrch-search-panel" class="<?php echo $payroll_upload_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll_upload">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payroll_upload_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_upload_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_upload_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_upload_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_upload_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_upload_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_upload_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_upload_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_upload_list->showPageHeader(); ?>
<?php
$payroll_upload_list->showMessage();
?>
<?php if ($payroll_upload_list->TotalRecords > 0 || $payroll_upload->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_upload_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_upload">
<?php if (!$payroll_upload_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_upload_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_upload_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_upload_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayroll_uploadlist" id="fpayroll_uploadlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_upload">
<div id="gmp_payroll_upload" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_upload_list->TotalRecords > 0 || $payroll_upload_list->isGridEdit()) { ?>
<table id="tbl_payroll_uploadlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_upload->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_upload_list->renderListOptions();

// Render list options (header, left)
$payroll_upload_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_upload_list->LACode->Visible) { // LACode ?>
	<?php if ($payroll_upload_list->SortUrl($payroll_upload_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $payroll_upload_list->LACode->headerCellClass() ?>"><div id="elh_payroll_upload_LACode" class="payroll_upload_LACode"><div class="ew-table-header-caption"><?php echo $payroll_upload_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $payroll_upload_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_upload_list->SortUrl($payroll_upload_list->LACode) ?>', 1);"><div id="elh_payroll_upload_LACode" class="payroll_upload_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_upload_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_upload_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_upload_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_upload_list->Filename->Visible) { // Filename ?>
	<?php if ($payroll_upload_list->SortUrl($payroll_upload_list->Filename) == "") { ?>
		<th data-name="Filename" class="<?php echo $payroll_upload_list->Filename->headerCellClass() ?>"><div id="elh_payroll_upload_Filename" class="payroll_upload_Filename"><div class="ew-table-header-caption"><?php echo $payroll_upload_list->Filename->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Filename" class="<?php echo $payroll_upload_list->Filename->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_upload_list->SortUrl($payroll_upload_list->Filename) ?>', 1);"><div id="elh_payroll_upload_Filename" class="payroll_upload_Filename">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_upload_list->Filename->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_upload_list->Filename->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_upload_list->Filename->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_upload_list->Filetype->Visible) { // Filetype ?>
	<?php if ($payroll_upload_list->SortUrl($payroll_upload_list->Filetype) == "") { ?>
		<th data-name="Filetype" class="<?php echo $payroll_upload_list->Filetype->headerCellClass() ?>"><div id="elh_payroll_upload_Filetype" class="payroll_upload_Filetype"><div class="ew-table-header-caption"><?php echo $payroll_upload_list->Filetype->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Filetype" class="<?php echo $payroll_upload_list->Filetype->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_upload_list->SortUrl($payroll_upload_list->Filetype) ?>', 1);"><div id="elh_payroll_upload_Filetype" class="payroll_upload_Filetype">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_upload_list->Filetype->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_upload_list->Filetype->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_upload_list->Filetype->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_upload_list->Filesize->Visible) { // Filesize ?>
	<?php if ($payroll_upload_list->SortUrl($payroll_upload_list->Filesize) == "") { ?>
		<th data-name="Filesize" class="<?php echo $payroll_upload_list->Filesize->headerCellClass() ?>"><div id="elh_payroll_upload_Filesize" class="payroll_upload_Filesize"><div class="ew-table-header-caption"><?php echo $payroll_upload_list->Filesize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Filesize" class="<?php echo $payroll_upload_list->Filesize->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_upload_list->SortUrl($payroll_upload_list->Filesize) ?>', 1);"><div id="elh_payroll_upload_Filesize" class="payroll_upload_Filesize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_upload_list->Filesize->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_upload_list->Filesize->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_upload_list->Filesize->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_upload_list->Uploadfolder->Visible) { // Uploadfolder ?>
	<?php if ($payroll_upload_list->SortUrl($payroll_upload_list->Uploadfolder) == "") { ?>
		<th data-name="Uploadfolder" class="<?php echo $payroll_upload_list->Uploadfolder->headerCellClass() ?>"><div id="elh_payroll_upload_Uploadfolder" class="payroll_upload_Uploadfolder"><div class="ew-table-header-caption"><?php echo $payroll_upload_list->Uploadfolder->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Uploadfolder" class="<?php echo $payroll_upload_list->Uploadfolder->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_upload_list->SortUrl($payroll_upload_list->Uploadfolder) ?>', 1);"><div id="elh_payroll_upload_Uploadfolder" class="payroll_upload_Uploadfolder">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_upload_list->Uploadfolder->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_upload_list->Uploadfolder->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_upload_list->Uploadfolder->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_upload_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payroll_upload_list->ExportAll && $payroll_upload_list->isExport()) {
	$payroll_upload_list->StopRecord = $payroll_upload_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_upload_list->TotalRecords > $payroll_upload_list->StartRecord + $payroll_upload_list->DisplayRecords - 1)
		$payroll_upload_list->StopRecord = $payroll_upload_list->StartRecord + $payroll_upload_list->DisplayRecords - 1;
	else
		$payroll_upload_list->StopRecord = $payroll_upload_list->TotalRecords;
}
$payroll_upload_list->RecordCount = $payroll_upload_list->StartRecord - 1;
if ($payroll_upload_list->Recordset && !$payroll_upload_list->Recordset->EOF) {
	$payroll_upload_list->Recordset->moveFirst();
	$selectLimit = $payroll_upload_list->UseSelectLimit;
	if (!$selectLimit && $payroll_upload_list->StartRecord > 1)
		$payroll_upload_list->Recordset->move($payroll_upload_list->StartRecord - 1);
} elseif (!$payroll_upload->AllowAddDeleteRow && $payroll_upload_list->StopRecord == 0) {
	$payroll_upload_list->StopRecord = $payroll_upload->GridAddRowCount;
}

// Initialize aggregate
$payroll_upload->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_upload->resetAttributes();
$payroll_upload_list->renderRow();
while ($payroll_upload_list->RecordCount < $payroll_upload_list->StopRecord) {
	$payroll_upload_list->RecordCount++;
	if ($payroll_upload_list->RecordCount >= $payroll_upload_list->StartRecord) {
		$payroll_upload_list->RowCount++;

		// Set up key count
		$payroll_upload_list->KeyCount = $payroll_upload_list->RowIndex;

		// Init row class and style
		$payroll_upload->resetAttributes();
		$payroll_upload->CssClass = "";
		if ($payroll_upload_list->isGridAdd()) {
		} else {
			$payroll_upload_list->loadRowValues($payroll_upload_list->Recordset); // Load row values
		}
		$payroll_upload->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payroll_upload->RowAttrs->merge(["data-rowindex" => $payroll_upload_list->RowCount, "id" => "r" . $payroll_upload_list->RowCount . "_payroll_upload", "data-rowtype" => $payroll_upload->RowType]);

		// Render row
		$payroll_upload_list->renderRow();

		// Render list options
		$payroll_upload_list->renderListOptions();
?>
	<tr <?php echo $payroll_upload->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_upload_list->ListOptions->render("body", "left", $payroll_upload_list->RowCount);
?>
	<?php if ($payroll_upload_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $payroll_upload_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $payroll_upload_list->RowCount ?>_payroll_upload_LACode">
<span<?php echo $payroll_upload_list->LACode->viewAttributes() ?>><?php echo $payroll_upload_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_upload_list->Filename->Visible) { // Filename ?>
		<td data-name="Filename" <?php echo $payroll_upload_list->Filename->cellAttributes() ?>>
<span id="el<?php echo $payroll_upload_list->RowCount ?>_payroll_upload_Filename">
<span<?php echo $payroll_upload_list->Filename->viewAttributes() ?>><?php echo GetFileViewTag($payroll_upload_list->Filename, $payroll_upload_list->Filename->getViewValue(), FALSE) ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_upload_list->Filetype->Visible) { // Filetype ?>
		<td data-name="Filetype" <?php echo $payroll_upload_list->Filetype->cellAttributes() ?>>
<span id="el<?php echo $payroll_upload_list->RowCount ?>_payroll_upload_Filetype">
<span<?php echo $payroll_upload_list->Filetype->viewAttributes() ?>><?php echo $payroll_upload_list->Filetype->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_upload_list->Filesize->Visible) { // Filesize ?>
		<td data-name="Filesize" <?php echo $payroll_upload_list->Filesize->cellAttributes() ?>>
<span id="el<?php echo $payroll_upload_list->RowCount ?>_payroll_upload_Filesize">
<span<?php echo $payroll_upload_list->Filesize->viewAttributes() ?>><?php echo $payroll_upload_list->Filesize->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_upload_list->Uploadfolder->Visible) { // Uploadfolder ?>
		<td data-name="Uploadfolder" <?php echo $payroll_upload_list->Uploadfolder->cellAttributes() ?>>
<span id="el<?php echo $payroll_upload_list->RowCount ?>_payroll_upload_Uploadfolder">
<span<?php echo $payroll_upload_list->Uploadfolder->viewAttributes() ?>><?php echo $payroll_upload_list->Uploadfolder->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_upload_list->ListOptions->render("body", "right", $payroll_upload_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payroll_upload_list->isGridAdd())
		$payroll_upload_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payroll_upload->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_upload_list->Recordset)
	$payroll_upload_list->Recordset->Close();
?>
<?php if (!$payroll_upload_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_upload_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_upload_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_upload_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_upload_list->TotalRecords == 0 && !$payroll_upload->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_upload_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_upload_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_upload_list->isExport()) { ?>
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
$payroll_upload_list->terminate();
?>