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
$paye_schedule_2_list = new paye_schedule_2_list();

// Run the page
$paye_schedule_2_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$paye_schedule_2_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$paye_schedule_2_list->isExport()) { ?>
<script>
var fpaye_schedule_2list, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpaye_schedule_2list = currentForm = new ew.Form("fpaye_schedule_2list", "list");
	fpaye_schedule_2list.formKeyCountName = '<?php echo $paye_schedule_2_list->FormKeyCountName ?>';
	loadjs.done("fpaye_schedule_2list");
});
var fpaye_schedule_2listsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpaye_schedule_2listsrch = currentSearchForm = new ew.Form("fpaye_schedule_2listsrch");

	// Dynamic selection lists
	// Filters

	fpaye_schedule_2listsrch.filterList = <?php echo $paye_schedule_2_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpaye_schedule_2listsrch.initSearchPanel = true;
	loadjs.done("fpaye_schedule_2listsrch");
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
<?php if (!$paye_schedule_2_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($paye_schedule_2_list->TotalRecords > 0 && $paye_schedule_2_list->ExportOptions->visible()) { ?>
<?php $paye_schedule_2_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_schedule_2_list->ImportOptions->visible()) { ?>
<?php $paye_schedule_2_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($paye_schedule_2_list->SearchOptions->visible()) { ?>
<?php $paye_schedule_2_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($paye_schedule_2_list->FilterOptions->visible()) { ?>
<?php $paye_schedule_2_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$paye_schedule_2_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$paye_schedule_2_list->isExport() && !$paye_schedule_2->CurrentAction) { ?>
<form name="fpaye_schedule_2listsrch" id="fpaye_schedule_2listsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpaye_schedule_2listsrch-search-panel" class="<?php echo $paye_schedule_2_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="paye_schedule_2">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $paye_schedule_2_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($paye_schedule_2_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($paye_schedule_2_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $paye_schedule_2_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($paye_schedule_2_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($paye_schedule_2_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($paye_schedule_2_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($paye_schedule_2_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $paye_schedule_2_list->showPageHeader(); ?>
<?php
$paye_schedule_2_list->showMessage();
?>
<?php if ($paye_schedule_2_list->TotalRecords > 0 || $paye_schedule_2->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($paye_schedule_2_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> paye_schedule_2">
<?php if (!$paye_schedule_2_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$paye_schedule_2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_schedule_2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_schedule_2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpaye_schedule_2list" id="fpaye_schedule_2list" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="paye_schedule_2">
<div id="gmp_paye_schedule_2" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($paye_schedule_2_list->TotalRecords > 0 || $paye_schedule_2_list->isGridEdit()) { ?>
<table id="tbl_paye_schedule_2list" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$paye_schedule_2->RowType = ROWTYPE_HEADER;

// Render list options
$paye_schedule_2_list->renderListOptions();

// Render list options (header, left)
$paye_schedule_2_list->ListOptions->render("header", "left");
?>
<?php if ($paye_schedule_2_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_schedule_2_list->EmployeeID->headerCellClass() ?>"><div id="elh_paye_schedule_2_EmployeeID" class="paye_schedule_2_EmployeeID"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $paye_schedule_2_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->EmployeeID) ?>', 1);"><div id="elh_paye_schedule_2_EmployeeID" class="paye_schedule_2_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->Surname->Visible) { // Surname ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $paye_schedule_2_list->Surname->headerCellClass() ?>"><div id="elh_paye_schedule_2_Surname" class="paye_schedule_2_Surname"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $paye_schedule_2_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->Surname) ?>', 1);"><div id="elh_paye_schedule_2_Surname" class="paye_schedule_2_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->FirstName->Visible) { // FirstName ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $paye_schedule_2_list->FirstName->headerCellClass() ?>"><div id="elh_paye_schedule_2_FirstName" class="paye_schedule_2_FirstName"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $paye_schedule_2_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->FirstName) ?>', 1);"><div id="elh_paye_schedule_2_FirstName" class="paye_schedule_2_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->NRC->Visible) { // NRC ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->NRC) == "") { ?>
		<th data-name="NRC" class="<?php echo $paye_schedule_2_list->NRC->headerCellClass() ?>"><div id="elh_paye_schedule_2_NRC" class="paye_schedule_2_NRC"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->NRC->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NRC" class="<?php echo $paye_schedule_2_list->NRC->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->NRC) ?>', 1);"><div id="elh_paye_schedule_2_NRC" class="paye_schedule_2_NRC">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->NRC->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->NRC->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->NRC->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->Pay_This_Month->Visible) { // Pay This Month ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->Pay_This_Month) == "") { ?>
		<th data-name="Pay_This_Month" class="<?php echo $paye_schedule_2_list->Pay_This_Month->headerCellClass() ?>"><div id="elh_paye_schedule_2_Pay_This_Month" class="paye_schedule_2_Pay_This_Month"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Pay_This_Month->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Pay_This_Month" class="<?php echo $paye_schedule_2_list->Pay_This_Month->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->Pay_This_Month) ?>', 1);"><div id="elh_paye_schedule_2_Pay_This_Month" class="paye_schedule_2_Pay_This_Month">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Pay_This_Month->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->Pay_This_Month->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->Pay_This_Month->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->Taxable_Pay_YTD->Visible) { // Taxable Pay YTD ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->Taxable_Pay_YTD) == "") { ?>
		<th data-name="Taxable_Pay_YTD" class="<?php echo $paye_schedule_2_list->Taxable_Pay_YTD->headerCellClass() ?>"><div id="elh_paye_schedule_2_Taxable_Pay_YTD" class="paye_schedule_2_Taxable_Pay_YTD"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Taxable_Pay_YTD->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Taxable_Pay_YTD" class="<?php echo $paye_schedule_2_list->Taxable_Pay_YTD->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->Taxable_Pay_YTD) ?>', 1);"><div id="elh_paye_schedule_2_Taxable_Pay_YTD" class="paye_schedule_2_Taxable_Pay_YTD">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Taxable_Pay_YTD->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->Taxable_Pay_YTD->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->Taxable_Pay_YTD->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->Tax_To_Date->Visible) { // Tax To Date ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->Tax_To_Date) == "") { ?>
		<th data-name="Tax_To_Date" class="<?php echo $paye_schedule_2_list->Tax_To_Date->headerCellClass() ?>"><div id="elh_paye_schedule_2_Tax_To_Date" class="paye_schedule_2_Tax_To_Date"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Tax_To_Date->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tax_To_Date" class="<?php echo $paye_schedule_2_list->Tax_To_Date->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->Tax_To_Date) ?>', 1);"><div id="elh_paye_schedule_2_Tax_To_Date" class="paye_schedule_2_Tax_To_Date">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Tax_To_Date->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->Tax_To_Date->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->Tax_To_Date->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($paye_schedule_2_list->Tax_This_Mouth->Visible) { // Tax This Mouth ?>
	<?php if ($paye_schedule_2_list->SortUrl($paye_schedule_2_list->Tax_This_Mouth) == "") { ?>
		<th data-name="Tax_This_Mouth" class="<?php echo $paye_schedule_2_list->Tax_This_Mouth->headerCellClass() ?>"><div id="elh_paye_schedule_2_Tax_This_Mouth" class="paye_schedule_2_Tax_This_Mouth"><div class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Tax_This_Mouth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tax_This_Mouth" class="<?php echo $paye_schedule_2_list->Tax_This_Mouth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $paye_schedule_2_list->SortUrl($paye_schedule_2_list->Tax_This_Mouth) ?>', 1);"><div id="elh_paye_schedule_2_Tax_This_Mouth" class="paye_schedule_2_Tax_This_Mouth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $paye_schedule_2_list->Tax_This_Mouth->caption() ?></span><span class="ew-table-header-sort"><?php if ($paye_schedule_2_list->Tax_This_Mouth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($paye_schedule_2_list->Tax_This_Mouth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$paye_schedule_2_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($paye_schedule_2_list->ExportAll && $paye_schedule_2_list->isExport()) {
	$paye_schedule_2_list->StopRecord = $paye_schedule_2_list->TotalRecords;
} else {

	// Set the last record to display
	if ($paye_schedule_2_list->TotalRecords > $paye_schedule_2_list->StartRecord + $paye_schedule_2_list->DisplayRecords - 1)
		$paye_schedule_2_list->StopRecord = $paye_schedule_2_list->StartRecord + $paye_schedule_2_list->DisplayRecords - 1;
	else
		$paye_schedule_2_list->StopRecord = $paye_schedule_2_list->TotalRecords;
}
$paye_schedule_2_list->RecordCount = $paye_schedule_2_list->StartRecord - 1;
if ($paye_schedule_2_list->Recordset && !$paye_schedule_2_list->Recordset->EOF) {
	$paye_schedule_2_list->Recordset->moveFirst();
	$selectLimit = $paye_schedule_2_list->UseSelectLimit;
	if (!$selectLimit && $paye_schedule_2_list->StartRecord > 1)
		$paye_schedule_2_list->Recordset->move($paye_schedule_2_list->StartRecord - 1);
} elseif (!$paye_schedule_2->AllowAddDeleteRow && $paye_schedule_2_list->StopRecord == 0) {
	$paye_schedule_2_list->StopRecord = $paye_schedule_2->GridAddRowCount;
}

// Initialize aggregate
$paye_schedule_2->RowType = ROWTYPE_AGGREGATEINIT;
$paye_schedule_2->resetAttributes();
$paye_schedule_2_list->renderRow();
while ($paye_schedule_2_list->RecordCount < $paye_schedule_2_list->StopRecord) {
	$paye_schedule_2_list->RecordCount++;
	if ($paye_schedule_2_list->RecordCount >= $paye_schedule_2_list->StartRecord) {
		$paye_schedule_2_list->RowCount++;

		// Set up key count
		$paye_schedule_2_list->KeyCount = $paye_schedule_2_list->RowIndex;

		// Init row class and style
		$paye_schedule_2->resetAttributes();
		$paye_schedule_2->CssClass = "";
		if ($paye_schedule_2_list->isGridAdd()) {
		} else {
			$paye_schedule_2_list->loadRowValues($paye_schedule_2_list->Recordset); // Load row values
		}
		$paye_schedule_2->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$paye_schedule_2->RowAttrs->merge(["data-rowindex" => $paye_schedule_2_list->RowCount, "id" => "r" . $paye_schedule_2_list->RowCount . "_paye_schedule_2", "data-rowtype" => $paye_schedule_2->RowType]);

		// Render row
		$paye_schedule_2_list->renderRow();

		// Render list options
		$paye_schedule_2_list->renderListOptions();
?>
	<tr <?php echo $paye_schedule_2->rowAttributes() ?>>
<?php

// Render list options (body, left)
$paye_schedule_2_list->ListOptions->render("body", "left", $paye_schedule_2_list->RowCount);
?>
	<?php if ($paye_schedule_2_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $paye_schedule_2_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_EmployeeID">
<span<?php echo $paye_schedule_2_list->EmployeeID->viewAttributes() ?>><?php echo $paye_schedule_2_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $paye_schedule_2_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_Surname">
<span<?php echo $paye_schedule_2_list->Surname->viewAttributes() ?>><?php echo $paye_schedule_2_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $paye_schedule_2_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_FirstName">
<span<?php echo $paye_schedule_2_list->FirstName->viewAttributes() ?>><?php echo $paye_schedule_2_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->NRC->Visible) { // NRC ?>
		<td data-name="NRC" <?php echo $paye_schedule_2_list->NRC->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_NRC">
<span<?php echo $paye_schedule_2_list->NRC->viewAttributes() ?>><?php echo $paye_schedule_2_list->NRC->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->Pay_This_Month->Visible) { // Pay This Month ?>
		<td data-name="Pay_This_Month" <?php echo $paye_schedule_2_list->Pay_This_Month->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_Pay_This_Month">
<span<?php echo $paye_schedule_2_list->Pay_This_Month->viewAttributes() ?>><?php echo $paye_schedule_2_list->Pay_This_Month->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->Taxable_Pay_YTD->Visible) { // Taxable Pay YTD ?>
		<td data-name="Taxable_Pay_YTD" <?php echo $paye_schedule_2_list->Taxable_Pay_YTD->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_Taxable_Pay_YTD">
<span<?php echo $paye_schedule_2_list->Taxable_Pay_YTD->viewAttributes() ?>><?php echo $paye_schedule_2_list->Taxable_Pay_YTD->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->Tax_To_Date->Visible) { // Tax To Date ?>
		<td data-name="Tax_To_Date" <?php echo $paye_schedule_2_list->Tax_To_Date->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_Tax_To_Date">
<span<?php echo $paye_schedule_2_list->Tax_To_Date->viewAttributes() ?>><?php echo $paye_schedule_2_list->Tax_To_Date->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($paye_schedule_2_list->Tax_This_Mouth->Visible) { // Tax This Mouth ?>
		<td data-name="Tax_This_Mouth" <?php echo $paye_schedule_2_list->Tax_This_Mouth->cellAttributes() ?>>
<span id="el<?php echo $paye_schedule_2_list->RowCount ?>_paye_schedule_2_Tax_This_Mouth">
<span<?php echo $paye_schedule_2_list->Tax_This_Mouth->viewAttributes() ?>><?php echo $paye_schedule_2_list->Tax_This_Mouth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$paye_schedule_2_list->ListOptions->render("body", "right", $paye_schedule_2_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$paye_schedule_2_list->isGridAdd())
		$paye_schedule_2_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$paye_schedule_2->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($paye_schedule_2_list->Recordset)
	$paye_schedule_2_list->Recordset->Close();
?>
<?php if (!$paye_schedule_2_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$paye_schedule_2_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $paye_schedule_2_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $paye_schedule_2_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($paye_schedule_2_list->TotalRecords == 0 && !$paye_schedule_2->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $paye_schedule_2_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$paye_schedule_2_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$paye_schedule_2_list->isExport()) { ?>
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
$paye_schedule_2_list->terminate();
?>