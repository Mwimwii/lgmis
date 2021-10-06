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
$document_text_list = new document_text_list();

// Run the page
$document_text_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$document_text_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$document_text_list->isExport()) { ?>
<script>
var fdocument_textlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdocument_textlist = currentForm = new ew.Form("fdocument_textlist", "list");
	fdocument_textlist.formKeyCountName = '<?php echo $document_text_list->FormKeyCountName ?>';
	loadjs.done("fdocument_textlist");
});
var fdocument_textlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdocument_textlistsrch = currentSearchForm = new ew.Form("fdocument_textlistsrch");

	// Dynamic selection lists
	// Filters

	fdocument_textlistsrch.filterList = <?php echo $document_text_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdocument_textlistsrch.initSearchPanel = true;
	loadjs.done("fdocument_textlistsrch");
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
<?php if (!$document_text_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($document_text_list->TotalRecords > 0 && $document_text_list->ExportOptions->visible()) { ?>
<?php $document_text_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($document_text_list->ImportOptions->visible()) { ?>
<?php $document_text_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($document_text_list->SearchOptions->visible()) { ?>
<?php $document_text_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($document_text_list->FilterOptions->visible()) { ?>
<?php $document_text_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$document_text_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$document_text_list->isExport() && !$document_text->CurrentAction) { ?>
<form name="fdocument_textlistsrch" id="fdocument_textlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdocument_textlistsrch-search-panel" class="<?php echo $document_text_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="document_text">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $document_text_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($document_text_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($document_text_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $document_text_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($document_text_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($document_text_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($document_text_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($document_text_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $document_text_list->showPageHeader(); ?>
<?php
$document_text_list->showMessage();
?>
<?php if ($document_text_list->TotalRecords > 0 || $document_text->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($document_text_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> document_text">
<?php if (!$document_text_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$document_text_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $document_text_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_text_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdocument_textlist" id="fdocument_textlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="document_text">
<div id="gmp_document_text" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($document_text_list->TotalRecords > 0 || $document_text_list->isGridEdit()) { ?>
<table id="tbl_document_textlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$document_text->RowType = ROWTYPE_HEADER;

// Render list options
$document_text_list->renderListOptions();

// Render list options (header, left)
$document_text_list->ListOptions->render("header", "left");
?>
<?php if ($document_text_list->ID->Visible) { // ID ?>
	<?php if ($document_text_list->SortUrl($document_text_list->ID) == "") { ?>
		<th data-name="ID" class="<?php echo $document_text_list->ID->headerCellClass() ?>"><div id="elh_document_text_ID" class="document_text_ID"><div class="ew-table-header-caption"><?php echo $document_text_list->ID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ID" class="<?php echo $document_text_list->ID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $document_text_list->SortUrl($document_text_list->ID) ?>', 1);"><div id="elh_document_text_ID" class="document_text_ID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_text_list->ID->caption() ?></span><span class="ew-table-header-sort"><?php if ($document_text_list->ID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($document_text_list->ID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($document_text_list->Ref->Visible) { // Ref ?>
	<?php if ($document_text_list->SortUrl($document_text_list->Ref) == "") { ?>
		<th data-name="Ref" class="<?php echo $document_text_list->Ref->headerCellClass() ?>"><div id="elh_document_text_Ref" class="document_text_Ref"><div class="ew-table-header-caption"><?php echo $document_text_list->Ref->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Ref" class="<?php echo $document_text_list->Ref->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $document_text_list->SortUrl($document_text_list->Ref) ?>', 1);"><div id="elh_document_text_Ref" class="document_text_Ref">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $document_text_list->Ref->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($document_text_list->Ref->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($document_text_list->Ref->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$document_text_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($document_text_list->ExportAll && $document_text_list->isExport()) {
	$document_text_list->StopRecord = $document_text_list->TotalRecords;
} else {

	// Set the last record to display
	if ($document_text_list->TotalRecords > $document_text_list->StartRecord + $document_text_list->DisplayRecords - 1)
		$document_text_list->StopRecord = $document_text_list->StartRecord + $document_text_list->DisplayRecords - 1;
	else
		$document_text_list->StopRecord = $document_text_list->TotalRecords;
}
$document_text_list->RecordCount = $document_text_list->StartRecord - 1;
if ($document_text_list->Recordset && !$document_text_list->Recordset->EOF) {
	$document_text_list->Recordset->moveFirst();
	$selectLimit = $document_text_list->UseSelectLimit;
	if (!$selectLimit && $document_text_list->StartRecord > 1)
		$document_text_list->Recordset->move($document_text_list->StartRecord - 1);
} elseif (!$document_text->AllowAddDeleteRow && $document_text_list->StopRecord == 0) {
	$document_text_list->StopRecord = $document_text->GridAddRowCount;
}

// Initialize aggregate
$document_text->RowType = ROWTYPE_AGGREGATEINIT;
$document_text->resetAttributes();
$document_text_list->renderRow();
while ($document_text_list->RecordCount < $document_text_list->StopRecord) {
	$document_text_list->RecordCount++;
	if ($document_text_list->RecordCount >= $document_text_list->StartRecord) {
		$document_text_list->RowCount++;

		// Set up key count
		$document_text_list->KeyCount = $document_text_list->RowIndex;

		// Init row class and style
		$document_text->resetAttributes();
		$document_text->CssClass = "";
		if ($document_text_list->isGridAdd()) {
		} else {
			$document_text_list->loadRowValues($document_text_list->Recordset); // Load row values
		}
		$document_text->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$document_text->RowAttrs->merge(["data-rowindex" => $document_text_list->RowCount, "id" => "r" . $document_text_list->RowCount . "_document_text", "data-rowtype" => $document_text->RowType]);

		// Render row
		$document_text_list->renderRow();

		// Render list options
		$document_text_list->renderListOptions();
?>
	<tr <?php echo $document_text->rowAttributes() ?>>
<?php

// Render list options (body, left)
$document_text_list->ListOptions->render("body", "left", $document_text_list->RowCount);
?>
	<?php if ($document_text_list->ID->Visible) { // ID ?>
		<td data-name="ID" <?php echo $document_text_list->ID->cellAttributes() ?>>
<span id="el<?php echo $document_text_list->RowCount ?>_document_text_ID">
<span<?php echo $document_text_list->ID->viewAttributes() ?>><?php echo $document_text_list->ID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($document_text_list->Ref->Visible) { // Ref ?>
		<td data-name="Ref" <?php echo $document_text_list->Ref->cellAttributes() ?>>
<span id="el<?php echo $document_text_list->RowCount ?>_document_text_Ref">
<span<?php echo $document_text_list->Ref->viewAttributes() ?>><?php echo $document_text_list->Ref->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$document_text_list->ListOptions->render("body", "right", $document_text_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$document_text_list->isGridAdd())
		$document_text_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$document_text->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($document_text_list->Recordset)
	$document_text_list->Recordset->Close();
?>
<?php if (!$document_text_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$document_text_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $document_text_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $document_text_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($document_text_list->TotalRecords == 0 && !$document_text->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $document_text_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$document_text_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$document_text_list->isExport()) { ?>
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
$document_text_list->terminate();
?>