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
$la_sub_program_list = new la_sub_program_list();

// Run the page
$la_sub_program_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$la_sub_program_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$la_sub_program_list->isExport()) { ?>
<script>
var fla_sub_programlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fla_sub_programlist = currentForm = new ew.Form("fla_sub_programlist", "list");
	fla_sub_programlist.formKeyCountName = '<?php echo $la_sub_program_list->FormKeyCountName ?>';
	loadjs.done("fla_sub_programlist");
});
var fla_sub_programlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fla_sub_programlistsrch = currentSearchForm = new ew.Form("fla_sub_programlistsrch");

	// Dynamic selection lists
	// Filters

	fla_sub_programlistsrch.filterList = <?php echo $la_sub_program_list->getFilterList() ?>;

	// Init search panel as collapsed
	fla_sub_programlistsrch.initSearchPanel = true;
	loadjs.done("fla_sub_programlistsrch");
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
<?php if (!$la_sub_program_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($la_sub_program_list->TotalRecords > 0 && $la_sub_program_list->ExportOptions->visible()) { ?>
<?php $la_sub_program_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($la_sub_program_list->ImportOptions->visible()) { ?>
<?php $la_sub_program_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($la_sub_program_list->SearchOptions->visible()) { ?>
<?php $la_sub_program_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($la_sub_program_list->FilterOptions->visible()) { ?>
<?php $la_sub_program_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$la_sub_program_list->isExport() || Config("EXPORT_MASTER_RECORD") && $la_sub_program_list->isExport("print")) { ?>
<?php
if ($la_sub_program_list->DbMasterFilter != "" && $la_sub_program->getCurrentMasterTable() == "la_program") {
	if ($la_sub_program_list->MasterRecordExists) {
		include_once "la_programmaster.php";
	}
}
?>
<?php } ?>
<?php
$la_sub_program_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$la_sub_program_list->isExport() && !$la_sub_program->CurrentAction) { ?>
<form name="fla_sub_programlistsrch" id="fla_sub_programlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fla_sub_programlistsrch-search-panel" class="<?php echo $la_sub_program_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="la_sub_program">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $la_sub_program_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($la_sub_program_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($la_sub_program_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $la_sub_program_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($la_sub_program_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($la_sub_program_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($la_sub_program_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($la_sub_program_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $la_sub_program_list->showPageHeader(); ?>
<?php
$la_sub_program_list->showMessage();
?>
<?php if ($la_sub_program_list->TotalRecords > 0 || $la_sub_program->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($la_sub_program_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> la_sub_program">
<?php if (!$la_sub_program_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$la_sub_program_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_sub_program_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $la_sub_program_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fla_sub_programlist" id="fla_sub_programlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="la_sub_program">
<?php if ($la_sub_program->getCurrentMasterTable() == "la_program" && $la_sub_program->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="la_program">
<input type="hidden" name="fk_ProgramCode" value="<?php echo HtmlEncode($la_sub_program_list->ProgramCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_la_sub_program" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($la_sub_program_list->TotalRecords > 0 || $la_sub_program_list->isGridEdit()) { ?>
<table id="tbl_la_sub_programlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$la_sub_program->RowType = ROWTYPE_HEADER;

// Render list options
$la_sub_program_list->renderListOptions();

// Render list options (header, left)
$la_sub_program_list->ListOptions->render("header", "left");
?>
<?php if ($la_sub_program_list->ProgramCode->Visible) { // ProgramCode ?>
	<?php if ($la_sub_program_list->SortUrl($la_sub_program_list->ProgramCode) == "") { ?>
		<th data-name="ProgramCode" class="<?php echo $la_sub_program_list->ProgramCode->headerCellClass() ?>"><div id="elh_la_sub_program_ProgramCode" class="la_sub_program_ProgramCode"><div class="ew-table-header-caption"><?php echo $la_sub_program_list->ProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProgramCode" class="<?php echo $la_sub_program_list->ProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_sub_program_list->SortUrl($la_sub_program_list->ProgramCode) ?>', 1);"><div id="elh_la_sub_program_ProgramCode" class="la_sub_program_ProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_list->ProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_list->ProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_list->ProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_list->SubProgramCode->Visible) { // SubProgramCode ?>
	<?php if ($la_sub_program_list->SortUrl($la_sub_program_list->SubProgramCode) == "") { ?>
		<th data-name="SubProgramCode" class="<?php echo $la_sub_program_list->SubProgramCode->headerCellClass() ?>"><div id="elh_la_sub_program_SubProgramCode" class="la_sub_program_SubProgramCode"><div class="ew-table-header-caption"><?php echo $la_sub_program_list->SubProgramCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramCode" class="<?php echo $la_sub_program_list->SubProgramCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_sub_program_list->SortUrl($la_sub_program_list->SubProgramCode) ?>', 1);"><div id="elh_la_sub_program_SubProgramCode" class="la_sub_program_SubProgramCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_list->SubProgramCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_list->SubProgramCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_list->SubProgramCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_list->SubProgramName->Visible) { // SubProgramName ?>
	<?php if ($la_sub_program_list->SortUrl($la_sub_program_list->SubProgramName) == "") { ?>
		<th data-name="SubProgramName" class="<?php echo $la_sub_program_list->SubProgramName->headerCellClass() ?>"><div id="elh_la_sub_program_SubProgramName" class="la_sub_program_SubProgramName"><div class="ew-table-header-caption"><?php echo $la_sub_program_list->SubProgramName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramName" class="<?php echo $la_sub_program_list->SubProgramName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_sub_program_list->SortUrl($la_sub_program_list->SubProgramName) ?>', 1);"><div id="elh_la_sub_program_SubProgramName" class="la_sub_program_SubProgramName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_list->SubProgramName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_list->SubProgramName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_list->SubProgramName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($la_sub_program_list->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
	<?php if ($la_sub_program_list->SortUrl($la_sub_program_list->SubProgramPurpose) == "") { ?>
		<th data-name="SubProgramPurpose" class="<?php echo $la_sub_program_list->SubProgramPurpose->headerCellClass() ?>"><div id="elh_la_sub_program_SubProgramPurpose" class="la_sub_program_SubProgramPurpose"><div class="ew-table-header-caption"><?php echo $la_sub_program_list->SubProgramPurpose->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubProgramPurpose" class="<?php echo $la_sub_program_list->SubProgramPurpose->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $la_sub_program_list->SortUrl($la_sub_program_list->SubProgramPurpose) ?>', 1);"><div id="elh_la_sub_program_SubProgramPurpose" class="la_sub_program_SubProgramPurpose">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $la_sub_program_list->SubProgramPurpose->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($la_sub_program_list->SubProgramPurpose->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($la_sub_program_list->SubProgramPurpose->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$la_sub_program_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($la_sub_program_list->ExportAll && $la_sub_program_list->isExport()) {
	$la_sub_program_list->StopRecord = $la_sub_program_list->TotalRecords;
} else {

	// Set the last record to display
	if ($la_sub_program_list->TotalRecords > $la_sub_program_list->StartRecord + $la_sub_program_list->DisplayRecords - 1)
		$la_sub_program_list->StopRecord = $la_sub_program_list->StartRecord + $la_sub_program_list->DisplayRecords - 1;
	else
		$la_sub_program_list->StopRecord = $la_sub_program_list->TotalRecords;
}
$la_sub_program_list->RecordCount = $la_sub_program_list->StartRecord - 1;
if ($la_sub_program_list->Recordset && !$la_sub_program_list->Recordset->EOF) {
	$la_sub_program_list->Recordset->moveFirst();
	$selectLimit = $la_sub_program_list->UseSelectLimit;
	if (!$selectLimit && $la_sub_program_list->StartRecord > 1)
		$la_sub_program_list->Recordset->move($la_sub_program_list->StartRecord - 1);
} elseif (!$la_sub_program->AllowAddDeleteRow && $la_sub_program_list->StopRecord == 0) {
	$la_sub_program_list->StopRecord = $la_sub_program->GridAddRowCount;
}

// Initialize aggregate
$la_sub_program->RowType = ROWTYPE_AGGREGATEINIT;
$la_sub_program->resetAttributes();
$la_sub_program_list->renderRow();
while ($la_sub_program_list->RecordCount < $la_sub_program_list->StopRecord) {
	$la_sub_program_list->RecordCount++;
	if ($la_sub_program_list->RecordCount >= $la_sub_program_list->StartRecord) {
		$la_sub_program_list->RowCount++;

		// Set up key count
		$la_sub_program_list->KeyCount = $la_sub_program_list->RowIndex;

		// Init row class and style
		$la_sub_program->resetAttributes();
		$la_sub_program->CssClass = "";
		if ($la_sub_program_list->isGridAdd()) {
		} else {
			$la_sub_program_list->loadRowValues($la_sub_program_list->Recordset); // Load row values
		}
		$la_sub_program->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$la_sub_program->RowAttrs->merge(["data-rowindex" => $la_sub_program_list->RowCount, "id" => "r" . $la_sub_program_list->RowCount . "_la_sub_program", "data-rowtype" => $la_sub_program->RowType]);

		// Render row
		$la_sub_program_list->renderRow();

		// Render list options
		$la_sub_program_list->renderListOptions();
?>
	<tr <?php echo $la_sub_program->rowAttributes() ?>>
<?php

// Render list options (body, left)
$la_sub_program_list->ListOptions->render("body", "left", $la_sub_program_list->RowCount);
?>
	<?php if ($la_sub_program_list->ProgramCode->Visible) { // ProgramCode ?>
		<td data-name="ProgramCode" <?php echo $la_sub_program_list->ProgramCode->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_list->RowCount ?>_la_sub_program_ProgramCode">
<span<?php echo $la_sub_program_list->ProgramCode->viewAttributes() ?>><?php echo $la_sub_program_list->ProgramCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($la_sub_program_list->SubProgramCode->Visible) { // SubProgramCode ?>
		<td data-name="SubProgramCode" <?php echo $la_sub_program_list->SubProgramCode->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_list->RowCount ?>_la_sub_program_SubProgramCode">
<span<?php echo $la_sub_program_list->SubProgramCode->viewAttributes() ?>><?php echo $la_sub_program_list->SubProgramCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($la_sub_program_list->SubProgramName->Visible) { // SubProgramName ?>
		<td data-name="SubProgramName" <?php echo $la_sub_program_list->SubProgramName->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_list->RowCount ?>_la_sub_program_SubProgramName">
<span<?php echo $la_sub_program_list->SubProgramName->viewAttributes() ?>><?php echo $la_sub_program_list->SubProgramName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($la_sub_program_list->SubProgramPurpose->Visible) { // SubProgramPurpose ?>
		<td data-name="SubProgramPurpose" <?php echo $la_sub_program_list->SubProgramPurpose->cellAttributes() ?>>
<span id="el<?php echo $la_sub_program_list->RowCount ?>_la_sub_program_SubProgramPurpose">
<span<?php echo $la_sub_program_list->SubProgramPurpose->viewAttributes() ?>><?php echo $la_sub_program_list->SubProgramPurpose->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$la_sub_program_list->ListOptions->render("body", "right", $la_sub_program_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$la_sub_program_list->isGridAdd())
		$la_sub_program_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$la_sub_program->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($la_sub_program_list->Recordset)
	$la_sub_program_list->Recordset->Close();
?>
<?php if (!$la_sub_program_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$la_sub_program_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $la_sub_program_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $la_sub_program_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($la_sub_program_list->TotalRecords == 0 && !$la_sub_program->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $la_sub_program_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$la_sub_program_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$la_sub_program_list->isExport()) { ?>
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
$la_sub_program_list->terminate();
?>