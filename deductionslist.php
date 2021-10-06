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
$deductions_list = new deductions_list();

// Run the page
$deductions_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$deductions_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$deductions_list->isExport()) { ?>
<script>
var fdeductionslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fdeductionslist = currentForm = new ew.Form("fdeductionslist", "list");
	fdeductionslist.formKeyCountName = '<?php echo $deductions_list->FormKeyCountName ?>';
	loadjs.done("fdeductionslist");
});
var fdeductionslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fdeductionslistsrch = currentSearchForm = new ew.Form("fdeductionslistsrch");

	// Dynamic selection lists
	// Filters

	fdeductionslistsrch.filterList = <?php echo $deductions_list->getFilterList() ?>;

	// Init search panel as collapsed
	fdeductionslistsrch.initSearchPanel = true;
	loadjs.done("fdeductionslistsrch");
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
<?php if (!$deductions_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($deductions_list->TotalRecords > 0 && $deductions_list->ExportOptions->visible()) { ?>
<?php $deductions_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($deductions_list->ImportOptions->visible()) { ?>
<?php $deductions_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($deductions_list->SearchOptions->visible()) { ?>
<?php $deductions_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($deductions_list->FilterOptions->visible()) { ?>
<?php $deductions_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$deductions_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$deductions_list->isExport() && !$deductions->CurrentAction) { ?>
<form name="fdeductionslistsrch" id="fdeductionslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fdeductionslistsrch-search-panel" class="<?php echo $deductions_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="deductions">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $deductions_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($deductions_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($deductions_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $deductions_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($deductions_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($deductions_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($deductions_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($deductions_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $deductions_list->showPageHeader(); ?>
<?php
$deductions_list->showMessage();
?>
<?php if ($deductions_list->TotalRecords > 0 || $deductions->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($deductions_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> deductions">
<?php if (!$deductions_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$deductions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deductions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deductions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fdeductionslist" id="fdeductionslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="deductions">
<div id="gmp_deductions" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($deductions_list->TotalRecords > 0 || $deductions_list->isGridEdit()) { ?>
<table id="tbl_deductionslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$deductions->RowType = ROWTYPE_HEADER;

// Render list options
$deductions_list->renderListOptions();

// Render list options (header, left)
$deductions_list->ListOptions->render("header", "left");
?>
<?php if ($deductions_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($deductions_list->SortUrl($deductions_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $deductions_list->EmployeeID->headerCellClass() ?>"><div id="elh_deductions_EmployeeID" class="deductions_EmployeeID"><div class="ew-table-header-caption"><?php echo $deductions_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $deductions_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deductions_list->SortUrl($deductions_list->EmployeeID) ?>', 1);"><div id="elh_deductions_EmployeeID" class="deductions_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deductions_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($deductions_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deductions_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deductions_list->DeductionCode->Visible) { // DeductionCode ?>
	<?php if ($deductions_list->SortUrl($deductions_list->DeductionCode) == "") { ?>
		<th data-name="DeductionCode" class="<?php echo $deductions_list->DeductionCode->headerCellClass() ?>"><div id="elh_deductions_DeductionCode" class="deductions_DeductionCode"><div class="ew-table-header-caption"><?php echo $deductions_list->DeductionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionCode" class="<?php echo $deductions_list->DeductionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deductions_list->SortUrl($deductions_list->DeductionCode) ?>', 1);"><div id="elh_deductions_DeductionCode" class="deductions_DeductionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deductions_list->DeductionCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deductions_list->DeductionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deductions_list->DeductionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deductions_list->DeductionName->Visible) { // DeductionName ?>
	<?php if ($deductions_list->SortUrl($deductions_list->DeductionName) == "") { ?>
		<th data-name="DeductionName" class="<?php echo $deductions_list->DeductionName->headerCellClass() ?>"><div id="elh_deductions_DeductionName" class="deductions_DeductionName"><div class="ew-table-header-caption"><?php echo $deductions_list->DeductionName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeductionName" class="<?php echo $deductions_list->DeductionName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deductions_list->SortUrl($deductions_list->DeductionName) ?>', 1);"><div id="elh_deductions_DeductionName" class="deductions_DeductionName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deductions_list->DeductionName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($deductions_list->DeductionName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deductions_list->DeductionName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($deductions_list->deduction->Visible) { // deduction ?>
	<?php if ($deductions_list->SortUrl($deductions_list->deduction) == "") { ?>
		<th data-name="deduction" class="<?php echo $deductions_list->deduction->headerCellClass() ?>"><div id="elh_deductions_deduction" class="deductions_deduction"><div class="ew-table-header-caption"><?php echo $deductions_list->deduction->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="deduction" class="<?php echo $deductions_list->deduction->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $deductions_list->SortUrl($deductions_list->deduction) ?>', 1);"><div id="elh_deductions_deduction" class="deductions_deduction">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $deductions_list->deduction->caption() ?></span><span class="ew-table-header-sort"><?php if ($deductions_list->deduction->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($deductions_list->deduction->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$deductions_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($deductions_list->ExportAll && $deductions_list->isExport()) {
	$deductions_list->StopRecord = $deductions_list->TotalRecords;
} else {

	// Set the last record to display
	if ($deductions_list->TotalRecords > $deductions_list->StartRecord + $deductions_list->DisplayRecords - 1)
		$deductions_list->StopRecord = $deductions_list->StartRecord + $deductions_list->DisplayRecords - 1;
	else
		$deductions_list->StopRecord = $deductions_list->TotalRecords;
}
$deductions_list->RecordCount = $deductions_list->StartRecord - 1;
if ($deductions_list->Recordset && !$deductions_list->Recordset->EOF) {
	$deductions_list->Recordset->moveFirst();
	$selectLimit = $deductions_list->UseSelectLimit;
	if (!$selectLimit && $deductions_list->StartRecord > 1)
		$deductions_list->Recordset->move($deductions_list->StartRecord - 1);
} elseif (!$deductions->AllowAddDeleteRow && $deductions_list->StopRecord == 0) {
	$deductions_list->StopRecord = $deductions->GridAddRowCount;
}

// Initialize aggregate
$deductions->RowType = ROWTYPE_AGGREGATEINIT;
$deductions->resetAttributes();
$deductions_list->renderRow();
while ($deductions_list->RecordCount < $deductions_list->StopRecord) {
	$deductions_list->RecordCount++;
	if ($deductions_list->RecordCount >= $deductions_list->StartRecord) {
		$deductions_list->RowCount++;

		// Set up key count
		$deductions_list->KeyCount = $deductions_list->RowIndex;

		// Init row class and style
		$deductions->resetAttributes();
		$deductions->CssClass = "";
		if ($deductions_list->isGridAdd()) {
		} else {
			$deductions_list->loadRowValues($deductions_list->Recordset); // Load row values
		}
		$deductions->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$deductions->RowAttrs->merge(["data-rowindex" => $deductions_list->RowCount, "id" => "r" . $deductions_list->RowCount . "_deductions", "data-rowtype" => $deductions->RowType]);

		// Render row
		$deductions_list->renderRow();

		// Render list options
		$deductions_list->renderListOptions();
?>
	<tr <?php echo $deductions->rowAttributes() ?>>
<?php

// Render list options (body, left)
$deductions_list->ListOptions->render("body", "left", $deductions_list->RowCount);
?>
	<?php if ($deductions_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $deductions_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $deductions_list->RowCount ?>_deductions_EmployeeID">
<span<?php echo $deductions_list->EmployeeID->viewAttributes() ?>><?php echo $deductions_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deductions_list->DeductionCode->Visible) { // DeductionCode ?>
		<td data-name="DeductionCode" <?php echo $deductions_list->DeductionCode->cellAttributes() ?>>
<span id="el<?php echo $deductions_list->RowCount ?>_deductions_DeductionCode">
<span<?php echo $deductions_list->DeductionCode->viewAttributes() ?>><?php echo $deductions_list->DeductionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deductions_list->DeductionName->Visible) { // DeductionName ?>
		<td data-name="DeductionName" <?php echo $deductions_list->DeductionName->cellAttributes() ?>>
<span id="el<?php echo $deductions_list->RowCount ?>_deductions_DeductionName">
<span<?php echo $deductions_list->DeductionName->viewAttributes() ?>><?php echo $deductions_list->DeductionName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($deductions_list->deduction->Visible) { // deduction ?>
		<td data-name="deduction" <?php echo $deductions_list->deduction->cellAttributes() ?>>
<span id="el<?php echo $deductions_list->RowCount ?>_deductions_deduction">
<span<?php echo $deductions_list->deduction->viewAttributes() ?>><?php echo $deductions_list->deduction->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$deductions_list->ListOptions->render("body", "right", $deductions_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$deductions_list->isGridAdd())
		$deductions_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$deductions->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($deductions_list->Recordset)
	$deductions_list->Recordset->Close();
?>
<?php if (!$deductions_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$deductions_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $deductions_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $deductions_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($deductions_list->TotalRecords == 0 && !$deductions->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $deductions_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$deductions_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$deductions_list->isExport()) { ?>
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
$deductions_list->terminate();
?>