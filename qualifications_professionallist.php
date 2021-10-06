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
$qualifications_professional_list = new qualifications_professional_list();

// Run the page
$qualifications_professional_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$qualifications_professional_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$qualifications_professional_list->isExport()) { ?>
<script>
var fqualifications_professionallist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fqualifications_professionallist = currentForm = new ew.Form("fqualifications_professionallist", "list");
	fqualifications_professionallist.formKeyCountName = '<?php echo $qualifications_professional_list->FormKeyCountName ?>';
	loadjs.done("fqualifications_professionallist");
});
var fqualifications_professionallistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fqualifications_professionallistsrch = currentSearchForm = new ew.Form("fqualifications_professionallistsrch");

	// Dynamic selection lists
	// Filters

	fqualifications_professionallistsrch.filterList = <?php echo $qualifications_professional_list->getFilterList() ?>;

	// Init search panel as collapsed
	fqualifications_professionallistsrch.initSearchPanel = true;
	loadjs.done("fqualifications_professionallistsrch");
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
<?php if (!$qualifications_professional_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($qualifications_professional_list->TotalRecords > 0 && $qualifications_professional_list->ExportOptions->visible()) { ?>
<?php $qualifications_professional_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($qualifications_professional_list->ImportOptions->visible()) { ?>
<?php $qualifications_professional_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($qualifications_professional_list->SearchOptions->visible()) { ?>
<?php $qualifications_professional_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($qualifications_professional_list->FilterOptions->visible()) { ?>
<?php $qualifications_professional_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$qualifications_professional_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$qualifications_professional_list->isExport() && !$qualifications_professional->CurrentAction) { ?>
<form name="fqualifications_professionallistsrch" id="fqualifications_professionallistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fqualifications_professionallistsrch-search-panel" class="<?php echo $qualifications_professional_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="qualifications_professional">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $qualifications_professional_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($qualifications_professional_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($qualifications_professional_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $qualifications_professional_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($qualifications_professional_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($qualifications_professional_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($qualifications_professional_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($qualifications_professional_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $qualifications_professional_list->showPageHeader(); ?>
<?php
$qualifications_professional_list->showMessage();
?>
<?php if ($qualifications_professional_list->TotalRecords > 0 || $qualifications_professional->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($qualifications_professional_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> qualifications_professional">
<?php if (!$qualifications_professional_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$qualifications_professional_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualifications_professional_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualifications_professional_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fqualifications_professionallist" id="fqualifications_professionallist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="qualifications_professional">
<div id="gmp_qualifications_professional" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($qualifications_professional_list->TotalRecords > 0 || $qualifications_professional_list->isGridEdit()) { ?>
<table id="tbl_qualifications_professionallist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$qualifications_professional->RowType = ROWTYPE_HEADER;

// Render list options
$qualifications_professional_list->renderListOptions();

// Render list options (header, left)
$qualifications_professional_list->ListOptions->render("header", "left");
?>
<?php if ($qualifications_professional_list->ProfessionalQualifications->Visible) { // ProfessionalQualifications ?>
	<?php if ($qualifications_professional_list->SortUrl($qualifications_professional_list->ProfessionalQualifications) == "") { ?>
		<th data-name="ProfessionalQualifications" class="<?php echo $qualifications_professional_list->ProfessionalQualifications->headerCellClass() ?>"><div id="elh_qualifications_professional_ProfessionalQualifications" class="qualifications_professional_ProfessionalQualifications"><div class="ew-table-header-caption"><?php echo $qualifications_professional_list->ProfessionalQualifications->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProfessionalQualifications" class="<?php echo $qualifications_professional_list->ProfessionalQualifications->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $qualifications_professional_list->SortUrl($qualifications_professional_list->ProfessionalQualifications) ?>', 1);"><div id="elh_qualifications_professional_ProfessionalQualifications" class="qualifications_professional_ProfessionalQualifications">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $qualifications_professional_list->ProfessionalQualifications->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($qualifications_professional_list->ProfessionalQualifications->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($qualifications_professional_list->ProfessionalQualifications->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$qualifications_professional_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($qualifications_professional_list->ExportAll && $qualifications_professional_list->isExport()) {
	$qualifications_professional_list->StopRecord = $qualifications_professional_list->TotalRecords;
} else {

	// Set the last record to display
	if ($qualifications_professional_list->TotalRecords > $qualifications_professional_list->StartRecord + $qualifications_professional_list->DisplayRecords - 1)
		$qualifications_professional_list->StopRecord = $qualifications_professional_list->StartRecord + $qualifications_professional_list->DisplayRecords - 1;
	else
		$qualifications_professional_list->StopRecord = $qualifications_professional_list->TotalRecords;
}
$qualifications_professional_list->RecordCount = $qualifications_professional_list->StartRecord - 1;
if ($qualifications_professional_list->Recordset && !$qualifications_professional_list->Recordset->EOF) {
	$qualifications_professional_list->Recordset->moveFirst();
	$selectLimit = $qualifications_professional_list->UseSelectLimit;
	if (!$selectLimit && $qualifications_professional_list->StartRecord > 1)
		$qualifications_professional_list->Recordset->move($qualifications_professional_list->StartRecord - 1);
} elseif (!$qualifications_professional->AllowAddDeleteRow && $qualifications_professional_list->StopRecord == 0) {
	$qualifications_professional_list->StopRecord = $qualifications_professional->GridAddRowCount;
}

// Initialize aggregate
$qualifications_professional->RowType = ROWTYPE_AGGREGATEINIT;
$qualifications_professional->resetAttributes();
$qualifications_professional_list->renderRow();
while ($qualifications_professional_list->RecordCount < $qualifications_professional_list->StopRecord) {
	$qualifications_professional_list->RecordCount++;
	if ($qualifications_professional_list->RecordCount >= $qualifications_professional_list->StartRecord) {
		$qualifications_professional_list->RowCount++;

		// Set up key count
		$qualifications_professional_list->KeyCount = $qualifications_professional_list->RowIndex;

		// Init row class and style
		$qualifications_professional->resetAttributes();
		$qualifications_professional->CssClass = "";
		if ($qualifications_professional_list->isGridAdd()) {
		} else {
			$qualifications_professional_list->loadRowValues($qualifications_professional_list->Recordset); // Load row values
		}
		$qualifications_professional->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$qualifications_professional->RowAttrs->merge(["data-rowindex" => $qualifications_professional_list->RowCount, "id" => "r" . $qualifications_professional_list->RowCount . "_qualifications_professional", "data-rowtype" => $qualifications_professional->RowType]);

		// Render row
		$qualifications_professional_list->renderRow();

		// Render list options
		$qualifications_professional_list->renderListOptions();
?>
	<tr <?php echo $qualifications_professional->rowAttributes() ?>>
<?php

// Render list options (body, left)
$qualifications_professional_list->ListOptions->render("body", "left", $qualifications_professional_list->RowCount);
?>
	<?php if ($qualifications_professional_list->ProfessionalQualifications->Visible) { // ProfessionalQualifications ?>
		<td data-name="ProfessionalQualifications" <?php echo $qualifications_professional_list->ProfessionalQualifications->cellAttributes() ?>>
<span id="el<?php echo $qualifications_professional_list->RowCount ?>_qualifications_professional_ProfessionalQualifications">
<span<?php echo $qualifications_professional_list->ProfessionalQualifications->viewAttributes() ?>><?php echo $qualifications_professional_list->ProfessionalQualifications->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$qualifications_professional_list->ListOptions->render("body", "right", $qualifications_professional_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$qualifications_professional_list->isGridAdd())
		$qualifications_professional_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$qualifications_professional->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($qualifications_professional_list->Recordset)
	$qualifications_professional_list->Recordset->Close();
?>
<?php if (!$qualifications_professional_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$qualifications_professional_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $qualifications_professional_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $qualifications_professional_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($qualifications_professional_list->TotalRecords == 0 && !$qualifications_professional->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $qualifications_professional_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$qualifications_professional_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$qualifications_professional_list->isExport()) { ?>
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
$qualifications_professional_list->terminate();
?>