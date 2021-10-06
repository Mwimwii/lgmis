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
$payroll_list = new payroll_list();

// Run the page
$payroll_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_list->isExport()) { ?>
<script>
var fpayrolllist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayrolllist = currentForm = new ew.Form("fpayrolllist", "list");
	fpayrolllist.formKeyCountName = '<?php echo $payroll_list->FormKeyCountName ?>';
	loadjs.done("fpayrolllist");
});
var fpayrolllistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayrolllistsrch = currentSearchForm = new ew.Form("fpayrolllistsrch");

	// Dynamic selection lists
	// Filters

	fpayrolllistsrch.filterList = <?php echo $payroll_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayrolllistsrch.initSearchPanel = true;
	loadjs.done("fpayrolllistsrch");
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
<?php if (!$payroll_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_list->TotalRecords > 0 && $payroll_list->ExportOptions->visible()) { ?>
<?php $payroll_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_list->ImportOptions->visible()) { ?>
<?php $payroll_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_list->SearchOptions->visible()) { ?>
<?php $payroll_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_list->FilterOptions->visible()) { ?>
<?php $payroll_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payroll_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_list->isExport() && !$payroll->CurrentAction) { ?>
<form name="fpayrolllistsrch" id="fpayrolllistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayrolllistsrch-search-panel" class="<?php echo $payroll_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payroll_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_list->showPageHeader(); ?>
<?php
$payroll_list->showMessage();
?>
<?php if ($payroll_list->TotalRecords > 0 || $payroll->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll">
<?php if (!$payroll_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayrolllist" id="fpayrolllist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll">
<div id="gmp_payroll" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_list->TotalRecords > 0 || $payroll_list->isGridEdit()) { ?>
<table id="tbl_payrolllist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_list->renderListOptions();

// Render list options (header, left)
$payroll_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_list->PayrollCode->Visible) { // PayrollCode ?>
	<?php if ($payroll_list->SortUrl($payroll_list->PayrollCode) == "") { ?>
		<th data-name="PayrollCode" class="<?php echo $payroll_list->PayrollCode->headerCellClass() ?>"><div id="elh_payroll_PayrollCode" class="payroll_PayrollCode"><div class="ew-table-header-caption"><?php echo $payroll_list->PayrollCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollCode" class="<?php echo $payroll_list->PayrollCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_list->SortUrl($payroll_list->PayrollCode) ?>', 1);"><div id="elh_payroll_PayrollCode" class="payroll_PayrollCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_list->PayrollCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_list->PayrollCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_list->PayrollCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_list->PayrollName->Visible) { // PayrollName ?>
	<?php if ($payroll_list->SortUrl($payroll_list->PayrollName) == "") { ?>
		<th data-name="PayrollName" class="<?php echo $payroll_list->PayrollName->headerCellClass() ?>"><div id="elh_payroll_PayrollName" class="payroll_PayrollName"><div class="ew-table-header-caption"><?php echo $payroll_list->PayrollName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollName" class="<?php echo $payroll_list->PayrollName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_list->SortUrl($payroll_list->PayrollName) ?>', 1);"><div id="elh_payroll_PayrollName" class="payroll_PayrollName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_list->PayrollName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_list->PayrollName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_list->PayrollName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_list->PayrollDescription->Visible) { // PayrollDescription ?>
	<?php if ($payroll_list->SortUrl($payroll_list->PayrollDescription) == "") { ?>
		<th data-name="PayrollDescription" class="<?php echo $payroll_list->PayrollDescription->headerCellClass() ?>"><div id="elh_payroll_PayrollDescription" class="payroll_PayrollDescription"><div class="ew-table-header-caption"><?php echo $payroll_list->PayrollDescription->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PayrollDescription" class="<?php echo $payroll_list->PayrollDescription->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_list->SortUrl($payroll_list->PayrollDescription) ?>', 1);"><div id="elh_payroll_PayrollDescription" class="payroll_PayrollDescription">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_list->PayrollDescription->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_list->PayrollDescription->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_list->PayrollDescription->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_list->Division->Visible) { // Division ?>
	<?php if ($payroll_list->SortUrl($payroll_list->Division) == "") { ?>
		<th data-name="Division" class="<?php echo $payroll_list->Division->headerCellClass() ?>"><div id="elh_payroll_Division" class="payroll_Division"><div class="ew-table-header-caption"><?php echo $payroll_list->Division->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Division" class="<?php echo $payroll_list->Division->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_list->SortUrl($payroll_list->Division) ?>', 1);"><div id="elh_payroll_Division" class="payroll_Division">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_list->Division->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_list->Division->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_list->Division->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_list->LAcode->Visible) { // LAcode ?>
	<?php if ($payroll_list->SortUrl($payroll_list->LAcode) == "") { ?>
		<th data-name="LAcode" class="<?php echo $payroll_list->LAcode->headerCellClass() ?>"><div id="elh_payroll_LAcode" class="payroll_LAcode"><div class="ew-table-header-caption"><?php echo $payroll_list->LAcode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAcode" class="<?php echo $payroll_list->LAcode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_list->SortUrl($payroll_list->LAcode) ?>', 1);"><div id="elh_payroll_LAcode" class="payroll_LAcode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_list->LAcode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_list->LAcode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_list->LAcode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payroll_list->ExportAll && $payroll_list->isExport()) {
	$payroll_list->StopRecord = $payroll_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_list->TotalRecords > $payroll_list->StartRecord + $payroll_list->DisplayRecords - 1)
		$payroll_list->StopRecord = $payroll_list->StartRecord + $payroll_list->DisplayRecords - 1;
	else
		$payroll_list->StopRecord = $payroll_list->TotalRecords;
}
$payroll_list->RecordCount = $payroll_list->StartRecord - 1;
if ($payroll_list->Recordset && !$payroll_list->Recordset->EOF) {
	$payroll_list->Recordset->moveFirst();
	$selectLimit = $payroll_list->UseSelectLimit;
	if (!$selectLimit && $payroll_list->StartRecord > 1)
		$payroll_list->Recordset->move($payroll_list->StartRecord - 1);
} elseif (!$payroll->AllowAddDeleteRow && $payroll_list->StopRecord == 0) {
	$payroll_list->StopRecord = $payroll->GridAddRowCount;
}

// Initialize aggregate
$payroll->RowType = ROWTYPE_AGGREGATEINIT;
$payroll->resetAttributes();
$payroll_list->renderRow();
while ($payroll_list->RecordCount < $payroll_list->StopRecord) {
	$payroll_list->RecordCount++;
	if ($payroll_list->RecordCount >= $payroll_list->StartRecord) {
		$payroll_list->RowCount++;

		// Set up key count
		$payroll_list->KeyCount = $payroll_list->RowIndex;

		// Init row class and style
		$payroll->resetAttributes();
		$payroll->CssClass = "";
		if ($payroll_list->isGridAdd()) {
		} else {
			$payroll_list->loadRowValues($payroll_list->Recordset); // Load row values
		}
		$payroll->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payroll->RowAttrs->merge(["data-rowindex" => $payroll_list->RowCount, "id" => "r" . $payroll_list->RowCount . "_payroll", "data-rowtype" => $payroll->RowType]);

		// Render row
		$payroll_list->renderRow();

		// Render list options
		$payroll_list->renderListOptions();
?>
	<tr <?php echo $payroll->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_list->ListOptions->render("body", "left", $payroll_list->RowCount);
?>
	<?php if ($payroll_list->PayrollCode->Visible) { // PayrollCode ?>
		<td data-name="PayrollCode" <?php echo $payroll_list->PayrollCode->cellAttributes() ?>>
<span id="el<?php echo $payroll_list->RowCount ?>_payroll_PayrollCode">
<span<?php echo $payroll_list->PayrollCode->viewAttributes() ?>><?php echo $payroll_list->PayrollCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_list->PayrollName->Visible) { // PayrollName ?>
		<td data-name="PayrollName" <?php echo $payroll_list->PayrollName->cellAttributes() ?>>
<span id="el<?php echo $payroll_list->RowCount ?>_payroll_PayrollName">
<span<?php echo $payroll_list->PayrollName->viewAttributes() ?>><?php echo $payroll_list->PayrollName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_list->PayrollDescription->Visible) { // PayrollDescription ?>
		<td data-name="PayrollDescription" <?php echo $payroll_list->PayrollDescription->cellAttributes() ?>>
<span id="el<?php echo $payroll_list->RowCount ?>_payroll_PayrollDescription">
<span<?php echo $payroll_list->PayrollDescription->viewAttributes() ?>><?php echo $payroll_list->PayrollDescription->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_list->Division->Visible) { // Division ?>
		<td data-name="Division" <?php echo $payroll_list->Division->cellAttributes() ?>>
<span id="el<?php echo $payroll_list->RowCount ?>_payroll_Division">
<span<?php echo $payroll_list->Division->viewAttributes() ?>><?php echo $payroll_list->Division->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_list->LAcode->Visible) { // LAcode ?>
		<td data-name="LAcode" <?php echo $payroll_list->LAcode->cellAttributes() ?>>
<span id="el<?php echo $payroll_list->RowCount ?>_payroll_LAcode">
<span<?php echo $payroll_list->LAcode->viewAttributes() ?>><?php echo $payroll_list->LAcode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_list->ListOptions->render("body", "right", $payroll_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payroll_list->isGridAdd())
		$payroll_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payroll->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_list->Recordset)
	$payroll_list->Recordset->Close();
?>
<?php if (!$payroll_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_list->TotalRecords == 0 && !$payroll->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_list->isExport()) { ?>
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
$payroll_list->terminate();
?>