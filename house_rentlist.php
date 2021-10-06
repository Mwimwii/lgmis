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
$house_rent_list = new house_rent_list();

// Run the page
$house_rent_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$house_rent_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$house_rent_list->isExport()) { ?>
<script>
var fhouse_rentlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fhouse_rentlist = currentForm = new ew.Form("fhouse_rentlist", "list");
	fhouse_rentlist.formKeyCountName = '<?php echo $house_rent_list->FormKeyCountName ?>';
	loadjs.done("fhouse_rentlist");
});
var fhouse_rentlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fhouse_rentlistsrch = currentSearchForm = new ew.Form("fhouse_rentlistsrch");

	// Dynamic selection lists
	// Filters

	fhouse_rentlistsrch.filterList = <?php echo $house_rent_list->getFilterList() ?>;

	// Init search panel as collapsed
	fhouse_rentlistsrch.initSearchPanel = true;
	loadjs.done("fhouse_rentlistsrch");
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
<?php if (!$house_rent_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($house_rent_list->TotalRecords > 0 && $house_rent_list->ExportOptions->visible()) { ?>
<?php $house_rent_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($house_rent_list->ImportOptions->visible()) { ?>
<?php $house_rent_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($house_rent_list->SearchOptions->visible()) { ?>
<?php $house_rent_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($house_rent_list->FilterOptions->visible()) { ?>
<?php $house_rent_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$house_rent_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$house_rent_list->isExport() && !$house_rent->CurrentAction) { ?>
<form name="fhouse_rentlistsrch" id="fhouse_rentlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fhouse_rentlistsrch-search-panel" class="<?php echo $house_rent_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="house_rent">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $house_rent_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($house_rent_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($house_rent_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $house_rent_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($house_rent_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($house_rent_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($house_rent_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($house_rent_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $house_rent_list->showPageHeader(); ?>
<?php
$house_rent_list->showMessage();
?>
<?php if ($house_rent_list->TotalRecords > 0 || $house_rent->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($house_rent_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> house_rent">
<?php if (!$house_rent_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$house_rent_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $house_rent_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $house_rent_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fhouse_rentlist" id="fhouse_rentlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="house_rent">
<div id="gmp_house_rent" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($house_rent_list->TotalRecords > 0 || $house_rent_list->isGridEdit()) { ?>
<table id="tbl_house_rentlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$house_rent->RowType = ROWTYPE_HEADER;

// Render list options
$house_rent_list->renderListOptions();

// Render list options (header, left)
$house_rent_list->ListOptions->render("header", "left");
?>
<?php if ($house_rent_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $house_rent_list->EmployeeID->headerCellClass() ?>"><div id="elh_house_rent_EmployeeID" class="house_rent_EmployeeID"><div class="ew-table-header-caption"><?php echo $house_rent_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $house_rent_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->EmployeeID) ?>', 1);"><div id="elh_house_rent_EmployeeID" class="house_rent_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($house_rent_list->FirstName->Visible) { // FirstName ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $house_rent_list->FirstName->headerCellClass() ?>"><div id="elh_house_rent_FirstName" class="house_rent_FirstName"><div class="ew-table-header-caption"><?php echo $house_rent_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $house_rent_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->FirstName) ?>', 1);"><div id="elh_house_rent_FirstName" class="house_rent_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($house_rent_list->MaidenName->Visible) { // MaidenName ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->MaidenName) == "") { ?>
		<th data-name="MaidenName" class="<?php echo $house_rent_list->MaidenName->headerCellClass() ?>"><div id="elh_house_rent_MaidenName" class="house_rent_MaidenName"><div class="ew-table-header-caption"><?php echo $house_rent_list->MaidenName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MaidenName" class="<?php echo $house_rent_list->MaidenName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->MaidenName) ?>', 1);"><div id="elh_house_rent_MaidenName" class="house_rent_MaidenName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->MaidenName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->MaidenName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->MaidenName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($house_rent_list->Surname->Visible) { // Surname ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $house_rent_list->Surname->headerCellClass() ?>"><div id="elh_house_rent_Surname" class="house_rent_Surname"><div class="ew-table-header-caption"><?php echo $house_rent_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $house_rent_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->Surname) ?>', 1);"><div id="elh_house_rent_Surname" class="house_rent_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($house_rent_list->Period->Visible) { // Period ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->Period) == "") { ?>
		<th data-name="Period" class="<?php echo $house_rent_list->Period->headerCellClass() ?>"><div id="elh_house_rent_Period" class="house_rent_Period"><div class="ew-table-header-caption"><?php echo $house_rent_list->Period->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Period" class="<?php echo $house_rent_list->Period->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->Period) ?>', 1);"><div id="elh_house_rent_Period" class="house_rent_Period">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->Period->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->Period->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->Period->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($house_rent_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $house_rent_list->DeductionCode->headerCellClass() ?>"><div id="elh_house_rent_DeductionCode" class="house_rent_DeductionCode"><div class="ew-table-header-caption"><?php echo $house_rent_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $house_rent_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->DeductionCode) ?>', 1);"><div id="elh_house_rent_DeductionCode" class="house_rent_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($house_rent_list->House_Rent->Visible) { // House Rent ?>
	<?php if ($house_rent_list->SortUrl($house_rent_list->House_Rent) == "") { ?>
		<th data-name="House_Rent" class="<?php echo $house_rent_list->House_Rent->headerCellClass() ?>"><div id="elh_house_rent_House_Rent" class="house_rent_House_Rent"><div class="ew-table-header-caption"><?php echo $house_rent_list->House_Rent->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="House_Rent" class="<?php echo $house_rent_list->House_Rent->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $house_rent_list->SortUrl($house_rent_list->House_Rent) ?>', 1);"><div id="elh_house_rent_House_Rent" class="house_rent_House_Rent">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $house_rent_list->House_Rent->caption() ?></span><span class="ew-table-header-sort"><?php if ($house_rent_list->House_Rent->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($house_rent_list->House_Rent->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$house_rent_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($house_rent_list->ExportAll && $house_rent_list->isExport()) {
	$house_rent_list->StopRecord = $house_rent_list->TotalRecords;
} else {

	// Set the last record to display
	if ($house_rent_list->TotalRecords > $house_rent_list->StartRecord + $house_rent_list->DisplayRecords - 1)
		$house_rent_list->StopRecord = $house_rent_list->StartRecord + $house_rent_list->DisplayRecords - 1;
	else
		$house_rent_list->StopRecord = $house_rent_list->TotalRecords;
}
$house_rent_list->RecordCount = $house_rent_list->StartRecord - 1;
if ($house_rent_list->Recordset && !$house_rent_list->Recordset->EOF) {
	$house_rent_list->Recordset->moveFirst();
	$selectLimit = $house_rent_list->UseSelectLimit;
	if (!$selectLimit && $house_rent_list->StartRecord > 1)
		$house_rent_list->Recordset->move($house_rent_list->StartRecord - 1);
} elseif (!$house_rent->AllowAddDeleteRow && $house_rent_list->StopRecord == 0) {
	$house_rent_list->StopRecord = $house_rent->GridAddRowCount;
}

// Initialize aggregate
$house_rent->RowType = ROWTYPE_AGGREGATEINIT;
$house_rent->resetAttributes();
$house_rent_list->renderRow();
while ($house_rent_list->RecordCount < $house_rent_list->StopRecord) {
	$house_rent_list->RecordCount++;
	if ($house_rent_list->RecordCount >= $house_rent_list->StartRecord) {
		$house_rent_list->RowCount++;

		// Set up key count
		$house_rent_list->KeyCount = $house_rent_list->RowIndex;

		// Init row class and style
		$house_rent->resetAttributes();
		$house_rent->CssClass = "";
		if ($house_rent_list->isGridAdd()) {
		} else {
			$house_rent_list->loadRowValues($house_rent_list->Recordset); // Load row values
		}
		$house_rent->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$house_rent->RowAttrs->merge(["data-rowindex" => $house_rent_list->RowCount, "id" => "r" . $house_rent_list->RowCount . "_house_rent", "data-rowtype" => $house_rent->RowType]);

		// Render row
		$house_rent_list->renderRow();

		// Render list options
		$house_rent_list->renderListOptions();
?>
	<tr <?php echo $house_rent->rowAttributes() ?>>
<?php

// Render list options (body, left)
$house_rent_list->ListOptions->render("body", "left", $house_rent_list->RowCount);
?>
	<?php if ($house_rent_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $house_rent_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_EmployeeID">
<span<?php echo $house_rent_list->EmployeeID->viewAttributes() ?>><?php echo $house_rent_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($house_rent_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $house_rent_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_FirstName">
<span<?php echo $house_rent_list->FirstName->viewAttributes() ?>><?php echo $house_rent_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($house_rent_list->MaidenName->Visible) { // MaidenName ?>
		<td data-name="MaidenName" <?php echo $house_rent_list->MaidenName->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_MaidenName">
<span<?php echo $house_rent_list->MaidenName->viewAttributes() ?>><?php echo $house_rent_list->MaidenName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($house_rent_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $house_rent_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_Surname">
<span<?php echo $house_rent_list->Surname->viewAttributes() ?>><?php echo $house_rent_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($house_rent_list->Period->Visible) { // Period ?>
		<td data-name="Period" <?php echo $house_rent_list->Period->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_Period">
<span<?php echo $house_rent_list->Period->viewAttributes() ?>><?php echo $house_rent_list->Period->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($house_rent_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $house_rent_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_DeductionCode">
<span<?php echo $house_rent_list->DeductionCode->viewAttributes() ?>><?php echo $house_rent_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($house_rent_list->House_Rent->Visible) { // House Rent ?>
		<td data-name="House_Rent" <?php echo $house_rent_list->House_Rent->cellAttributes() ?>>
<span id="el<?php echo $house_rent_list->RowCount ?>_house_rent_House_Rent">
<span<?php echo $house_rent_list->House_Rent->viewAttributes() ?>><?php echo $house_rent_list->House_Rent->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$house_rent_list->ListOptions->render("body", "right", $house_rent_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$house_rent_list->isGridAdd())
		$house_rent_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$house_rent->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($house_rent_list->Recordset)
	$house_rent_list->Recordset->Close();
?>
<?php if (!$house_rent_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$house_rent_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $house_rent_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $house_rent_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($house_rent_list->TotalRecords == 0 && !$house_rent->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $house_rent_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$house_rent_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$house_rent_list->isExport()) { ?>
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
$house_rent_list->terminate();
?>