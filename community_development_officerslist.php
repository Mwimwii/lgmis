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
$community_development_officers_list = new community_development_officers_list();

// Run the page
$community_development_officers_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$community_development_officers_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$community_development_officers_list->isExport()) { ?>
<script>
var fcommunity_development_officerslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcommunity_development_officerslist = currentForm = new ew.Form("fcommunity_development_officerslist", "list");
	fcommunity_development_officerslist.formKeyCountName = '<?php echo $community_development_officers_list->FormKeyCountName ?>';
	loadjs.done("fcommunity_development_officerslist");
});
var fcommunity_development_officerslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcommunity_development_officerslistsrch = currentSearchForm = new ew.Form("fcommunity_development_officerslistsrch");

	// Dynamic selection lists
	// Filters

	fcommunity_development_officerslistsrch.filterList = <?php echo $community_development_officers_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcommunity_development_officerslistsrch.initSearchPanel = true;
	loadjs.done("fcommunity_development_officerslistsrch");
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
<?php if (!$community_development_officers_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($community_development_officers_list->TotalRecords > 0 && $community_development_officers_list->ExportOptions->visible()) { ?>
<?php $community_development_officers_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($community_development_officers_list->ImportOptions->visible()) { ?>
<?php $community_development_officers_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($community_development_officers_list->SearchOptions->visible()) { ?>
<?php $community_development_officers_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($community_development_officers_list->FilterOptions->visible()) { ?>
<?php $community_development_officers_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$community_development_officers_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$community_development_officers_list->isExport() && !$community_development_officers->CurrentAction) { ?>
<form name="fcommunity_development_officerslistsrch" id="fcommunity_development_officerslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcommunity_development_officerslistsrch-search-panel" class="<?php echo $community_development_officers_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="community_development_officers">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $community_development_officers_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($community_development_officers_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($community_development_officers_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $community_development_officers_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($community_development_officers_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($community_development_officers_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($community_development_officers_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($community_development_officers_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $community_development_officers_list->showPageHeader(); ?>
<?php
$community_development_officers_list->showMessage();
?>
<?php if ($community_development_officers_list->TotalRecords > 0 || $community_development_officers->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($community_development_officers_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> community_development_officers">
<?php if (!$community_development_officers_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$community_development_officers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $community_development_officers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $community_development_officers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcommunity_development_officerslist" id="fcommunity_development_officerslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="community_development_officers">
<div id="gmp_community_development_officers" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($community_development_officers_list->TotalRecords > 0 || $community_development_officers_list->isGridEdit()) { ?>
<table id="tbl_community_development_officerslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$community_development_officers->RowType = ROWTYPE_HEADER;

// Render list options
$community_development_officers_list->renderListOptions();

// Render list options (header, left)
$community_development_officers_list->ListOptions->render("header", "left");
?>
<?php if ($community_development_officers_list->LOCAL_AUTHORITY->Visible) { // LOCAL AUTHORITY ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->LOCAL_AUTHORITY) == "") { ?>
		<th data-name="LOCAL_AUTHORITY" class="<?php echo $community_development_officers_list->LOCAL_AUTHORITY->headerCellClass() ?>"><div id="elh_community_development_officers_LOCAL_AUTHORITY" class="community_development_officers_LOCAL_AUTHORITY"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->LOCAL_AUTHORITY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LOCAL_AUTHORITY" class="<?php echo $community_development_officers_list->LOCAL_AUTHORITY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->LOCAL_AUTHORITY) ?>', 1);"><div id="elh_community_development_officers_LOCAL_AUTHORITY" class="community_development_officers_LOCAL_AUTHORITY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->LOCAL_AUTHORITY->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->LOCAL_AUTHORITY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->LOCAL_AUTHORITY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($community_development_officers_list->FULL_NAME->Visible) { // FULL NAME ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->FULL_NAME) == "") { ?>
		<th data-name="FULL_NAME" class="<?php echo $community_development_officers_list->FULL_NAME->headerCellClass() ?>"><div id="elh_community_development_officers_FULL_NAME" class="community_development_officers_FULL_NAME"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->FULL_NAME->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FULL_NAME" class="<?php echo $community_development_officers_list->FULL_NAME->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->FULL_NAME) ?>', 1);"><div id="elh_community_development_officers_FULL_NAME" class="community_development_officers_FULL_NAME">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->FULL_NAME->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->FULL_NAME->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->FULL_NAME->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($community_development_officers_list->SEX->Visible) { // SEX ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->SEX) == "") { ?>
		<th data-name="SEX" class="<?php echo $community_development_officers_list->SEX->headerCellClass() ?>"><div id="elh_community_development_officers_SEX" class="community_development_officers_SEX"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->SEX->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SEX" class="<?php echo $community_development_officers_list->SEX->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->SEX) ?>', 1);"><div id="elh_community_development_officers_SEX" class="community_development_officers_SEX">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->SEX->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->SEX->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->SEX->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($community_development_officers_list->DATE_OF_BIRTH->Visible) { // DATE OF BIRTH ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->DATE_OF_BIRTH) == "") { ?>
		<th data-name="DATE_OF_BIRTH" class="<?php echo $community_development_officers_list->DATE_OF_BIRTH->headerCellClass() ?>"><div id="elh_community_development_officers_DATE_OF_BIRTH" class="community_development_officers_DATE_OF_BIRTH"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->DATE_OF_BIRTH->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DATE_OF_BIRTH" class="<?php echo $community_development_officers_list->DATE_OF_BIRTH->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->DATE_OF_BIRTH) ?>', 1);"><div id="elh_community_development_officers_DATE_OF_BIRTH" class="community_development_officers_DATE_OF_BIRTH">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->DATE_OF_BIRTH->caption() ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->DATE_OF_BIRTH->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->DATE_OF_BIRTH->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($community_development_officers_list->POSITION_NAME->Visible) { // POSITION NAME ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->POSITION_NAME) == "") { ?>
		<th data-name="POSITION_NAME" class="<?php echo $community_development_officers_list->POSITION_NAME->headerCellClass() ?>"><div id="elh_community_development_officers_POSITION_NAME" class="community_development_officers_POSITION_NAME"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->POSITION_NAME->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="POSITION_NAME" class="<?php echo $community_development_officers_list->POSITION_NAME->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->POSITION_NAME) ?>', 1);"><div id="elh_community_development_officers_POSITION_NAME" class="community_development_officers_POSITION_NAME">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->POSITION_NAME->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->POSITION_NAME->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->POSITION_NAME->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->Visible) { // DATE OF FIRST APPOINTMENT ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->DATE_OF_FIRST_APPOINTMENT) == "") { ?>
		<th data-name="DATE_OF_FIRST_APPOINTMENT" class="<?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->headerCellClass() ?>"><div id="elh_community_development_officers_DATE_OF_FIRST_APPOINTMENT" class="community_development_officers_DATE_OF_FIRST_APPOINTMENT"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DATE_OF_FIRST_APPOINTMENT" class="<?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->DATE_OF_FIRST_APPOINTMENT) ?>', 1);"><div id="elh_community_development_officers_DATE_OF_FIRST_APPOINTMENT" class="community_development_officers_DATE_OF_FIRST_APPOINTMENT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->caption() ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($community_development_officers_list->LENGTH_OF_STAY->Visible) { // LENGTH OF STAY ?>
	<?php if ($community_development_officers_list->SortUrl($community_development_officers_list->LENGTH_OF_STAY) == "") { ?>
		<th data-name="LENGTH_OF_STAY" class="<?php echo $community_development_officers_list->LENGTH_OF_STAY->headerCellClass() ?>"><div id="elh_community_development_officers_LENGTH_OF_STAY" class="community_development_officers_LENGTH_OF_STAY"><div class="ew-table-header-caption"><?php echo $community_development_officers_list->LENGTH_OF_STAY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LENGTH_OF_STAY" class="<?php echo $community_development_officers_list->LENGTH_OF_STAY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $community_development_officers_list->SortUrl($community_development_officers_list->LENGTH_OF_STAY) ?>', 1);"><div id="elh_community_development_officers_LENGTH_OF_STAY" class="community_development_officers_LENGTH_OF_STAY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $community_development_officers_list->LENGTH_OF_STAY->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($community_development_officers_list->LENGTH_OF_STAY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($community_development_officers_list->LENGTH_OF_STAY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$community_development_officers_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($community_development_officers_list->ExportAll && $community_development_officers_list->isExport()) {
	$community_development_officers_list->StopRecord = $community_development_officers_list->TotalRecords;
} else {

	// Set the last record to display
	if ($community_development_officers_list->TotalRecords > $community_development_officers_list->StartRecord + $community_development_officers_list->DisplayRecords - 1)
		$community_development_officers_list->StopRecord = $community_development_officers_list->StartRecord + $community_development_officers_list->DisplayRecords - 1;
	else
		$community_development_officers_list->StopRecord = $community_development_officers_list->TotalRecords;
}
$community_development_officers_list->RecordCount = $community_development_officers_list->StartRecord - 1;
if ($community_development_officers_list->Recordset && !$community_development_officers_list->Recordset->EOF) {
	$community_development_officers_list->Recordset->moveFirst();
	$selectLimit = $community_development_officers_list->UseSelectLimit;
	if (!$selectLimit && $community_development_officers_list->StartRecord > 1)
		$community_development_officers_list->Recordset->move($community_development_officers_list->StartRecord - 1);
} elseif (!$community_development_officers->AllowAddDeleteRow && $community_development_officers_list->StopRecord == 0) {
	$community_development_officers_list->StopRecord = $community_development_officers->GridAddRowCount;
}

// Initialize aggregate
$community_development_officers->RowType = ROWTYPE_AGGREGATEINIT;
$community_development_officers->resetAttributes();
$community_development_officers_list->renderRow();
while ($community_development_officers_list->RecordCount < $community_development_officers_list->StopRecord) {
	$community_development_officers_list->RecordCount++;
	if ($community_development_officers_list->RecordCount >= $community_development_officers_list->StartRecord) {
		$community_development_officers_list->RowCount++;

		// Set up key count
		$community_development_officers_list->KeyCount = $community_development_officers_list->RowIndex;

		// Init row class and style
		$community_development_officers->resetAttributes();
		$community_development_officers->CssClass = "";
		if ($community_development_officers_list->isGridAdd()) {
		} else {
			$community_development_officers_list->loadRowValues($community_development_officers_list->Recordset); // Load row values
		}
		$community_development_officers->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$community_development_officers->RowAttrs->merge(["data-rowindex" => $community_development_officers_list->RowCount, "id" => "r" . $community_development_officers_list->RowCount . "_community_development_officers", "data-rowtype" => $community_development_officers->RowType]);

		// Render row
		$community_development_officers_list->renderRow();

		// Render list options
		$community_development_officers_list->renderListOptions();
?>
	<tr <?php echo $community_development_officers->rowAttributes() ?>>
<?php

// Render list options (body, left)
$community_development_officers_list->ListOptions->render("body", "left", $community_development_officers_list->RowCount);
?>
	<?php if ($community_development_officers_list->LOCAL_AUTHORITY->Visible) { // LOCAL AUTHORITY ?>
		<td data-name="LOCAL_AUTHORITY" <?php echo $community_development_officers_list->LOCAL_AUTHORITY->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_LOCAL_AUTHORITY">
<span<?php echo $community_development_officers_list->LOCAL_AUTHORITY->viewAttributes() ?>><?php echo $community_development_officers_list->LOCAL_AUTHORITY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($community_development_officers_list->FULL_NAME->Visible) { // FULL NAME ?>
		<td data-name="FULL_NAME" <?php echo $community_development_officers_list->FULL_NAME->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_FULL_NAME">
<span<?php echo $community_development_officers_list->FULL_NAME->viewAttributes() ?>><?php echo $community_development_officers_list->FULL_NAME->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($community_development_officers_list->SEX->Visible) { // SEX ?>
		<td data-name="SEX" <?php echo $community_development_officers_list->SEX->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_SEX">
<span<?php echo $community_development_officers_list->SEX->viewAttributes() ?>><?php echo $community_development_officers_list->SEX->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($community_development_officers_list->DATE_OF_BIRTH->Visible) { // DATE OF BIRTH ?>
		<td data-name="DATE_OF_BIRTH" <?php echo $community_development_officers_list->DATE_OF_BIRTH->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_DATE_OF_BIRTH">
<span<?php echo $community_development_officers_list->DATE_OF_BIRTH->viewAttributes() ?>><?php echo $community_development_officers_list->DATE_OF_BIRTH->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($community_development_officers_list->POSITION_NAME->Visible) { // POSITION NAME ?>
		<td data-name="POSITION_NAME" <?php echo $community_development_officers_list->POSITION_NAME->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_POSITION_NAME">
<span<?php echo $community_development_officers_list->POSITION_NAME->viewAttributes() ?>><?php echo $community_development_officers_list->POSITION_NAME->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->Visible) { // DATE OF FIRST APPOINTMENT ?>
		<td data-name="DATE_OF_FIRST_APPOINTMENT" <?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_DATE_OF_FIRST_APPOINTMENT">
<span<?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->viewAttributes() ?>><?php echo $community_development_officers_list->DATE_OF_FIRST_APPOINTMENT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($community_development_officers_list->LENGTH_OF_STAY->Visible) { // LENGTH OF STAY ?>
		<td data-name="LENGTH_OF_STAY" <?php echo $community_development_officers_list->LENGTH_OF_STAY->cellAttributes() ?>>
<span id="el<?php echo $community_development_officers_list->RowCount ?>_community_development_officers_LENGTH_OF_STAY">
<span<?php echo $community_development_officers_list->LENGTH_OF_STAY->viewAttributes() ?>><?php echo $community_development_officers_list->LENGTH_OF_STAY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$community_development_officers_list->ListOptions->render("body", "right", $community_development_officers_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$community_development_officers_list->isGridAdd())
		$community_development_officers_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$community_development_officers->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($community_development_officers_list->Recordset)
	$community_development_officers_list->Recordset->Close();
?>
<?php if (!$community_development_officers_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$community_development_officers_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $community_development_officers_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $community_development_officers_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($community_development_officers_list->TotalRecords == 0 && !$community_development_officers->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $community_development_officers_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$community_development_officers_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$community_development_officers_list->isExport()) { ?>
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
$community_development_officers_list->terminate();
?>