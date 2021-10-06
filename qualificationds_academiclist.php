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
$qualificationds_academic_list = new qualificationds_academic_list();

// Run the page
$qualificationds_academic_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualificationds_academic_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$qualificationds_academic_list->isExport()) { ?>
<script>
var fqualificationds_academiclist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fqualificationds_academiclist = currentForm = new ew.Form("fqualificationds_academiclist", "list");
	fqualificationds_academiclist.formKeyCountName = '<?php echo $qualificationds_academic_list->FormKeyCountName ?>';
	loadjs.done("fqualificationds_academiclist");
});
var fqualificationds_academiclistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fqualificationds_academiclistsrch = currentSearchForm = new ew.Form("fqualificationds_academiclistsrch");

	// Dynamic selection lists
	// Filters

	fqualificationds_academiclistsrch.filterList = <?php echo $qualificationds_academic_list->getFilterList() ?>;

	// Init search panel as collapsed
	fqualificationds_academiclistsrch.initSearchPanel = true;
	loadjs.done("fqualificationds_academiclistsrch");
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
<?php if (!$qualificationds_academic_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($qualificationds_academic_list->TotalRecords > 0 && $qualificationds_academic_list->ExportOptions->visible()) { ?>
<?php $qualificationds_academic_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($qualificationds_academic_list->ImportOptions->visible()) { ?>
<?php $qualificationds_academic_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($qualificationds_academic_list->SearchOptions->visible()) { ?>
<?php $qualificationds_academic_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($qualificationds_academic_list->FilterOptions->visible()) { ?>
<?php $qualificationds_academic_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$qualificationds_academic_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$qualificationds_academic_list->isExport() && !$qualificationds_academic->CurrentAction) { ?>
<form name="fqualificationds_academiclistsrch" id="fqualificationds_academiclistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fqualificationds_academiclistsrch-search-panel" class="<?php echo $qualificationds_academic_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="qualificationds_academic">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $qualificationds_academic_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($qualificationds_academic_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($qualificationds_academic_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $qualificationds_academic_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($qualificationds_academic_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($qualificationds_academic_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($qualificationds_academic_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($qualificationds_academic_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $qualificationds_academic_list->showPageHeader(); ?>
<?php
$qualificationds_academic_list->showMessage();
?>
<?php if ($qualificationds_academic_list->TotalRecords > 0 || $qualificationds_academic->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($qualificationds_academic_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> qualificationds_academic">
<?php if (!$qualificationds_academic_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$qualificationds_academic_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualificationds_academic_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualificationds_academic_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fqualificationds_academiclist" id="fqualificationds_academiclist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualificationds_academic">
<div id="gmp_qualificationds_academic" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($qualificationds_academic_list->TotalRecords > 0 || $qualificationds_academic_list->isGridEdit()) { ?>
<table id="tbl_qualificationds_academiclist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$qualificationds_academic->RowType = ROWTYPE_HEADER;

// Render list options
$qualificationds_academic_list->renderListOptions();

// Render list options (header, left)
$qualificationds_academic_list->ListOptions->render("header", "left");
?>
<?php if ($qualificationds_academic_list->AcademicQualifications->Visible) { // AcademicQualifications ?>
	<?php if ($qualificationds_academic_list->SortUrl($qualificationds_academic_list->AcademicQualifications) == "") { ?>
		<th data-name="AcademicQualifications" class="<?php echo $qualificationds_academic_list->AcademicQualifications->headerCellClass() ?>"><div id="elh_qualificationds_academic_AcademicQualifications" class="qualificationds_academic_AcademicQualifications"><div class="ew-table-header-caption"><?php echo $qualificationds_academic_list->AcademicQualifications->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AcademicQualifications" class="<?php echo $qualificationds_academic_list->AcademicQualifications->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualificationds_academic_list->SortUrl($qualificationds_academic_list->AcademicQualifications) ?>', 1);"><div id="elh_qualificationds_academic_AcademicQualifications" class="qualificationds_academic_AcademicQualifications">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualificationds_academic_list->AcademicQualifications->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($qualificationds_academic_list->AcademicQualifications->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualificationds_academic_list->AcademicQualifications->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$qualificationds_academic_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($qualificationds_academic_list->ExportAll && $qualificationds_academic_list->isExport()) {
	$qualificationds_academic_list->StopRecord = $qualificationds_academic_list->TotalRecords;
} else {

	// Set the last record to display
	if ($qualificationds_academic_list->TotalRecords > $qualificationds_academic_list->StartRecord + $qualificationds_academic_list->DisplayRecords - 1)
		$qualificationds_academic_list->StopRecord = $qualificationds_academic_list->StartRecord + $qualificationds_academic_list->DisplayRecords - 1;
	else
		$qualificationds_academic_list->StopRecord = $qualificationds_academic_list->TotalRecords;
}
$qualificationds_academic_list->RecordCount = $qualificationds_academic_list->StartRecord - 1;
if ($qualificationds_academic_list->Recordset && !$qualificationds_academic_list->Recordset->EOF) {
	$qualificationds_academic_list->Recordset->moveFirst();
	$selectLimit = $qualificationds_academic_list->UseSelectLimit;
	if (!$selectLimit && $qualificationds_academic_list->StartRecord > 1)
		$qualificationds_academic_list->Recordset->move($qualificationds_academic_list->StartRecord - 1);
} elseif (!$qualificationds_academic->AllowAddDeleteRow && $qualificationds_academic_list->StopRecord == 0) {
	$qualificationds_academic_list->StopRecord = $qualificationds_academic->GridAddRowCount;
}

// Initialize aggregate
$qualificationds_academic->RowType = ROWTYPE_AGGREGATEINIT;
$qualificationds_academic->resetAttributes();
$qualificationds_academic_list->renderRow();
while ($qualificationds_academic_list->RecordCount < $qualificationds_academic_list->StopRecord) {
	$qualificationds_academic_list->RecordCount++;
	if ($qualificationds_academic_list->RecordCount >= $qualificationds_academic_list->StartRecord) {
		$qualificationds_academic_list->RowCount++;

		// Set up key count
		$qualificationds_academic_list->KeyCount = $qualificationds_academic_list->RowIndex;

		// Init row class and style
		$qualificationds_academic->resetAttributes();
		$qualificationds_academic->CssClass = "";
		if ($qualificationds_academic_list->isGridAdd()) {
		} else {
			$qualificationds_academic_list->loadRowValues($qualificationds_academic_list->Recordset); // Load row values
		}
		$qualificationds_academic->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$qualificationds_academic->RowAttrs->merge(["data-rowindex" => $qualificationds_academic_list->RowCount, "id" => "r" . $qualificationds_academic_list->RowCount . "_qualificationds_academic", "data-rowtype" => $qualificationds_academic->RowType]);

		// Render row
		$qualificationds_academic_list->renderRow();

		// Render list options
		$qualificationds_academic_list->renderListOptions();
?>
	<tr <?php echo $qualificationds_academic->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualificationds_academic_list->ListOptions->render("body", "left", $qualificationds_academic_list->RowCount);
?>
	<?php if ($qualificationds_academic_list->AcademicQualifications->Visible) { // AcademicQualifications ?>
		<td data-name="AcademicQualifications" <?php echo $qualificationds_academic_list->AcademicQualifications->cellAttributes() ?>>
<span id="el<?php echo $qualificationds_academic_list->RowCount ?>_qualificationds_academic_AcademicQualifications">
<span<?php echo $qualificationds_academic_list->AcademicQualifications->viewAttributes() ?>><?php echo $qualificationds_academic_list->AcademicQualifications->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualificationds_academic_list->ListOptions->render("body", "right", $qualificationds_academic_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$qualificationds_academic_list->isGridAdd())
		$qualificationds_academic_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$qualificationds_academic->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($qualificationds_academic_list->Recordset)
	$qualificationds_academic_list->Recordset->Close();
?>
<?php if (!$qualificationds_academic_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$qualificationds_academic_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualificationds_academic_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualificationds_academic_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($qualificationds_academic_list->TotalRecords == 0 && !$qualificationds_academic->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $qualificationds_academic_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$qualificationds_academic_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$qualificationds_academic_list->isExport()) { ?>
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
$qualificationds_academic_list->terminate();
?>