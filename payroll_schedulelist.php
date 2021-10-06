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
$payroll_schedule_list = new payroll_schedule_list();

// Run the page
$payroll_schedule_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$payroll_schedule_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$payroll_schedule_list->isExport()) { ?>
<script>
var fpayroll_schedulelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fpayroll_schedulelist = currentForm = new ew.Form("fpayroll_schedulelist", "list");
	fpayroll_schedulelist.formKeyCountName = '<?php echo $payroll_schedule_list->FormKeyCountName ?>';
	loadjs.done("fpayroll_schedulelist");
});
var fpayroll_schedulelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fpayroll_schedulelistsrch = currentSearchForm = new ew.Form("fpayroll_schedulelistsrch");

	// Dynamic selection lists
	// Filters

	fpayroll_schedulelistsrch.filterList = <?php echo $payroll_schedule_list->getFilterList() ?>;

	// Init search panel as collapsed
	fpayroll_schedulelistsrch.initSearchPanel = true;
	loadjs.done("fpayroll_schedulelistsrch");
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
<?php if (!$payroll_schedule_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($payroll_schedule_list->TotalRecords > 0 && $payroll_schedule_list->ExportOptions->visible()) { ?>
<?php $payroll_schedule_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_schedule_list->ImportOptions->visible()) { ?>
<?php $payroll_schedule_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_schedule_list->SearchOptions->visible()) { ?>
<?php $payroll_schedule_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($payroll_schedule_list->FilterOptions->visible()) { ?>
<?php $payroll_schedule_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$payroll_schedule_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$payroll_schedule_list->isExport() && !$payroll_schedule->CurrentAction) { ?>
<form name="fpayroll_schedulelistsrch" id="fpayroll_schedulelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fpayroll_schedulelistsrch-search-panel" class="<?php echo $payroll_schedule_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="payroll_schedule">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $payroll_schedule_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($payroll_schedule_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($payroll_schedule_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $payroll_schedule_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($payroll_schedule_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($payroll_schedule_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($payroll_schedule_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($payroll_schedule_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $payroll_schedule_list->showPageHeader(); ?>
<?php
$payroll_schedule_list->showMessage();
?>
<?php if ($payroll_schedule_list->TotalRecords > 0 || $payroll_schedule->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($payroll_schedule_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> payroll_schedule">
<?php if (!$payroll_schedule_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$payroll_schedule_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_schedule_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_schedule_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fpayroll_schedulelist" id="fpayroll_schedulelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="payroll_schedule">
<div id="gmp_payroll_schedule" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($payroll_schedule_list->TotalRecords > 0 || $payroll_schedule_list->isGridEdit()) { ?>
<table id="tbl_payroll_schedulelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$payroll_schedule->RowType = ROWTYPE_HEADER;

// Render list options
$payroll_schedule_list->renderListOptions();

// Render list options (header, left)
$payroll_schedule_list->ListOptions->render("header", "left");
?>
<?php if ($payroll_schedule_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $payroll_schedule_list->EmployeeID->headerCellClass() ?>"><div id="elh_payroll_schedule_EmployeeID" class="payroll_schedule_EmployeeID"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $payroll_schedule_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->EmployeeID) ?>', 1);"><div id="elh_payroll_schedule_EmployeeID" class="payroll_schedule_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_schedule_list->SOCIAL_SECURITY_NO->Visible) { // SOCIAL SECURITY NO ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->SOCIAL_SECURITY_NO) == "") { ?>
		<th data-name="SOCIAL_SECURITY_NO" class="<?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->headerCellClass() ?>"><div id="elh_payroll_schedule_SOCIAL_SECURITY_NO" class="payroll_schedule_SOCIAL_SECURITY_NO"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SOCIAL_SECURITY_NO" class="<?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->SOCIAL_SECURITY_NO) ?>', 1);"><div id="elh_payroll_schedule_SOCIAL_SECURITY_NO" class="payroll_schedule_SOCIAL_SECURITY_NO">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->SOCIAL_SECURITY_NO->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->SOCIAL_SECURITY_NO->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_schedule_list->FirstName->Visible) { // FirstName ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->FirstName) == "") { ?>
		<th data-name="FirstName" class="<?php echo $payroll_schedule_list->FirstName->headerCellClass() ?>"><div id="elh_payroll_schedule_FirstName" class="payroll_schedule_FirstName"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->FirstName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="FirstName" class="<?php echo $payroll_schedule_list->FirstName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->FirstName) ?>', 1);"><div id="elh_payroll_schedule_FirstName" class="payroll_schedule_FirstName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->FirstName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->FirstName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->FirstName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_schedule_list->Surname->Visible) { // Surname ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->Surname) == "") { ?>
		<th data-name="Surname" class="<?php echo $payroll_schedule_list->Surname->headerCellClass() ?>"><div id="elh_payroll_schedule_Surname" class="payroll_schedule_Surname"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->Surname->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Surname" class="<?php echo $payroll_schedule_list->Surname->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->Surname) ?>', 1);"><div id="elh_payroll_schedule_Surname" class="payroll_schedule_Surname">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->Surname->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->Surname->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->Surname->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_schedule_list->TOTAL_INCOME->Visible) { // TOTAL INCOME ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->TOTAL_INCOME) == "") { ?>
		<th data-name="TOTAL_INCOME" class="<?php echo $payroll_schedule_list->TOTAL_INCOME->headerCellClass() ?>"><div id="elh_payroll_schedule_TOTAL_INCOME" class="payroll_schedule_TOTAL_INCOME"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->TOTAL_INCOME->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TOTAL_INCOME" class="<?php echo $payroll_schedule_list->TOTAL_INCOME->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->TOTAL_INCOME) ?>', 1);"><div id="elh_payroll_schedule_TOTAL_INCOME" class="payroll_schedule_TOTAL_INCOME">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->TOTAL_INCOME->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->TOTAL_INCOME->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->TOTAL_INCOME->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_schedule_list->TOTAL_DEDUCTION->Visible) { // TOTAL DEDUCTION ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->TOTAL_DEDUCTION) == "") { ?>
		<th data-name="TOTAL_DEDUCTION" class="<?php echo $payroll_schedule_list->TOTAL_DEDUCTION->headerCellClass() ?>"><div id="elh_payroll_schedule_TOTAL_DEDUCTION" class="payroll_schedule_TOTAL_DEDUCTION"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->TOTAL_DEDUCTION->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TOTAL_DEDUCTION" class="<?php echo $payroll_schedule_list->TOTAL_DEDUCTION->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->TOTAL_DEDUCTION) ?>', 1);"><div id="elh_payroll_schedule_TOTAL_DEDUCTION" class="payroll_schedule_TOTAL_DEDUCTION">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->TOTAL_DEDUCTION->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->TOTAL_DEDUCTION->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->TOTAL_DEDUCTION->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($payroll_schedule_list->NETPAY->Visible) { // NETPAY ?>
	<?php if ($payroll_schedule_list->SortUrl($payroll_schedule_list->NETPAY) == "") { ?>
		<th data-name="NETPAY" class="<?php echo $payroll_schedule_list->NETPAY->headerCellClass() ?>"><div id="elh_payroll_schedule_NETPAY" class="payroll_schedule_NETPAY"><div class="ew-table-header-caption"><?php echo $payroll_schedule_list->NETPAY->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NETPAY" class="<?php echo $payroll_schedule_list->NETPAY->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $payroll_schedule_list->SortUrl($payroll_schedule_list->NETPAY) ?>', 1);"><div id="elh_payroll_schedule_NETPAY" class="payroll_schedule_NETPAY">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $payroll_schedule_list->NETPAY->caption() ?></span><span class="ew-table-header-sort"><?php if ($payroll_schedule_list->NETPAY->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($payroll_schedule_list->NETPAY->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$payroll_schedule_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($payroll_schedule_list->ExportAll && $payroll_schedule_list->isExport()) {
	$payroll_schedule_list->StopRecord = $payroll_schedule_list->TotalRecords;
} else {

	// Set the last record to display
	if ($payroll_schedule_list->TotalRecords > $payroll_schedule_list->StartRecord + $payroll_schedule_list->DisplayRecords - 1)
		$payroll_schedule_list->StopRecord = $payroll_schedule_list->StartRecord + $payroll_schedule_list->DisplayRecords - 1;
	else
		$payroll_schedule_list->StopRecord = $payroll_schedule_list->TotalRecords;
}
$payroll_schedule_list->RecordCount = $payroll_schedule_list->StartRecord - 1;
if ($payroll_schedule_list->Recordset && !$payroll_schedule_list->Recordset->EOF) {
	$payroll_schedule_list->Recordset->moveFirst();
	$selectLimit = $payroll_schedule_list->UseSelectLimit;
	if (!$selectLimit && $payroll_schedule_list->StartRecord > 1)
		$payroll_schedule_list->Recordset->move($payroll_schedule_list->StartRecord - 1);
} elseif (!$payroll_schedule->AllowAddDeleteRow && $payroll_schedule_list->StopRecord == 0) {
	$payroll_schedule_list->StopRecord = $payroll_schedule->GridAddRowCount;
}

// Initialize aggregate
$payroll_schedule->RowType = ROWTYPE_AGGREGATEINIT;
$payroll_schedule->resetAttributes();
$payroll_schedule_list->renderRow();
while ($payroll_schedule_list->RecordCount < $payroll_schedule_list->StopRecord) {
	$payroll_schedule_list->RecordCount++;
	if ($payroll_schedule_list->RecordCount >= $payroll_schedule_list->StartRecord) {
		$payroll_schedule_list->RowCount++;

		// Set up key count
		$payroll_schedule_list->KeyCount = $payroll_schedule_list->RowIndex;

		// Init row class and style
		$payroll_schedule->resetAttributes();
		$payroll_schedule->CssClass = "";
		if ($payroll_schedule_list->isGridAdd()) {
		} else {
			$payroll_schedule_list->loadRowValues($payroll_schedule_list->Recordset); // Load row values
		}
		$payroll_schedule->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$payroll_schedule->RowAttrs->merge(["data-rowindex" => $payroll_schedule_list->RowCount, "id" => "r" . $payroll_schedule_list->RowCount . "_payroll_schedule", "data-rowtype" => $payroll_schedule->RowType]);

		// Render row
		$payroll_schedule_list->renderRow();

		// Render list options
		$payroll_schedule_list->renderListOptions();
?>
	<tr <?php echo $payroll_schedule->rowAttributes() ?>>
<?php

// Render list options (body, left)
$payroll_schedule_list->ListOptions->render("body", "left", $payroll_schedule_list->RowCount);
?>
	<?php if ($payroll_schedule_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $payroll_schedule_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_EmployeeID">
<span<?php echo $payroll_schedule_list->EmployeeID->viewAttributes() ?>><?php echo $payroll_schedule_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_schedule_list->SOCIAL_SECURITY_NO->Visible) { // SOCIAL SECURITY NO ?>
		<td data-name="SOCIAL_SECURITY_NO" <?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_SOCIAL_SECURITY_NO">
<span<?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->viewAttributes() ?>><?php echo $payroll_schedule_list->SOCIAL_SECURITY_NO->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_schedule_list->FirstName->Visible) { // FirstName ?>
		<td data-name="FirstName" <?php echo $payroll_schedule_list->FirstName->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_FirstName">
<span<?php echo $payroll_schedule_list->FirstName->viewAttributes() ?>><?php echo $payroll_schedule_list->FirstName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_schedule_list->Surname->Visible) { // Surname ?>
		<td data-name="Surname" <?php echo $payroll_schedule_list->Surname->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_Surname">
<span<?php echo $payroll_schedule_list->Surname->viewAttributes() ?>><?php echo $payroll_schedule_list->Surname->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_schedule_list->TOTAL_INCOME->Visible) { // TOTAL INCOME ?>
		<td data-name="TOTAL_INCOME" <?php echo $payroll_schedule_list->TOTAL_INCOME->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_TOTAL_INCOME">
<span<?php echo $payroll_schedule_list->TOTAL_INCOME->viewAttributes() ?>><?php echo $payroll_schedule_list->TOTAL_INCOME->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_schedule_list->TOTAL_DEDUCTION->Visible) { // TOTAL DEDUCTION ?>
		<td data-name="TOTAL_DEDUCTION" <?php echo $payroll_schedule_list->TOTAL_DEDUCTION->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_TOTAL_DEDUCTION">
<span<?php echo $payroll_schedule_list->TOTAL_DEDUCTION->viewAttributes() ?>><?php echo $payroll_schedule_list->TOTAL_DEDUCTION->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($payroll_schedule_list->NETPAY->Visible) { // NETPAY ?>
		<td data-name="NETPAY" <?php echo $payroll_schedule_list->NETPAY->cellAttributes() ?>>
<span id="el<?php echo $payroll_schedule_list->RowCount ?>_payroll_schedule_NETPAY">
<span<?php echo $payroll_schedule_list->NETPAY->viewAttributes() ?>><?php echo $payroll_schedule_list->NETPAY->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$payroll_schedule_list->ListOptions->render("body", "right", $payroll_schedule_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$payroll_schedule_list->isGridAdd())
		$payroll_schedule_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$payroll_schedule->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($payroll_schedule_list->Recordset)
	$payroll_schedule_list->Recordset->Close();
?>
<?php if (!$payroll_schedule_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$payroll_schedule_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $payroll_schedule_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $payroll_schedule_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($payroll_schedule_list->TotalRecords == 0 && !$payroll_schedule->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $payroll_schedule_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$payroll_schedule_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$payroll_schedule_list->isExport()) { ?>
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
$payroll_schedule_list->terminate();
?>