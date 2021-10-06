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
$relationship_list = new relationship_list();

// Run the page
$relationship_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$relationship_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$relationship_list->isExport()) { ?>
<script>
var frelationshiplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	frelationshiplist = currentForm = new ew.Form("frelationshiplist", "list");
	frelationshiplist.formKeyCountName = '<?php echo $relationship_list->FormKeyCountName ?>';
	loadjs.done("frelationshiplist");
});
var frelationshiplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	frelationshiplistsrch = currentSearchForm = new ew.Form("frelationshiplistsrch");

	// Dynamic selection lists
	// Filters

	frelationshiplistsrch.filterList = <?php echo $relationship_list->getFilterList() ?>;

	// Init search panel as collapsed
	frelationshiplistsrch.initSearchPanel = true;
	loadjs.done("frelationshiplistsrch");
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
<?php if (!$relationship_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($relationship_list->TotalRecords > 0 && $relationship_list->ExportOptions->visible()) { ?>
<?php $relationship_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($relationship_list->ImportOptions->visible()) { ?>
<?php $relationship_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($relationship_list->SearchOptions->visible()) { ?>
<?php $relationship_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($relationship_list->FilterOptions->visible()) { ?>
<?php $relationship_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$relationship_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$relationship_list->isExport() && !$relationship->CurrentAction) { ?>
<form name="frelationshiplistsrch" id="frelationshiplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="frelationshiplistsrch-search-panel" class="<?php echo $relationship_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="relationship">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $relationship_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($relationship_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($relationship_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $relationship_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($relationship_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($relationship_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($relationship_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($relationship_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $relationship_list->showPageHeader(); ?>
<?php
$relationship_list->showMessage();
?>
<?php if ($relationship_list->TotalRecords > 0 || $relationship->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($relationship_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> relationship">
<?php if (!$relationship_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$relationship_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $relationship_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $relationship_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="frelationshiplist" id="frelationshiplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="relationship">
<div id="gmp_relationship" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($relationship_list->TotalRecords > 0 || $relationship_list->isGridEdit()) { ?>
<table id="tbl_relationshiplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$relationship->RowType = ROWTYPE_HEADER;

// Render list options
$relationship_list->renderListOptions();

// Render list options (header, left)
$relationship_list->ListOptions->render("header", "left");
?>
<?php if ($relationship_list->RelationshipCode->Visible) { // RelationshipCode ?>
	<?php if ($relationship_list->SortUrl($relationship_list->RelationshipCode) == "") { ?>
		<th data-name="RelationshipCode" class="<?php echo $relationship_list->RelationshipCode->headerCellClass() ?>"><div id="elh_relationship_RelationshipCode" class="relationship_RelationshipCode"><div class="ew-table-header-caption"><?php echo $relationship_list->RelationshipCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RelationshipCode" class="<?php echo $relationship_list->RelationshipCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $relationship_list->SortUrl($relationship_list->RelationshipCode) ?>', 1);"><div id="elh_relationship_RelationshipCode" class="relationship_RelationshipCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $relationship_list->RelationshipCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($relationship_list->RelationshipCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($relationship_list->RelationshipCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($relationship_list->Relationship->Visible) { // Relationship ?>
	<?php if ($relationship_list->SortUrl($relationship_list->Relationship) == "") { ?>
		<th data-name="Relationship" class="<?php echo $relationship_list->Relationship->headerCellClass() ?>"><div id="elh_relationship_Relationship" class="relationship_Relationship"><div class="ew-table-header-caption"><?php echo $relationship_list->Relationship->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Relationship" class="<?php echo $relationship_list->Relationship->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $relationship_list->SortUrl($relationship_list->Relationship) ?>', 1);"><div id="elh_relationship_Relationship" class="relationship_Relationship">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $relationship_list->Relationship->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($relationship_list->Relationship->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($relationship_list->Relationship->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($relationship_list->Comment->Visible) { // Comment ?>
	<?php if ($relationship_list->SortUrl($relationship_list->Comment) == "") { ?>
		<th data-name="Comment" class="<?php echo $relationship_list->Comment->headerCellClass() ?>"><div id="elh_relationship_Comment" class="relationship_Comment"><div class="ew-table-header-caption"><?php echo $relationship_list->Comment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comment" class="<?php echo $relationship_list->Comment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $relationship_list->SortUrl($relationship_list->Comment) ?>', 1);"><div id="elh_relationship_Comment" class="relationship_Comment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $relationship_list->Comment->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($relationship_list->Comment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($relationship_list->Comment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$relationship_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($relationship_list->ExportAll && $relationship_list->isExport()) {
	$relationship_list->StopRecord = $relationship_list->TotalRecords;
} else {

	// Set the last record to display
	if ($relationship_list->TotalRecords > $relationship_list->StartRecord + $relationship_list->DisplayRecords - 1)
		$relationship_list->StopRecord = $relationship_list->StartRecord + $relationship_list->DisplayRecords - 1;
	else
		$relationship_list->StopRecord = $relationship_list->TotalRecords;
}
$relationship_list->RecordCount = $relationship_list->StartRecord - 1;
if ($relationship_list->Recordset && !$relationship_list->Recordset->EOF) {
	$relationship_list->Recordset->moveFirst();
	$selectLimit = $relationship_list->UseSelectLimit;
	if (!$selectLimit && $relationship_list->StartRecord > 1)
		$relationship_list->Recordset->move($relationship_list->StartRecord - 1);
} elseif (!$relationship->AllowAddDeleteRow && $relationship_list->StopRecord == 0) {
	$relationship_list->StopRecord = $relationship->GridAddRowCount;
}

// Initialize aggregate
$relationship->RowType = ROWTYPE_AGGREGATEINIT;
$relationship->resetAttributes();
$relationship_list->renderRow();
while ($relationship_list->RecordCount < $relationship_list->StopRecord) {
	$relationship_list->RecordCount++;
	if ($relationship_list->RecordCount >= $relationship_list->StartRecord) {
		$relationship_list->RowCount++;

		// Set up key count
		$relationship_list->KeyCount = $relationship_list->RowIndex;

		// Init row class and style
		$relationship->resetAttributes();
		$relationship->CssClass = "";
		if ($relationship_list->isGridAdd()) {
		} else {
			$relationship_list->loadRowValues($relationship_list->Recordset); // Load row values
		}
		$relationship->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$relationship->RowAttrs->merge(["data-rowindex" => $relationship_list->RowCount, "id" => "r" . $relationship_list->RowCount . "_relationship", "data-rowtype" => $relationship->RowType]);

		// Render row
		$relationship_list->renderRow();

		// Render list options
		$relationship_list->renderListOptions();
?>
	<tr <?php echo $relationship->rowAttributes() ?>>
<?php

// Render list options (body, left)
$relationship_list->ListOptions->render("body", "left", $relationship_list->RowCount);
?>
	<?php if ($relationship_list->RelationshipCode->Visible) { // RelationshipCode ?>
		<td data-name="RelationshipCode" <?php echo $relationship_list->RelationshipCode->cellAttributes() ?>>
<span id="el<?php echo $relationship_list->RowCount ?>_relationship_RelationshipCode">
<span<?php echo $relationship_list->RelationshipCode->viewAttributes() ?>><?php echo $relationship_list->RelationshipCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($relationship_list->Relationship->Visible) { // Relationship ?>
		<td data-name="Relationship" <?php echo $relationship_list->Relationship->cellAttributes() ?>>
<span id="el<?php echo $relationship_list->RowCount ?>_relationship_Relationship">
<span<?php echo $relationship_list->Relationship->viewAttributes() ?>><?php echo $relationship_list->Relationship->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($relationship_list->Comment->Visible) { // Comment ?>
		<td data-name="Comment" <?php echo $relationship_list->Comment->cellAttributes() ?>>
<span id="el<?php echo $relationship_list->RowCount ?>_relationship_Comment">
<span<?php echo $relationship_list->Comment->viewAttributes() ?>><?php echo $relationship_list->Comment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$relationship_list->ListOptions->render("body", "right", $relationship_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$relationship_list->isGridAdd())
		$relationship_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$relationship->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($relationship_list->Recordset)
	$relationship_list->Recordset->Close();
?>
<?php if (!$relationship_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$relationship_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $relationship_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $relationship_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($relationship_list->TotalRecords == 0 && !$relationship->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $relationship_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$relationship_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$relationship_list->isExport()) { ?>
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
$relationship_list->terminate();
?>