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
$charge_type_list = new charge_type_list();

// Run the page
$charge_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charge_type_list->isExport()) { ?>
<script>
var fcharge_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcharge_typelist = currentForm = new ew.Form("fcharge_typelist", "list");
	fcharge_typelist.formKeyCountName = '<?php echo $charge_type_list->FormKeyCountName ?>';
	loadjs.done("fcharge_typelist");
});
var fcharge_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcharge_typelistsrch = currentSearchForm = new ew.Form("fcharge_typelistsrch");

	// Dynamic selection lists
	// Filters

	fcharge_typelistsrch.filterList = <?php echo $charge_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcharge_typelistsrch.initSearchPanel = true;
	loadjs.done("fcharge_typelistsrch");
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
<?php if (!$charge_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($charge_type_list->TotalRecords > 0 && $charge_type_list->ExportOptions->visible()) { ?>
<?php $charge_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($charge_type_list->ImportOptions->visible()) { ?>
<?php $charge_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($charge_type_list->SearchOptions->visible()) { ?>
<?php $charge_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($charge_type_list->FilterOptions->visible()) { ?>
<?php $charge_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$charge_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$charge_type_list->isExport() && !$charge_type->CurrentAction) { ?>
<form name="fcharge_typelistsrch" id="fcharge_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcharge_typelistsrch-search-panel" class="<?php echo $charge_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="charge_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $charge_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($charge_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($charge_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $charge_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($charge_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($charge_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($charge_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($charge_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $charge_type_list->showPageHeader(); ?>
<?php
$charge_type_list->showMessage();
?>
<?php if ($charge_type_list->TotalRecords > 0 || $charge_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($charge_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> charge_type">
<?php if (!$charge_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$charge_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charge_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcharge_typelist" id="fcharge_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_type">
<div id="gmp_charge_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($charge_type_list->TotalRecords > 0 || $charge_type_list->isGridEdit()) { ?>
<table id="tbl_charge_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$charge_type->RowType = ROWTYPE_HEADER;

// Render list options
$charge_type_list->renderListOptions();

// Render list options (header, left)
$charge_type_list->ListOptions->render("header", "left");
?>
<?php if ($charge_type_list->ChargeType->Visible) { // ChargeType ?>
	<?php if ($charge_type_list->SortUrl($charge_type_list->ChargeType) == "") { ?>
		<th data-name="ChargeType" class="<?php echo $charge_type_list->ChargeType->headerCellClass() ?>"><div id="elh_charge_type_ChargeType" class="charge_type_ChargeType"><div class="ew-table-header-caption"><?php echo $charge_type_list->ChargeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeType" class="<?php echo $charge_type_list->ChargeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_type_list->SortUrl($charge_type_list->ChargeType) ?>', 1);"><div id="elh_charge_type_ChargeType" class="charge_type_ChargeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_type_list->ChargeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($charge_type_list->ChargeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_type_list->ChargeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_type_list->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
	<?php if ($charge_type_list->SortUrl($charge_type_list->ChargeTypeDesc) == "") { ?>
		<th data-name="ChargeTypeDesc" class="<?php echo $charge_type_list->ChargeTypeDesc->headerCellClass() ?>"><div id="elh_charge_type_ChargeTypeDesc" class="charge_type_ChargeTypeDesc"><div class="ew-table-header-caption"><?php echo $charge_type_list->ChargeTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeTypeDesc" class="<?php echo $charge_type_list->ChargeTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_type_list->SortUrl($charge_type_list->ChargeTypeDesc) ?>', 1);"><div id="elh_charge_type_ChargeTypeDesc" class="charge_type_ChargeTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_type_list->ChargeTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_type_list->ChargeTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_type_list->ChargeTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_type_list->IncomeType->Visible) { // IncomeType ?>
	<?php if ($charge_type_list->SortUrl($charge_type_list->IncomeType) == "") { ?>
		<th data-name="IncomeType" class="<?php echo $charge_type_list->IncomeType->headerCellClass() ?>"><div id="elh_charge_type_IncomeType" class="charge_type_IncomeType"><div class="ew-table-header-caption"><?php echo $charge_type_list->IncomeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncomeType" class="<?php echo $charge_type_list->IncomeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_type_list->SortUrl($charge_type_list->IncomeType) ?>', 1);"><div id="elh_charge_type_IncomeType" class="charge_type_IncomeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_type_list->IncomeType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_type_list->IncomeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_type_list->IncomeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_type_list->BankCode->Visible) { // BankCode ?>
	<?php if ($charge_type_list->SortUrl($charge_type_list->BankCode) == "") { ?>
		<th data-name="BankCode" class="<?php echo $charge_type_list->BankCode->headerCellClass() ?>"><div id="elh_charge_type_BankCode" class="charge_type_BankCode"><div class="ew-table-header-caption"><?php echo $charge_type_list->BankCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankCode" class="<?php echo $charge_type_list->BankCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_type_list->SortUrl($charge_type_list->BankCode) ?>', 1);"><div id="elh_charge_type_BankCode" class="charge_type_BankCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_type_list->BankCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($charge_type_list->BankCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_type_list->BankCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_type_list->BankAccount->Visible) { // BankAccount ?>
	<?php if ($charge_type_list->SortUrl($charge_type_list->BankAccount) == "") { ?>
		<th data-name="BankAccount" class="<?php echo $charge_type_list->BankAccount->headerCellClass() ?>"><div id="elh_charge_type_BankAccount" class="charge_type_BankAccount"><div class="ew-table-header-caption"><?php echo $charge_type_list->BankAccount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BankAccount" class="<?php echo $charge_type_list->BankAccount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_type_list->SortUrl($charge_type_list->BankAccount) ?>', 1);"><div id="elh_charge_type_BankAccount" class="charge_type_BankAccount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_type_list->BankAccount->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_type_list->BankAccount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_type_list->BankAccount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$charge_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($charge_type_list->ExportAll && $charge_type_list->isExport()) {
	$charge_type_list->StopRecord = $charge_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($charge_type_list->TotalRecords > $charge_type_list->StartRecord + $charge_type_list->DisplayRecords - 1)
		$charge_type_list->StopRecord = $charge_type_list->StartRecord + $charge_type_list->DisplayRecords - 1;
	else
		$charge_type_list->StopRecord = $charge_type_list->TotalRecords;
}
$charge_type_list->RecordCount = $charge_type_list->StartRecord - 1;
if ($charge_type_list->Recordset && !$charge_type_list->Recordset->EOF) {
	$charge_type_list->Recordset->moveFirst();
	$selectLimit = $charge_type_list->UseSelectLimit;
	if (!$selectLimit && $charge_type_list->StartRecord > 1)
		$charge_type_list->Recordset->move($charge_type_list->StartRecord - 1);
} elseif (!$charge_type->AllowAddDeleteRow && $charge_type_list->StopRecord == 0) {
	$charge_type_list->StopRecord = $charge_type->GridAddRowCount;
}

// Initialize aggregate
$charge_type->RowType = ROWTYPE_AGGREGATEINIT;
$charge_type->resetAttributes();
$charge_type_list->renderRow();
while ($charge_type_list->RecordCount < $charge_type_list->StopRecord) {
	$charge_type_list->RecordCount++;
	if ($charge_type_list->RecordCount >= $charge_type_list->StartRecord) {
		$charge_type_list->RowCount++;

		// Set up key count
		$charge_type_list->KeyCount = $charge_type_list->RowIndex;

		// Init row class and style
		$charge_type->resetAttributes();
		$charge_type->CssClass = "";
		if ($charge_type_list->isGridAdd()) {
		} else {
			$charge_type_list->loadRowValues($charge_type_list->Recordset); // Load row values
		}
		$charge_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$charge_type->RowAttrs->merge(["data-rowindex" => $charge_type_list->RowCount, "id" => "r" . $charge_type_list->RowCount . "_charge_type", "data-rowtype" => $charge_type->RowType]);

		// Render row
		$charge_type_list->renderRow();

		// Render list options
		$charge_type_list->renderListOptions();
?>
	<tr <?php echo $charge_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charge_type_list->ListOptions->render("body", "left", $charge_type_list->RowCount);
?>
	<?php if ($charge_type_list->ChargeType->Visible) { // ChargeType ?>
		<td data-name="ChargeType" <?php echo $charge_type_list->ChargeType->cellAttributes() ?>>
<span id="el<?php echo $charge_type_list->RowCount ?>_charge_type_ChargeType">
<span<?php echo $charge_type_list->ChargeType->viewAttributes() ?>><?php echo $charge_type_list->ChargeType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_type_list->ChargeTypeDesc->Visible) { // ChargeTypeDesc ?>
		<td data-name="ChargeTypeDesc" <?php echo $charge_type_list->ChargeTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $charge_type_list->RowCount ?>_charge_type_ChargeTypeDesc">
<span<?php echo $charge_type_list->ChargeTypeDesc->viewAttributes() ?>><?php echo $charge_type_list->ChargeTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_type_list->IncomeType->Visible) { // IncomeType ?>
		<td data-name="IncomeType" <?php echo $charge_type_list->IncomeType->cellAttributes() ?>>
<span id="el<?php echo $charge_type_list->RowCount ?>_charge_type_IncomeType">
<span<?php echo $charge_type_list->IncomeType->viewAttributes() ?>><?php echo $charge_type_list->IncomeType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_type_list->BankCode->Visible) { // BankCode ?>
		<td data-name="BankCode" <?php echo $charge_type_list->BankCode->cellAttributes() ?>>
<span id="el<?php echo $charge_type_list->RowCount ?>_charge_type_BankCode">
<span<?php echo $charge_type_list->BankCode->viewAttributes() ?>><?php echo $charge_type_list->BankCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_type_list->BankAccount->Visible) { // BankAccount ?>
		<td data-name="BankAccount" <?php echo $charge_type_list->BankAccount->cellAttributes() ?>>
<span id="el<?php echo $charge_type_list->RowCount ?>_charge_type_BankAccount">
<span<?php echo $charge_type_list->BankAccount->viewAttributes() ?>><?php echo $charge_type_list->BankAccount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charge_type_list->ListOptions->render("body", "right", $charge_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$charge_type_list->isGridAdd())
		$charge_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$charge_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($charge_type_list->Recordset)
	$charge_type_list->Recordset->Close();
?>
<?php if (!$charge_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$charge_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charge_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($charge_type_list->TotalRecords == 0 && !$charge_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $charge_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$charge_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charge_type_list->isExport()) { ?>
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
$charge_type_list->terminate();
?>