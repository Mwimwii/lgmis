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
$business_type_contracts_list = new business_type_contracts_list();

// Run the page
$business_type_contracts_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_type_contracts_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_type_contracts_list->isExport()) { ?>
<script>
var fbusiness_type_contractslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbusiness_type_contractslist = currentForm = new ew.Form("fbusiness_type_contractslist", "list");
	fbusiness_type_contractslist.formKeyCountName = '<?php echo $business_type_contracts_list->FormKeyCountName ?>';
	loadjs.done("fbusiness_type_contractslist");
});
var fbusiness_type_contractslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbusiness_type_contractslistsrch = currentSearchForm = new ew.Form("fbusiness_type_contractslistsrch");

	// Dynamic selection lists
	// Filters

	fbusiness_type_contractslistsrch.filterList = <?php echo $business_type_contracts_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbusiness_type_contractslistsrch.initSearchPanel = true;
	loadjs.done("fbusiness_type_contractslistsrch");
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
<?php if (!$business_type_contracts_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($business_type_contracts_list->TotalRecords > 0 && $business_type_contracts_list->ExportOptions->visible()) { ?>
<?php $business_type_contracts_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($business_type_contracts_list->ImportOptions->visible()) { ?>
<?php $business_type_contracts_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($business_type_contracts_list->SearchOptions->visible()) { ?>
<?php $business_type_contracts_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($business_type_contracts_list->FilterOptions->visible()) { ?>
<?php $business_type_contracts_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$business_type_contracts_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$business_type_contracts_list->isExport() && !$business_type_contracts->CurrentAction) { ?>
<form name="fbusiness_type_contractslistsrch" id="fbusiness_type_contractslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbusiness_type_contractslistsrch-search-panel" class="<?php echo $business_type_contracts_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="business_type_contracts">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $business_type_contracts_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($business_type_contracts_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($business_type_contracts_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $business_type_contracts_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($business_type_contracts_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($business_type_contracts_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($business_type_contracts_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($business_type_contracts_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $business_type_contracts_list->showPageHeader(); ?>
<?php
$business_type_contracts_list->showMessage();
?>
<?php if ($business_type_contracts_list->TotalRecords > 0 || $business_type_contracts->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($business_type_contracts_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> business_type_contracts">
<?php if (!$business_type_contracts_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$business_type_contracts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_type_contracts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_type_contracts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbusiness_type_contractslist" id="fbusiness_type_contractslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business_type_contracts">
<div id="gmp_business_type_contracts" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($business_type_contracts_list->TotalRecords > 0 || $business_type_contracts_list->isGridEdit()) { ?>
<table id="tbl_business_type_contractslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$business_type_contracts->RowType = ROWTYPE_HEADER;

// Render list options
$business_type_contracts_list->renderListOptions();

// Render list options (header, left)
$business_type_contracts_list->ListOptions->render("header", "left");
?>
<?php if ($business_type_contracts_list->business_type_code->Visible) { // business_type_code ?>
	<?php if ($business_type_contracts_list->SortUrl($business_type_contracts_list->business_type_code) == "") { ?>
		<th data-name="business_type_code" class="<?php echo $business_type_contracts_list->business_type_code->headerCellClass() ?>"><div id="elh_business_type_contracts_business_type_code" class="business_type_contracts_business_type_code"><div class="ew-table-header-caption"><?php echo $business_type_contracts_list->business_type_code->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="business_type_code" class="<?php echo $business_type_contracts_list->business_type_code->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_type_contracts_list->SortUrl($business_type_contracts_list->business_type_code) ?>', 1);"><div id="elh_business_type_contracts_business_type_code" class="business_type_contracts_business_type_code">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_type_contracts_list->business_type_code->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_type_contracts_list->business_type_code->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_type_contracts_list->business_type_code->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_type_contracts_list->business_type_name->Visible) { // business_type_name ?>
	<?php if ($business_type_contracts_list->SortUrl($business_type_contracts_list->business_type_name) == "") { ?>
		<th data-name="business_type_name" class="<?php echo $business_type_contracts_list->business_type_name->headerCellClass() ?>"><div id="elh_business_type_contracts_business_type_name" class="business_type_contracts_business_type_name"><div class="ew-table-header-caption"><?php echo $business_type_contracts_list->business_type_name->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="business_type_name" class="<?php echo $business_type_contracts_list->business_type_name->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_type_contracts_list->SortUrl($business_type_contracts_list->business_type_name) ?>', 1);"><div id="elh_business_type_contracts_business_type_name" class="business_type_contracts_business_type_name">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_type_contracts_list->business_type_name->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_type_contracts_list->business_type_name->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_type_contracts_list->business_type_name->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_type_contracts_list->business_type_desc->Visible) { // business_type_desc ?>
	<?php if ($business_type_contracts_list->SortUrl($business_type_contracts_list->business_type_desc) == "") { ?>
		<th data-name="business_type_desc" class="<?php echo $business_type_contracts_list->business_type_desc->headerCellClass() ?>"><div id="elh_business_type_contracts_business_type_desc" class="business_type_contracts_business_type_desc"><div class="ew-table-header-caption"><?php echo $business_type_contracts_list->business_type_desc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="business_type_desc" class="<?php echo $business_type_contracts_list->business_type_desc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_type_contracts_list->SortUrl($business_type_contracts_list->business_type_desc) ?>', 1);"><div id="elh_business_type_contracts_business_type_desc" class="business_type_contracts_business_type_desc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_type_contracts_list->business_type_desc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_type_contracts_list->business_type_desc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_type_contracts_list->business_type_desc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$business_type_contracts_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($business_type_contracts_list->ExportAll && $business_type_contracts_list->isExport()) {
	$business_type_contracts_list->StopRecord = $business_type_contracts_list->TotalRecords;
} else {

	// Set the last record to display
	if ($business_type_contracts_list->TotalRecords > $business_type_contracts_list->StartRecord + $business_type_contracts_list->DisplayRecords - 1)
		$business_type_contracts_list->StopRecord = $business_type_contracts_list->StartRecord + $business_type_contracts_list->DisplayRecords - 1;
	else
		$business_type_contracts_list->StopRecord = $business_type_contracts_list->TotalRecords;
}
$business_type_contracts_list->RecordCount = $business_type_contracts_list->StartRecord - 1;
if ($business_type_contracts_list->Recordset && !$business_type_contracts_list->Recordset->EOF) {
	$business_type_contracts_list->Recordset->moveFirst();
	$selectLimit = $business_type_contracts_list->UseSelectLimit;
	if (!$selectLimit && $business_type_contracts_list->StartRecord > 1)
		$business_type_contracts_list->Recordset->move($business_type_contracts_list->StartRecord - 1);
} elseif (!$business_type_contracts->AllowAddDeleteRow && $business_type_contracts_list->StopRecord == 0) {
	$business_type_contracts_list->StopRecord = $business_type_contracts->GridAddRowCount;
}

// Initialize aggregate
$business_type_contracts->RowType = ROWTYPE_AGGREGATEINIT;
$business_type_contracts->resetAttributes();
$business_type_contracts_list->renderRow();
while ($business_type_contracts_list->RecordCount < $business_type_contracts_list->StopRecord) {
	$business_type_contracts_list->RecordCount++;
	if ($business_type_contracts_list->RecordCount >= $business_type_contracts_list->StartRecord) {
		$business_type_contracts_list->RowCount++;

		// Set up key count
		$business_type_contracts_list->KeyCount = $business_type_contracts_list->RowIndex;

		// Init row class and style
		$business_type_contracts->resetAttributes();
		$business_type_contracts->CssClass = "";
		if ($business_type_contracts_list->isGridAdd()) {
		} else {
			$business_type_contracts_list->loadRowValues($business_type_contracts_list->Recordset); // Load row values
		}
		$business_type_contracts->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$business_type_contracts->RowAttrs->merge(["data-rowindex" => $business_type_contracts_list->RowCount, "id" => "r" . $business_type_contracts_list->RowCount . "_business_type_contracts", "data-rowtype" => $business_type_contracts->RowType]);

		// Render row
		$business_type_contracts_list->renderRow();

		// Render list options
		$business_type_contracts_list->renderListOptions();
?>
	<tr <?php echo $business_type_contracts->rowAttributes() ?>>
<?php

// Render list options (body, left)
$business_type_contracts_list->ListOptions->render("body", "left", $business_type_contracts_list->RowCount);
?>
	<?php if ($business_type_contracts_list->business_type_code->Visible) { // business_type_code ?>
		<td data-name="business_type_code" <?php echo $business_type_contracts_list->business_type_code->cellAttributes() ?>>
<span id="el<?php echo $business_type_contracts_list->RowCount ?>_business_type_contracts_business_type_code">
<span<?php echo $business_type_contracts_list->business_type_code->viewAttributes() ?>><?php echo $business_type_contracts_list->business_type_code->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_type_contracts_list->business_type_name->Visible) { // business_type_name ?>
		<td data-name="business_type_name" <?php echo $business_type_contracts_list->business_type_name->cellAttributes() ?>>
<span id="el<?php echo $business_type_contracts_list->RowCount ?>_business_type_contracts_business_type_name">
<span<?php echo $business_type_contracts_list->business_type_name->viewAttributes() ?>><?php echo $business_type_contracts_list->business_type_name->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_type_contracts_list->business_type_desc->Visible) { // business_type_desc ?>
		<td data-name="business_type_desc" <?php echo $business_type_contracts_list->business_type_desc->cellAttributes() ?>>
<span id="el<?php echo $business_type_contracts_list->RowCount ?>_business_type_contracts_business_type_desc">
<span<?php echo $business_type_contracts_list->business_type_desc->viewAttributes() ?>><?php echo $business_type_contracts_list->business_type_desc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$business_type_contracts_list->ListOptions->render("body", "right", $business_type_contracts_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$business_type_contracts_list->isGridAdd())
		$business_type_contracts_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$business_type_contracts->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($business_type_contracts_list->Recordset)
	$business_type_contracts_list->Recordset->Close();
?>
<?php if (!$business_type_contracts_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$business_type_contracts_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_type_contracts_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_type_contracts_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($business_type_contracts_list->TotalRecords == 0 && !$business_type_contracts->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $business_type_contracts_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$business_type_contracts_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_type_contracts_list->isExport()) { ?>
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
$business_type_contracts_list->terminate();
?>