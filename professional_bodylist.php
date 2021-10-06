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
$professional_body_list = new professional_body_list();

// Run the page
$professional_body_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$professional_body_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$professional_body_list->isExport()) { ?>
<script>
var fprofessional_bodylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fprofessional_bodylist = currentForm = new ew.Form("fprofessional_bodylist", "list");
	fprofessional_bodylist.formKeyCountName = '<?php echo $professional_body_list->FormKeyCountName ?>';
	loadjs.done("fprofessional_bodylist");
});
var fprofessional_bodylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fprofessional_bodylistsrch = currentSearchForm = new ew.Form("fprofessional_bodylistsrch");

	// Dynamic selection lists
	// Filters

	fprofessional_bodylistsrch.filterList = <?php echo $professional_body_list->getFilterList() ?>;

	// Init search panel as collapsed
	fprofessional_bodylistsrch.initSearchPanel = true;
	loadjs.done("fprofessional_bodylistsrch");
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
<?php if (!$professional_body_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($professional_body_list->TotalRecords > 0 && $professional_body_list->ExportOptions->visible()) { ?>
<?php $professional_body_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($professional_body_list->ImportOptions->visible()) { ?>
<?php $professional_body_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($professional_body_list->SearchOptions->visible()) { ?>
<?php $professional_body_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($professional_body_list->FilterOptions->visible()) { ?>
<?php $professional_body_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$professional_body_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$professional_body_list->isExport() && !$professional_body->CurrentAction) { ?>
<form name="fprofessional_bodylistsrch" id="fprofessional_bodylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fprofessional_bodylistsrch-search-panel" class="<?php echo $professional_body_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="professional_body">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $professional_body_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($professional_body_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($professional_body_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $professional_body_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($professional_body_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($professional_body_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($professional_body_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($professional_body_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $professional_body_list->showPageHeader(); ?>
<?php
$professional_body_list->showMessage();
?>
<?php if ($professional_body_list->TotalRecords > 0 || $professional_body->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($professional_body_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> professional_body">
<?php if (!$professional_body_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$professional_body_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_body_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $professional_body_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fprofessional_bodylist" id="fprofessional_bodylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="professional_body">
<div id="gmp_professional_body" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($professional_body_list->TotalRecords > 0 || $professional_body_list->isGridEdit()) { ?>
<table id="tbl_professional_bodylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$professional_body->RowType = ROWTYPE_HEADER;

// Render list options
$professional_body_list->renderListOptions();

// Render list options (header, left)
$professional_body_list->ListOptions->render("header", "left");
?>
<?php if ($professional_body_list->ProfessionalBody->Visible) { // ProfessionalBody ?>
	<?php if ($professional_body_list->SortUrl($professional_body_list->ProfessionalBody) == "") { ?>
		<th data-name="ProfessionalBody" class="<?php echo $professional_body_list->ProfessionalBody->headerCellClass() ?>"><div id="elh_professional_body_ProfessionalBody" class="professional_body_ProfessionalBody"><div class="ew-table-header-caption"><?php echo $professional_body_list->ProfessionalBody->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalBody" class="<?php echo $professional_body_list->ProfessionalBody->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_body_list->SortUrl($professional_body_list->ProfessionalBody) ?>', 1);"><div id="elh_professional_body_ProfessionalBody" class="professional_body_ProfessionalBody">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_body_list->ProfessionalBody->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professional_body_list->ProfessionalBody->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_body_list->ProfessionalBody->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($professional_body_list->ProfessionalField->Visible) { // ProfessionalField ?>
	<?php if ($professional_body_list->SortUrl($professional_body_list->ProfessionalField) == "") { ?>
		<th data-name="ProfessionalField" class="<?php echo $professional_body_list->ProfessionalField->headerCellClass() ?>"><div id="elh_professional_body_ProfessionalField" class="professional_body_ProfessionalField"><div class="ew-table-header-caption"><?php echo $professional_body_list->ProfessionalField->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalField" class="<?php echo $professional_body_list->ProfessionalField->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $professional_body_list->SortUrl($professional_body_list->ProfessionalField) ?>', 1);"><div id="elh_professional_body_ProfessionalField" class="professional_body_ProfessionalField">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $professional_body_list->ProfessionalField->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($professional_body_list->ProfessionalField->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($professional_body_list->ProfessionalField->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$professional_body_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($professional_body_list->ExportAll && $professional_body_list->isExport()) {
	$professional_body_list->StopRecord = $professional_body_list->TotalRecords;
} else {

	// Set the last record to display
	if ($professional_body_list->TotalRecords > $professional_body_list->StartRecord + $professional_body_list->DisplayRecords - 1)
		$professional_body_list->StopRecord = $professional_body_list->StartRecord + $professional_body_list->DisplayRecords - 1;
	else
		$professional_body_list->StopRecord = $professional_body_list->TotalRecords;
}
$professional_body_list->RecordCount = $professional_body_list->StartRecord - 1;
if ($professional_body_list->Recordset && !$professional_body_list->Recordset->EOF) {
	$professional_body_list->Recordset->moveFirst();
	$selectLimit = $professional_body_list->UseSelectLimit;
	if (!$selectLimit && $professional_body_list->StartRecord > 1)
		$professional_body_list->Recordset->move($professional_body_list->StartRecord - 1);
} elseif (!$professional_body->AllowAddDeleteRow && $professional_body_list->StopRecord == 0) {
	$professional_body_list->StopRecord = $professional_body->GridAddRowCount;
}

// Initialize aggregate
$professional_body->RowType = ROWTYPE_AGGREGATEINIT;
$professional_body->resetAttributes();
$professional_body_list->renderRow();
while ($professional_body_list->RecordCount < $professional_body_list->StopRecord) {
	$professional_body_list->RecordCount++;
	if ($professional_body_list->RecordCount >= $professional_body_list->StartRecord) {
		$professional_body_list->RowCount++;

		// Set up key count
		$professional_body_list->KeyCount = $professional_body_list->RowIndex;

		// Init row class and style
		$professional_body->resetAttributes();
		$professional_body->CssClass = "";
		if ($professional_body_list->isGridAdd()) {
		} else {
			$professional_body_list->loadRowValues($professional_body_list->Recordset); // Load row values
		}
		$professional_body->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$professional_body->RowAttrs->merge(["data-rowindex" => $professional_body_list->RowCount, "id" => "r" . $professional_body_list->RowCount . "_professional_body", "data-rowtype" => $professional_body->RowType]);

		// Render row
		$professional_body_list->renderRow();

		// Render list options
		$professional_body_list->renderListOptions();
?>
	<tr <?php echo $professional_body->rowAttributes() ?>>
<?php

// Render list options (body, left)
$professional_body_list->ListOptions->render("body", "left", $professional_body_list->RowCount);
?>
	<?php if ($professional_body_list->ProfessionalBody->Visible) { // ProfessionalBody ?>
		<td data-name="ProfessionalBody" <?php echo $professional_body_list->ProfessionalBody->cellAttributes() ?>>
<span id="el<?php echo $professional_body_list->RowCount ?>_professional_body_ProfessionalBody">
<span<?php echo $professional_body_list->ProfessionalBody->viewAttributes() ?>><?php echo $professional_body_list->ProfessionalBody->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($professional_body_list->ProfessionalField->Visible) { // ProfessionalField ?>
		<td data-name="ProfessionalField" <?php echo $professional_body_list->ProfessionalField->cellAttributes() ?>>
<span id="el<?php echo $professional_body_list->RowCount ?>_professional_body_ProfessionalField">
<span<?php echo $professional_body_list->ProfessionalField->viewAttributes() ?>><?php echo $professional_body_list->ProfessionalField->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$professional_body_list->ListOptions->render("body", "right", $professional_body_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$professional_body_list->isGridAdd())
		$professional_body_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$professional_body->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($professional_body_list->Recordset)
	$professional_body_list->Recordset->Close();
?>
<?php if (!$professional_body_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$professional_body_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $professional_body_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $professional_body_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($professional_body_list->TotalRecords == 0 && !$professional_body->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $professional_body_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$professional_body_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$professional_body_list->isExport()) { ?>
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
$professional_body_list->terminate();
?>