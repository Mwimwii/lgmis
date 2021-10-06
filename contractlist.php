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
$contract_list = new contract_list();

// Run the page
$contract_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contract_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contract_list->isExport()) { ?>
<script>
var fcontractlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontractlist = currentForm = new ew.Form("fcontractlist", "list");
	fcontractlist.formKeyCountName = '<?php echo $contract_list->FormKeyCountName ?>';
	loadjs.done("fcontractlist");
});
var fcontractlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontractlistsrch = currentSearchForm = new ew.Form("fcontractlistsrch");

	// Dynamic selection lists
	// Filters

	fcontractlistsrch.filterList = <?php echo $contract_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcontractlistsrch.initSearchPanel = true;
	loadjs.done("fcontractlistsrch");
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
<?php if (!$contract_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contract_list->TotalRecords > 0 && $contract_list->ExportOptions->visible()) { ?>
<?php $contract_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_list->ImportOptions->visible()) { ?>
<?php $contract_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contract_list->SearchOptions->visible()) { ?>
<?php $contract_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contract_list->FilterOptions->visible()) { ?>
<?php $contract_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contract_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contract_list->isExport() && !$contract->CurrentAction) { ?>
<form name="fcontractlistsrch" id="fcontractlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontractlistsrch-search-panel" class="<?php echo $contract_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contract">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $contract_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contract_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contract_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contract_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contract_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contract_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contract_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contract_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contract_list->showPageHeader(); ?>
<?php
$contract_list->showMessage();
?>
<?php if ($contract_list->TotalRecords > 0 || $contract->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contract_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contract">
<?php if (!$contract_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contract_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontractlist" id="fcontractlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contract">
<div id="gmp_contract" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contract_list->TotalRecords > 0 || $contract_list->isGridEdit()) { ?>
<table id="tbl_contractlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contract->RowType = ROWTYPE_HEADER;

// Render list options
$contract_list->renderListOptions();

// Render list options (header, left)
$contract_list->ListOptions->render("header", "left");
?>
<?php if ($contract_list->LACode->Visible) { // LACode ?>
	<?php if ($contract_list->SortUrl($contract_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $contract_list->LACode->headerCellClass() ?>"><div id="elh_contract_LACode" class="contract_LACode"><div class="ew-table-header-caption"><?php echo $contract_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $contract_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->LACode) ?>', 1);"><div id="elh_contract_LACode" class="contract_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($contract_list->SortUrl($contract_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $contract_list->DepartmentCode->headerCellClass() ?>"><div id="elh_contract_DepartmentCode" class="contract_DepartmentCode"><div class="ew-table-header-caption"><?php echo $contract_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $contract_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->DepartmentCode) ?>', 1);"><div id="elh_contract_DepartmentCode" class="contract_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->SectionCode->Visible) { // SectionCode ?>
	<?php if ($contract_list->SortUrl($contract_list->SectionCode) == "") { ?>
		<th data-name="SectionCode" class="<?php echo $contract_list->SectionCode->headerCellClass() ?>"><div id="elh_contract_SectionCode" class="contract_SectionCode"><div class="ew-table-header-caption"><?php echo $contract_list->SectionCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SectionCode" class="<?php echo $contract_list->SectionCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->SectionCode) ?>', 1);"><div id="elh_contract_SectionCode" class="contract_SectionCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->SectionCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->SectionCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->SectionCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ProjectCode->Visible) { // ProjectCode ?>
	<?php if ($contract_list->SortUrl($contract_list->ProjectCode) == "") { ?>
		<th data-name="ProjectCode" class="<?php echo $contract_list->ProjectCode->headerCellClass() ?>"><div id="elh_contract_ProjectCode" class="contract_ProjectCode"><div class="ew-table-header-caption"><?php echo $contract_list->ProjectCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProjectCode" class="<?php echo $contract_list->ProjectCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ProjectCode) ?>', 1);"><div id="elh_contract_ProjectCode" class="contract_ProjectCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ProjectCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ProjectCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ProjectCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ContractNo->Visible) { // ContractNo ?>
	<?php if ($contract_list->SortUrl($contract_list->ContractNo) == "") { ?>
		<th data-name="ContractNo" class="<?php echo $contract_list->ContractNo->headerCellClass() ?>"><div id="elh_contract_ContractNo" class="contract_ContractNo"><div class="ew-table-header-caption"><?php echo $contract_list->ContractNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractNo" class="<?php echo $contract_list->ContractNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ContractNo) ?>', 1);"><div id="elh_contract_ContractNo" class="contract_ContractNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ContractNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ContractNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ContractNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ContractName->Visible) { // ContractName ?>
	<?php if ($contract_list->SortUrl($contract_list->ContractName) == "") { ?>
		<th data-name="ContractName" class="<?php echo $contract_list->ContractName->headerCellClass() ?>"><div id="elh_contract_ContractName" class="contract_ContractName"><div class="ew-table-header-caption"><?php echo $contract_list->ContractName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractName" class="<?php echo $contract_list->ContractName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ContractName) ?>', 1);"><div id="elh_contract_ContractName" class="contract_ContractName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ContractName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ContractName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ContractName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ContractType->Visible) { // ContractType ?>
	<?php if ($contract_list->SortUrl($contract_list->ContractType) == "") { ?>
		<th data-name="ContractType" class="<?php echo $contract_list->ContractType->headerCellClass() ?>"><div id="elh_contract_ContractType" class="contract_ContractType"><div class="ew-table-header-caption"><?php echo $contract_list->ContractType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractType" class="<?php echo $contract_list->ContractType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ContractType) ?>', 1);"><div id="elh_contract_ContractType" class="contract_ContractType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ContractType->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ContractType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ContractType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ContractSum->Visible) { // ContractSum ?>
	<?php if ($contract_list->SortUrl($contract_list->ContractSum) == "") { ?>
		<th data-name="ContractSum" class="<?php echo $contract_list->ContractSum->headerCellClass() ?>"><div id="elh_contract_ContractSum" class="contract_ContractSum"><div class="ew-table-header-caption"><?php echo $contract_list->ContractSum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractSum" class="<?php echo $contract_list->ContractSum->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ContractSum) ?>', 1);"><div id="elh_contract_ContractSum" class="contract_ContractSum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ContractSum->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ContractSum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ContractSum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->RevisedContractSum->Visible) { // RevisedContractSum ?>
	<?php if ($contract_list->SortUrl($contract_list->RevisedContractSum) == "") { ?>
		<th data-name="RevisedContractSum" class="<?php echo $contract_list->RevisedContractSum->headerCellClass() ?>"><div id="elh_contract_RevisedContractSum" class="contract_RevisedContractSum"><div class="ew-table-header-caption"><?php echo $contract_list->RevisedContractSum->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RevisedContractSum" class="<?php echo $contract_list->RevisedContractSum->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->RevisedContractSum) ?>', 1);"><div id="elh_contract_RevisedContractSum" class="contract_RevisedContractSum">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->RevisedContractSum->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->RevisedContractSum->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->RevisedContractSum->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ContractorRef->Visible) { // ContractorRef ?>
	<?php if ($contract_list->SortUrl($contract_list->ContractorRef) == "") { ?>
		<th data-name="ContractorRef" class="<?php echo $contract_list->ContractorRef->headerCellClass() ?>"><div id="elh_contract_ContractorRef" class="contract_ContractorRef"><div class="ew-table-header-caption"><?php echo $contract_list->ContractorRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractorRef" class="<?php echo $contract_list->ContractorRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ContractorRef) ?>', 1);"><div id="elh_contract_ContractorRef" class="contract_ContractorRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ContractorRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ContractorRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ContractorRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->SigningDate->Visible) { // SigningDate ?>
	<?php if ($contract_list->SortUrl($contract_list->SigningDate) == "") { ?>
		<th data-name="SigningDate" class="<?php echo $contract_list->SigningDate->headerCellClass() ?>"><div id="elh_contract_SigningDate" class="contract_SigningDate"><div class="ew-table-header-caption"><?php echo $contract_list->SigningDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SigningDate" class="<?php echo $contract_list->SigningDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->SigningDate) ?>', 1);"><div id="elh_contract_SigningDate" class="contract_SigningDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->SigningDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->SigningDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->SigningDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
	<?php if ($contract_list->SortUrl($contract_list->PlannedStartDate) == "") { ?>
		<th data-name="PlannedStartDate" class="<?php echo $contract_list->PlannedStartDate->headerCellClass() ?>"><div id="elh_contract_PlannedStartDate" class="contract_PlannedStartDate"><div class="ew-table-header-caption"><?php echo $contract_list->PlannedStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedStartDate" class="<?php echo $contract_list->PlannedStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->PlannedStartDate) ?>', 1);"><div id="elh_contract_PlannedStartDate" class="contract_PlannedStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->PlannedStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->PlannedStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->PlannedStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
	<?php if ($contract_list->SortUrl($contract_list->PlannedEndDate) == "") { ?>
		<th data-name="PlannedEndDate" class="<?php echo $contract_list->PlannedEndDate->headerCellClass() ?>"><div id="elh_contract_PlannedEndDate" class="contract_PlannedEndDate"><div class="ew-table-header-caption"><?php echo $contract_list->PlannedEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PlannedEndDate" class="<?php echo $contract_list->PlannedEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->PlannedEndDate) ?>', 1);"><div id="elh_contract_PlannedEndDate" class="contract_PlannedEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->PlannedEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->PlannedEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->PlannedEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ActualStartDate->Visible) { // ActualStartDate ?>
	<?php if ($contract_list->SortUrl($contract_list->ActualStartDate) == "") { ?>
		<th data-name="ActualStartDate" class="<?php echo $contract_list->ActualStartDate->headerCellClass() ?>"><div id="elh_contract_ActualStartDate" class="contract_ActualStartDate"><div class="ew-table-header-caption"><?php echo $contract_list->ActualStartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualStartDate" class="<?php echo $contract_list->ActualStartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ActualStartDate) ?>', 1);"><div id="elh_contract_ActualStartDate" class="contract_ActualStartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ActualStartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ActualStartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ActualStartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ActualEndDate->Visible) { // ActualEndDate ?>
	<?php if ($contract_list->SortUrl($contract_list->ActualEndDate) == "") { ?>
		<th data-name="ActualEndDate" class="<?php echo $contract_list->ActualEndDate->headerCellClass() ?>"><div id="elh_contract_ActualEndDate" class="contract_ActualEndDate"><div class="ew-table-header-caption"><?php echo $contract_list->ActualEndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ActualEndDate" class="<?php echo $contract_list->ActualEndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ActualEndDate) ?>', 1);"><div id="elh_contract_ActualEndDate" class="contract_ActualEndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ActualEndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ActualEndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ActualEndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->Duration->Visible) { // Duration ?>
	<?php if ($contract_list->SortUrl($contract_list->Duration) == "") { ?>
		<th data-name="Duration" class="<?php echo $contract_list->Duration->headerCellClass() ?>"><div id="elh_contract_Duration" class="contract_Duration"><div class="ew-table-header-caption"><?php echo $contract_list->Duration->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Duration" class="<?php echo $contract_list->Duration->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->Duration) ?>', 1);"><div id="elh_contract_Duration" class="contract_Duration">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->Duration->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->Duration->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->Duration->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($contract_list->SortUrl($contract_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $contract_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_contract_UnitOfMeasure" class="contract_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $contract_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $contract_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->UnitOfMeasure) ?>', 1);"><div id="elh_contract_UnitOfMeasure" class="contract_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
	<?php if ($contract_list->SortUrl($contract_list->AdvancePaymentAmount) == "") { ?>
		<th data-name="AdvancePaymentAmount" class="<?php echo $contract_list->AdvancePaymentAmount->headerCellClass() ?>"><div id="elh_contract_AdvancePaymentAmount" class="contract_AdvancePaymentAmount"><div class="ew-table-header-caption"><?php echo $contract_list->AdvancePaymentAmount->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdvancePaymentAmount" class="<?php echo $contract_list->AdvancePaymentAmount->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->AdvancePaymentAmount) ?>', 1);"><div id="elh_contract_AdvancePaymentAmount" class="contract_AdvancePaymentAmount">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->AdvancePaymentAmount->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->AdvancePaymentAmount->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->AdvancePaymentAmount->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
	<?php if ($contract_list->SortUrl($contract_list->AdvancePaymentdate) == "") { ?>
		<th data-name="AdvancePaymentdate" class="<?php echo $contract_list->AdvancePaymentdate->headerCellClass() ?>"><div id="elh_contract_AdvancePaymentdate" class="contract_AdvancePaymentdate"><div class="ew-table-header-caption"><?php echo $contract_list->AdvancePaymentdate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AdvancePaymentdate" class="<?php echo $contract_list->AdvancePaymentdate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->AdvancePaymentdate) ?>', 1);"><div id="elh_contract_AdvancePaymentdate" class="contract_AdvancePaymentdate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->AdvancePaymentdate->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->AdvancePaymentdate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->AdvancePaymentdate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contract_list->ContractStatus->Visible) { // ContractStatus ?>
	<?php if ($contract_list->SortUrl($contract_list->ContractStatus) == "") { ?>
		<th data-name="ContractStatus" class="<?php echo $contract_list->ContractStatus->headerCellClass() ?>"><div id="elh_contract_ContractStatus" class="contract_ContractStatus"><div class="ew-table-header-caption"><?php echo $contract_list->ContractStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractStatus" class="<?php echo $contract_list->ContractStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contract_list->SortUrl($contract_list->ContractStatus) ?>', 1);"><div id="elh_contract_ContractStatus" class="contract_ContractStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contract_list->ContractStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($contract_list->ContractStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contract_list->ContractStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contract_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contract_list->ExportAll && $contract_list->isExport()) {
	$contract_list->StopRecord = $contract_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contract_list->TotalRecords > $contract_list->StartRecord + $contract_list->DisplayRecords - 1)
		$contract_list->StopRecord = $contract_list->StartRecord + $contract_list->DisplayRecords - 1;
	else
		$contract_list->StopRecord = $contract_list->TotalRecords;
}
$contract_list->RecordCount = $contract_list->StartRecord - 1;
if ($contract_list->Recordset && !$contract_list->Recordset->EOF) {
	$contract_list->Recordset->moveFirst();
	$selectLimit = $contract_list->UseSelectLimit;
	if (!$selectLimit && $contract_list->StartRecord > 1)
		$contract_list->Recordset->move($contract_list->StartRecord - 1);
} elseif (!$contract->AllowAddDeleteRow && $contract_list->StopRecord == 0) {
	$contract_list->StopRecord = $contract->GridAddRowCount;
}

// Initialize aggregate
$contract->RowType = ROWTYPE_AGGREGATEINIT;
$contract->resetAttributes();
$contract_list->renderRow();
while ($contract_list->RecordCount < $contract_list->StopRecord) {
	$contract_list->RecordCount++;
	if ($contract_list->RecordCount >= $contract_list->StartRecord) {
		$contract_list->RowCount++;

		// Set up key count
		$contract_list->KeyCount = $contract_list->RowIndex;

		// Init row class and style
		$contract->resetAttributes();
		$contract->CssClass = "";
		if ($contract_list->isGridAdd()) {
		} else {
			$contract_list->loadRowValues($contract_list->Recordset); // Load row values
		}
		$contract->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contract->RowAttrs->merge(["data-rowindex" => $contract_list->RowCount, "id" => "r" . $contract_list->RowCount . "_contract", "data-rowtype" => $contract->RowType]);

		// Render row
		$contract_list->renderRow();

		// Render list options
		$contract_list->renderListOptions();
?>
	<tr <?php echo $contract->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contract_list->ListOptions->render("body", "left", $contract_list->RowCount);
?>
	<?php if ($contract_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $contract_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_LACode">
<span<?php echo $contract_list->LACode->viewAttributes() ?>><?php echo $contract_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $contract_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_DepartmentCode">
<span<?php echo $contract_list->DepartmentCode->viewAttributes() ?>><?php echo $contract_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->SectionCode->Visible) { // SectionCode ?>
		<td data-name="SectionCode" <?php echo $contract_list->SectionCode->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_SectionCode">
<span<?php echo $contract_list->SectionCode->viewAttributes() ?>><?php echo $contract_list->SectionCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ProjectCode->Visible) { // ProjectCode ?>
		<td data-name="ProjectCode" <?php echo $contract_list->ProjectCode->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ProjectCode">
<span<?php echo $contract_list->ProjectCode->viewAttributes() ?>><?php echo $contract_list->ProjectCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ContractNo->Visible) { // ContractNo ?>
		<td data-name="ContractNo" <?php echo $contract_list->ContractNo->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ContractNo">
<span<?php echo $contract_list->ContractNo->viewAttributes() ?>><?php echo $contract_list->ContractNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ContractName->Visible) { // ContractName ?>
		<td data-name="ContractName" <?php echo $contract_list->ContractName->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ContractName">
<span<?php echo $contract_list->ContractName->viewAttributes() ?>><?php echo $contract_list->ContractName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ContractType->Visible) { // ContractType ?>
		<td data-name="ContractType" <?php echo $contract_list->ContractType->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ContractType">
<span<?php echo $contract_list->ContractType->viewAttributes() ?>><?php echo $contract_list->ContractType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ContractSum->Visible) { // ContractSum ?>
		<td data-name="ContractSum" <?php echo $contract_list->ContractSum->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ContractSum">
<span<?php echo $contract_list->ContractSum->viewAttributes() ?>><?php echo $contract_list->ContractSum->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->RevisedContractSum->Visible) { // RevisedContractSum ?>
		<td data-name="RevisedContractSum" <?php echo $contract_list->RevisedContractSum->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_RevisedContractSum">
<span<?php echo $contract_list->RevisedContractSum->viewAttributes() ?>><?php echo $contract_list->RevisedContractSum->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ContractorRef->Visible) { // ContractorRef ?>
		<td data-name="ContractorRef" <?php echo $contract_list->ContractorRef->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ContractorRef">
<span<?php echo $contract_list->ContractorRef->viewAttributes() ?>><?php echo $contract_list->ContractorRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->SigningDate->Visible) { // SigningDate ?>
		<td data-name="SigningDate" <?php echo $contract_list->SigningDate->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_SigningDate">
<span<?php echo $contract_list->SigningDate->viewAttributes() ?>><?php echo $contract_list->SigningDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->PlannedStartDate->Visible) { // PlannedStartDate ?>
		<td data-name="PlannedStartDate" <?php echo $contract_list->PlannedStartDate->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_PlannedStartDate">
<span<?php echo $contract_list->PlannedStartDate->viewAttributes() ?>><?php echo $contract_list->PlannedStartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->PlannedEndDate->Visible) { // PlannedEndDate ?>
		<td data-name="PlannedEndDate" <?php echo $contract_list->PlannedEndDate->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_PlannedEndDate">
<span<?php echo $contract_list->PlannedEndDate->viewAttributes() ?>><?php echo $contract_list->PlannedEndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ActualStartDate->Visible) { // ActualStartDate ?>
		<td data-name="ActualStartDate" <?php echo $contract_list->ActualStartDate->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ActualStartDate">
<span<?php echo $contract_list->ActualStartDate->viewAttributes() ?>><?php echo $contract_list->ActualStartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ActualEndDate->Visible) { // ActualEndDate ?>
		<td data-name="ActualEndDate" <?php echo $contract_list->ActualEndDate->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ActualEndDate">
<span<?php echo $contract_list->ActualEndDate->viewAttributes() ?>><?php echo $contract_list->ActualEndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->Duration->Visible) { // Duration ?>
		<td data-name="Duration" <?php echo $contract_list->Duration->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_Duration">
<span<?php echo $contract_list->Duration->viewAttributes() ?>><?php echo $contract_list->Duration->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $contract_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_UnitOfMeasure">
<span<?php echo $contract_list->UnitOfMeasure->viewAttributes() ?>><?php echo $contract_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->AdvancePaymentAmount->Visible) { // AdvancePaymentAmount ?>
		<td data-name="AdvancePaymentAmount" <?php echo $contract_list->AdvancePaymentAmount->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_AdvancePaymentAmount">
<span<?php echo $contract_list->AdvancePaymentAmount->viewAttributes() ?>><?php echo $contract_list->AdvancePaymentAmount->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->AdvancePaymentdate->Visible) { // AdvancePaymentdate ?>
		<td data-name="AdvancePaymentdate" <?php echo $contract_list->AdvancePaymentdate->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_AdvancePaymentdate">
<span<?php echo $contract_list->AdvancePaymentdate->viewAttributes() ?>><?php echo $contract_list->AdvancePaymentdate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contract_list->ContractStatus->Visible) { // ContractStatus ?>
		<td data-name="ContractStatus" <?php echo $contract_list->ContractStatus->cellAttributes() ?>>
<span id="el<?php echo $contract_list->RowCount ?>_contract_ContractStatus">
<span<?php echo $contract_list->ContractStatus->viewAttributes() ?>><?php echo $contract_list->ContractStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contract_list->ListOptions->render("body", "right", $contract_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$contract_list->isGridAdd())
		$contract_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$contract->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contract_list->Recordset)
	$contract_list->Recordset->Close();
?>
<?php if (!$contract_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contract_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contract_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contract_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contract_list->TotalRecords == 0 && !$contract->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contract_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contract_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contract_list->isExport()) { ?>
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
$contract_list->terminate();
?>