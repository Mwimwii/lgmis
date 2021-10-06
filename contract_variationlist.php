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
$contract_variation_list = new contract_variation_list();

// Run the page
$contract_variation_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_variation_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_variation_list->isExport()) { ?>
<script>
var fcontract_variationlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontract_variationlist = currentForm = new ew.Form("fcontract_variationlist", "list");
	fcontract_variationlist.formKeyCountName = '<?php echo $contract_variation_list->FormKeyCountName ?>';
	loadjs.done("fcontract_variationlist");
});
var fcontract_variationlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontract_variationlistsrch = currentSearchForm = new ew.Form("fcontract_variationlistsrch");

	// Dynamic selection lists
	// Filters

	fcontract_variationlistsrch.filterList = <?php echo $contract_variation_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcontract_variationlistsrch.initSearchPanel = true;
	loadjs.done("fcontract_variationlistsrch");
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
<?php if (!$contract_variation_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contract_variation_list->TotalRecords > 0 && $contract_variation_list->ExportOptions->visible()) { ?>
<?php $contract_variation_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_variation_list->ImportOptions->visible()) { ?>
<?php $contract_variation_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_variation_list->SearchOptions->visible()) { ?>
<?php $contract_variation_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contract_variation_list->FilterOptions->visible()) { ?>
<?php $contract_variation_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$contract_variation_list->isExport() || Config("EXPORT_MASTER_RECORD") && $contract_variation_list->isExport("print")) { ?>
<?php
if ($contract_variation_list->DbMasterFilter != "" && $contract_variation->getCurrentMasterTable() == "contract") {
	if ($contract_variation_list->MasterRecordExists) {
		include_once "contractmaster.php";
	}
}
?>
<?php } ?>
<?php
$contract_variation_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contract_variation_list->isExport() && !$contract_variation->CurrentAction) { ?>
<form name="fcontract_variationlistsrch" id="fcontract_variationlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontract_variationlistsrch-search-panel" class="<?php echo $contract_variation_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contract_variation">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $contract_variation_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contract_variation_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contract_variation_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contract_variation_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contract_variation_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contract_variation_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contract_variation_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contract_variation_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contract_variation_list->showPageHeader(); ?>
<?php
$contract_variation_list->showMessage();
?>
<?php if ($contract_variation_list->TotalRecords > 0 || $contract_variation->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contract_variation_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contract_variation">
<?php if (!$contract_variation_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contract_variation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_variation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_variation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontract_variationlist" id="fcontract_variationlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract_variation">
<?php if ($contract_variation->getCurrentMasterTable() == "contract" && $contract_variation->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="contract">
<input type="hidden" name="fk_ContractNo" value="<?php echo HtmlEncode($contract_variation_list->ContractNo->getSessionValue()) ?>">
<input type="hidden" name="fk_DepartmentCode" value="<?php echo HtmlEncode($contract_variation_list->DepartmentCode->getSessionValue()) ?>">
<input type="hidden" name="fk_LACode" value="<?php echo HtmlEncode($contract_variation_list->LACode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_contract_variation" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contract_variation_list->TotalRecords > 0 || $contract_variation_list->isGridEdit()) { ?>
<table id="tbl_contract_variationlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contract_variation->RowType = ROWTYPE_HEADER;

// Render list options
$contract_variation_list->renderListOptions();

// Render list options (header, left)
$contract_variation_list->ListOptions->render("header", "left");
?>
<?php if ($contract_variation_list->LACode->Visible) { // LACode ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $contract_variation_list->LACode->headerCellClass() ?>"><div id="elh_contract_variation_LACode" class="contract_variation_LACode"><div class="ew-table-header-caption"><?php echo $contract_variation_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $contract_variation_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->LACode) ?>', 1);"><div id="elh_contract_variation_LACode" class="contract_variation_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $contract_variation_list->DepartmentCode->headerCellClass() ?>"><div id="elh_contract_variation_DepartmentCode" class="contract_variation_DepartmentCode"><div class="ew-table-header-caption"><?php echo $contract_variation_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $contract_variation_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->DepartmentCode) ?>', 1);"><div id="elh_contract_variation_DepartmentCode" class="contract_variation_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $contract_variation_list->SectionCode->headerCellClass() ?>"><div id="elh_contract_variation_SectionCode" class="contract_variation_SectionCode"><div class="ew-table-header-caption"><?php echo $contract_variation_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $contract_variation_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->SectionCode) ?>', 1);"><div id="elh_contract_variation_SectionCode" class="contract_variation_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->ContractNo->Visible) { // ContractNo ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->ContractNo) == "") { ?>
		<th data-name="ContractNo" class="<?php echo $contract_variation_list->ContractNo->headerCellClass() ?>"><div id="elh_contract_variation_ContractNo" class="contract_variation_ContractNo"><div class="ew-table-header-caption"><?php echo $contract_variation_list->ContractNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractNo" class="<?php echo $contract_variation_list->ContractNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->ContractNo) ?>', 1);"><div id="elh_contract_variation_ContractNo" class="contract_variation_ContractNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->ContractNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->ContractNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->ContractNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->VariationAmount->Visible) { // VariationAmount ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->VariationAmount) == "") { ?>
		<th data-name="VariationAmount" class="<?php echo $contract_variation_list->VariationAmount->headerCellClass() ?>"><div id="elh_contract_variation_VariationAmount" class="contract_variation_VariationAmount"><div class="ew-table-header-caption"><?php echo $contract_variation_list->VariationAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationAmount" class="<?php echo $contract_variation_list->VariationAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->VariationAmount) ?>', 1);"><div id="elh_contract_variation_VariationAmount" class="contract_variation_VariationAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->VariationAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->VariationAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->VariationAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->VariationNo->Visible) { // VariationNo ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->VariationNo) == "") { ?>
		<th data-name="VariationNo" class="<?php echo $contract_variation_list->VariationNo->headerCellClass() ?>"><div id="elh_contract_variation_VariationNo" class="contract_variation_VariationNo"><div class="ew-table-header-caption"><?php echo $contract_variation_list->VariationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationNo" class="<?php echo $contract_variation_list->VariationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->VariationNo) ?>', 1);"><div id="elh_contract_variation_VariationNo" class="contract_variation_VariationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->VariationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->VariationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->VariationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->VariationDate->Visible) { // VariationDate ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->VariationDate) == "") { ?>
		<th data-name="VariationDate" class="<?php echo $contract_variation_list->VariationDate->headerCellClass() ?>"><div id="elh_contract_variation_VariationDate" class="contract_variation_VariationDate"><div class="ew-table-header-caption"><?php echo $contract_variation_list->VariationDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationDate" class="<?php echo $contract_variation_list->VariationDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->VariationDate) ?>', 1);"><div id="elh_contract_variation_VariationDate" class="contract_variation_VariationDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->VariationDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->VariationDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->VariationDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_variation_list->VariationJustification->Visible) { // VariationJustification ?>
	<?php if ($contract_variation_list->SortUrl($contract_variation_list->VariationJustification) == "") { ?>
		<th data-name="VariationJustification" class="<?php echo $contract_variation_list->VariationJustification->headerCellClass() ?>"><div id="elh_contract_variation_VariationJustification" class="contract_variation_VariationJustification"><div class="ew-table-header-caption"><?php echo $contract_variation_list->VariationJustification->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VariationJustification" class="<?php echo $contract_variation_list->VariationJustification->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_variation_list->SortUrl($contract_variation_list->VariationJustification) ?>', 1);"><div id="elh_contract_variation_VariationJustification" class="contract_variation_VariationJustification">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_variation_list->VariationJustification->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_variation_list->VariationJustification->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_variation_list->VariationJustification->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contract_variation_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contract_variation_list->ExportAll && $contract_variation_list->isExport()) {
	$contract_variation_list->StopRecord = $contract_variation_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contract_variation_list->TotalRecords > $contract_variation_list->StartRecord + $contract_variation_list->DisplayRecords - 1)
		$contract_variation_list->StopRecord = $contract_variation_list->StartRecord + $contract_variation_list->DisplayRecords - 1;
	else
		$contract_variation_list->StopRecord = $contract_variation_list->TotalRecords;
}
$contract_variation_list->RecordCount = $contract_variation_list->StartRecord - 1;
if ($contract_variation_list->Recordset && !$contract_variation_list->Recordset->EOF) {
	$contract_variation_list->Recordset->moveFirst();
	$selectLimit = $contract_variation_list->UseSelectLimit;
	if (!$selectLimit && $contract_variation_list->StartRecord > 1)
		$contract_variation_list->Recordset->move($contract_variation_list->StartRecord - 1);
} elseif (!$contract_variation->AllowAddDeleteRow && $contract_variation_list->StopRecord == 0) {
	$contract_variation_list->StopRecord = $contract_variation->GridAddRowCount;
}

// Initialize aggregate
$contract_variation->RowType = ROWTYPE_AGGREGATEINIT;
$contract_variation->resetAttributes();
$contract_variation_list->renderRow();
while ($contract_variation_list->RecordCount < $contract_variation_list->StopRecord) {
	$contract_variation_list->RecordCount++;
	if ($contract_variation_list->RecordCount >= $contract_variation_list->StartRecord) {
		$contract_variation_list->RowCount++;

		// Set up key count
		$contract_variation_list->KeyCount = $contract_variation_list->RowIndex;

		// Init row class and style
		$contract_variation->resetAttributes();
		$contract_variation->CssClass = "";
		if ($contract_variation_list->isGridAdd()) {
		} else {
			$contract_variation_list->loadRowValues($contract_variation_list->Recordset); // Load row values
		}
		$contract_variation->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contract_variation->RowAttrs->merge(["data-rowindex" => $contract_variation_list->RowCount, "id" => "r" . $contract_variation_list->RowCount . "_contract_variation", "data-rowtype" => $contract_variation->RowType]);

		// Render row
		$contract_variation_list->renderRow();

		// Render list options
		$contract_variation_list->renderListOptions();
?>
	<tr <?php echo $contract_variation->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_variation_list->ListOptions->render("body", "left", $contract_variation_list->RowCount);
?>
	<?php if ($contract_variation_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $contract_variation_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_LACode">
<span<?php echo $contract_variation_list->LACode->viewAttributes() ?>><?php echo $contract_variation_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $contract_variation_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_DepartmentCode">
<span<?php echo $contract_variation_list->DepartmentCode->viewAttributes() ?>><?php echo $contract_variation_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $contract_variation_list->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_SectionCode">
<span<?php echo $contract_variation_list->SectionCode->viewAttributes() ?>><?php echo $contract_variation_list->SectionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo" <?php echo $contract_variation_list->ContractNo->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_ContractNo">
<span<?php echo $contract_variation_list->ContractNo->viewAttributes() ?>><?php echo $contract_variation_list->ContractNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->VariationAmount->Visible) { // VariationAmount ?>
		<td data-name="VariationAmount" <?php echo $contract_variation_list->VariationAmount->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_VariationAmount">
<span<?php echo $contract_variation_list->VariationAmount->viewAttributes() ?>><?php echo $contract_variation_list->VariationAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->VariationNo->Visible) { // VariationNo ?>
		<td data-name="VariationNo" <?php echo $contract_variation_list->VariationNo->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_VariationNo">
<span<?php echo $contract_variation_list->VariationNo->viewAttributes() ?>><?php echo $contract_variation_list->VariationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->VariationDate->Visible) { // VariationDate ?>
		<td data-name="VariationDate" <?php echo $contract_variation_list->VariationDate->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_VariationDate">
<span<?php echo $contract_variation_list->VariationDate->viewAttributes() ?>><?php echo $contract_variation_list->VariationDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_variation_list->VariationJustification->Visible) { // VariationJustification ?>
		<td data-name="VariationJustification" <?php echo $contract_variation_list->VariationJustification->cellAttributes() ?>>
<span id="el<?php echo $contract_variation_list->RowCount ?>_contract_variation_VariationJustification">
<span<?php echo $contract_variation_list->VariationJustification->viewAttributes() ?>><?php echo $contract_variation_list->VariationJustification->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_variation_list->ListOptions->render("body", "right", $contract_variation_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$contract_variation_list->isGridAdd())
		$contract_variation_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$contract_variation->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contract_variation_list->Recordset)
	$contract_variation_list->Recordset->Close();
?>
<?php if (!$contract_variation_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contract_variation_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_variation_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_variation_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contract_variation_list->TotalRecords == 0 && !$contract_variation->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contract_variation_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contract_variation_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_variation_list->isExport()) { ?>
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
$contract_variation_list->terminate();
?>