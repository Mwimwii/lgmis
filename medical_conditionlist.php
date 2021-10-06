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
$medical_condition_list = new medical_condition_list();

// Run the page
$medical_condition_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$medical_condition_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$medical_condition_list->isExport()) { ?>
<script>
var fmedical_conditionlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fmedical_conditionlist = currentForm = new ew.Form("fmedical_conditionlist", "list");
	fmedical_conditionlist.formKeyCountName = '<?php echo $medical_condition_list->FormKeyCountName ?>';
	loadjs.done("fmedical_conditionlist");
});
var fmedical_conditionlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fmedical_conditionlistsrch = currentSearchForm = new ew.Form("fmedical_conditionlistsrch");

	// Dynamic selection lists
	// Filters

	fmedical_conditionlistsrch.filterList = <?php echo $medical_condition_list->getFilterList() ?>;

	// Init search panel as collapsed
	fmedical_conditionlistsrch.initSearchPanel = true;
	loadjs.done("fmedical_conditionlistsrch");
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
<?php if (!$medical_condition_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($medical_condition_list->TotalRecords > 0 && $medical_condition_list->ExportOptions->visible()) { ?>
<?php $medical_condition_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($medical_condition_list->ImportOptions->visible()) { ?>
<?php $medical_condition_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($medical_condition_list->SearchOptions->visible()) { ?>
<?php $medical_condition_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($medical_condition_list->FilterOptions->visible()) { ?>
<?php $medical_condition_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$medical_condition_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$medical_condition_list->isExport() && !$medical_condition->CurrentAction) { ?>
<form name="fmedical_conditionlistsrch" id="fmedical_conditionlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fmedical_conditionlistsrch-search-panel" class="<?php echo $medical_condition_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="medical_condition">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $medical_condition_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($medical_condition_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($medical_condition_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $medical_condition_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($medical_condition_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($medical_condition_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($medical_condition_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($medical_condition_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $medical_condition_list->showPageHeader(); ?>
<?php
$medical_condition_list->showMessage();
?>
<?php if ($medical_condition_list->TotalRecords > 0 || $medical_condition->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($medical_condition_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> medical_condition">
<?php if (!$medical_condition_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$medical_condition_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $medical_condition_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $medical_condition_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fmedical_conditionlist" id="fmedical_conditionlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="medical_condition">
<div id="gmp_medical_condition" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($medical_condition_list->TotalRecords > 0 || $medical_condition_list->isGridEdit()) { ?>
<table id="tbl_medical_conditionlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$medical_condition->RowType = ROWTYPE_HEADER;

// Render list options
$medical_condition_list->renderListOptions();

// Render list options (header, left)
$medical_condition_list->ListOptions->render("header", "left");
?>
<?php if ($medical_condition_list->MedicalCondition->Visible) { // MedicalCondition ?>
	<?php if ($medical_condition_list->SortUrl($medical_condition_list->MedicalCondition) == "") { ?>
		<th data-name="MedicalCondition" class="<?php echo $medical_condition_list->MedicalCondition->headerCellClass() ?>"><div id="elh_medical_condition_MedicalCondition" class="medical_condition_MedicalCondition"><div class="ew-table-header-caption"><?php echo $medical_condition_list->MedicalCondition->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MedicalCondition" class="<?php echo $medical_condition_list->MedicalCondition->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $medical_condition_list->SortUrl($medical_condition_list->MedicalCondition) ?>', 1);"><div id="elh_medical_condition_MedicalCondition" class="medical_condition_MedicalCondition">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $medical_condition_list->MedicalCondition->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($medical_condition_list->MedicalCondition->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($medical_condition_list->MedicalCondition->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$medical_condition_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($medical_condition_list->ExportAll && $medical_condition_list->isExport()) {
	$medical_condition_list->StopRecord = $medical_condition_list->TotalRecords;
} else {

	// Set the last record to display
	if ($medical_condition_list->TotalRecords > $medical_condition_list->StartRecord + $medical_condition_list->DisplayRecords - 1)
		$medical_condition_list->StopRecord = $medical_condition_list->StartRecord + $medical_condition_list->DisplayRecords - 1;
	else
		$medical_condition_list->StopRecord = $medical_condition_list->TotalRecords;
}
$medical_condition_list->RecordCount = $medical_condition_list->StartRecord - 1;
if ($medical_condition_list->Recordset && !$medical_condition_list->Recordset->EOF) {
	$medical_condition_list->Recordset->moveFirst();
	$selectLimit = $medical_condition_list->UseSelectLimit;
	if (!$selectLimit && $medical_condition_list->StartRecord > 1)
		$medical_condition_list->Recordset->move($medical_condition_list->StartRecord - 1);
} elseif (!$medical_condition->AllowAddDeleteRow && $medical_condition_list->StopRecord == 0) {
	$medical_condition_list->StopRecord = $medical_condition->GridAddRowCount;
}

// Initialize aggregate
$medical_condition->RowType = ROWTYPE_AGGREGATEINIT;
$medical_condition->resetAttributes();
$medical_condition_list->renderRow();
while ($medical_condition_list->RecordCount < $medical_condition_list->StopRecord) {
	$medical_condition_list->RecordCount++;
	if ($medical_condition_list->RecordCount >= $medical_condition_list->StartRecord) {
		$medical_condition_list->RowCount++;

		// Set up key count
		$medical_condition_list->KeyCount = $medical_condition_list->RowIndex;

		// Init row class and style
		$medical_condition->resetAttributes();
		$medical_condition->CssClass = "";
		if ($medical_condition_list->isGridAdd()) {
		} else {
			$medical_condition_list->loadRowValues($medical_condition_list->Recordset); // Load row values
		}
		$medical_condition->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$medical_condition->RowAttrs->merge(["data-rowindex" => $medical_condition_list->RowCount, "id" => "r" . $medical_condition_list->RowCount . "_medical_condition", "data-rowtype" => $medical_condition->RowType]);

		// Render row
		$medical_condition_list->renderRow();

		// Render list options
		$medical_condition_list->renderListOptions();
?>
	<tr <?php echo $medical_condition->rowAttributes() ?>>
<?php

// Render list options (body, left)
$medical_condition_list->ListOptions->render("body", "left", $medical_condition_list->RowCount);
?>
	<?php if ($medical_condition_list->MedicalCondition->Visible) { // MedicalCondition ?>
		<td data-name="MedicalCondition" <?php echo $medical_condition_list->MedicalCondition->cellAttributes() ?>>
<span id="el<?php echo $medical_condition_list->RowCount ?>_medical_condition_MedicalCondition">
<span<?php echo $medical_condition_list->MedicalCondition->viewAttributes() ?>><?php echo $medical_condition_list->MedicalCondition->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$medical_condition_list->ListOptions->render("body", "right", $medical_condition_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$medical_condition_list->isGridAdd())
		$medical_condition_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$medical_condition->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($medical_condition_list->Recordset)
	$medical_condition_list->Recordset->Close();
?>
<?php if (!$medical_condition_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$medical_condition_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $medical_condition_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $medical_condition_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($medical_condition_list->TotalRecords == 0 && !$medical_condition->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $medical_condition_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$medical_condition_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$medical_condition_list->isExport()) { ?>
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
$medical_condition_list->terminate();
?>