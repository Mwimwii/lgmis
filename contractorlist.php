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
$contractor_list = new contractor_list();

// Run the page
$contractor_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$contractor_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$contractor_list->isExport()) { ?>
<script>
var fcontractorlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcontractorlist = currentForm = new ew.Form("fcontractorlist", "list");
	fcontractorlist.formKeyCountName = '<?php echo $contractor_list->FormKeyCountName ?>';
	loadjs.done("fcontractorlist");
});
var fcontractorlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcontractorlistsrch = currentSearchForm = new ew.Form("fcontractorlistsrch");

	// Dynamic selection lists
	// Filters

	fcontractorlistsrch.filterList = <?php echo $contractor_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcontractorlistsrch.initSearchPanel = true;
	loadjs.done("fcontractorlistsrch");
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
<?php if (!$contractor_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($contractor_list->TotalRecords > 0 && $contractor_list->ExportOptions->visible()) { ?>
<?php $contractor_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($contractor_list->ImportOptions->visible()) { ?>
<?php $contractor_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($contractor_list->SearchOptions->visible()) { ?>
<?php $contractor_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($contractor_list->FilterOptions->visible()) { ?>
<?php $contractor_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$contractor_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$contractor_list->isExport() && !$contractor->CurrentAction) { ?>
<form name="fcontractorlistsrch" id="fcontractorlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcontractorlistsrch-search-panel" class="<?php echo $contractor_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="contractor">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $contractor_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($contractor_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($contractor_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $contractor_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($contractor_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($contractor_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($contractor_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($contractor_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $contractor_list->showPageHeader(); ?>
<?php
$contractor_list->showMessage();
?>
<?php if ($contractor_list->TotalRecords > 0 || $contractor->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($contractor_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> contractor">
<?php if (!$contractor_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$contractor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contractor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcontractorlist" id="fcontractorlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="contractor">
<div id="gmp_contractor" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($contractor_list->TotalRecords > 0 || $contractor_list->isGridEdit()) { ?>
<table id="tbl_contractorlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$contractor->RowType = ROWTYPE_HEADER;

// Render list options
$contractor_list->renderListOptions();

// Render list options (header, left)
$contractor_list->ListOptions->render("header", "left");
?>
<?php if ($contractor_list->ContractorRef->Visible) { // ContractorRef ?>
	<?php if ($contractor_list->SortUrl($contractor_list->ContractorRef) == "") { ?>
		<th data-name="ContractorRef" class="<?php echo $contractor_list->ContractorRef->headerCellClass() ?>"><div id="elh_contractor_ContractorRef" class="contractor_ContractorRef"><div class="ew-table-header-caption"><?php echo $contractor_list->ContractorRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractorRef" class="<?php echo $contractor_list->ContractorRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->ContractorRef) ?>', 1);"><div id="elh_contractor_ContractorRef" class="contractor_ContractorRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->ContractorRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->ContractorRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->ContractorRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($contractor_list->SortUrl($contractor_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $contractor_list->ProvinceCode->headerCellClass() ?>"><div id="elh_contractor_ProvinceCode" class="contractor_ProvinceCode"><div class="ew-table-header-caption"><?php echo $contractor_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $contractor_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->ProvinceCode) ?>', 1);"><div id="elh_contractor_ProvinceCode" class="contractor_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->LACode->Visible) { // LACode ?>
	<?php if ($contractor_list->SortUrl($contractor_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $contractor_list->LACode->headerCellClass() ?>"><div id="elh_contractor_LACode" class="contractor_LACode"><div class="ew-table-header-caption"><?php echo $contractor_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $contractor_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->LACode) ?>', 1);"><div id="elh_contractor_LACode" class="contractor_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->ContractorName->Visible) { // ContractorName ?>
	<?php if ($contractor_list->SortUrl($contractor_list->ContractorName) == "") { ?>
		<th data-name="ContractorName" class="<?php echo $contractor_list->ContractorName->headerCellClass() ?>"><div id="elh_contractor_ContractorName" class="contractor_ContractorName"><div class="ew-table-header-caption"><?php echo $contractor_list->ContractorName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractorName" class="<?php echo $contractor_list->ContractorName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->ContractorName) ?>', 1);"><div id="elh_contractor_ContractorName" class="contractor_ContractorName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->ContractorName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->ContractorName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->ContractorName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->TradingName->Visible) { // TradingName ?>
	<?php if ($contractor_list->SortUrl($contractor_list->TradingName) == "") { ?>
		<th data-name="TradingName" class="<?php echo $contractor_list->TradingName->headerCellClass() ?>"><div id="elh_contractor_TradingName" class="contractor_TradingName"><div class="ew-table-header-caption"><?php echo $contractor_list->TradingName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TradingName" class="<?php echo $contractor_list->TradingName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->TradingName) ?>', 1);"><div id="elh_contractor_TradingName" class="contractor_TradingName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->TradingName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->TradingName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->TradingName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->ZambianContrator->Visible) { // ZambianContrator ?>
	<?php if ($contractor_list->SortUrl($contractor_list->ZambianContrator) == "") { ?>
		<th data-name="ZambianContrator" class="<?php echo $contractor_list->ZambianContrator->headerCellClass() ?>"><div id="elh_contractor_ZambianContrator" class="contractor_ZambianContrator"><div class="ew-table-header-caption"><?php echo $contractor_list->ZambianContrator->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ZambianContrator" class="<?php echo $contractor_list->ZambianContrator->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->ZambianContrator) ?>', 1);"><div id="elh_contractor_ZambianContrator" class="contractor_ZambianContrator">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->ZambianContrator->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->ZambianContrator->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->ZambianContrator->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->ContractorType->Visible) { // ContractorType ?>
	<?php if ($contractor_list->SortUrl($contractor_list->ContractorType) == "") { ?>
		<th data-name="ContractorType" class="<?php echo $contractor_list->ContractorType->headerCellClass() ?>"><div id="elh_contractor_ContractorType" class="contractor_ContractorType"><div class="ew-table-header-caption"><?php echo $contractor_list->ContractorType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContractorType" class="<?php echo $contractor_list->ContractorType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->ContractorType) ?>', 1);"><div id="elh_contractor_ContractorType" class="contractor_ContractorType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->ContractorType->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->ContractorType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->ContractorType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->BusinessType->Visible) { // BusinessType ?>
	<?php if ($contractor_list->SortUrl($contractor_list->BusinessType) == "") { ?>
		<th data-name="BusinessType" class="<?php echo $contractor_list->BusinessType->headerCellClass() ?>"><div id="elh_contractor_BusinessType" class="contractor_BusinessType"><div class="ew-table-header-caption"><?php echo $contractor_list->BusinessType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessType" class="<?php echo $contractor_list->BusinessType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->BusinessType) ?>', 1);"><div id="elh_contractor_BusinessType" class="contractor_BusinessType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->BusinessType->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->BusinessType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->BusinessType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->BusinessSector->Visible) { // BusinessSector ?>
	<?php if ($contractor_list->SortUrl($contractor_list->BusinessSector) == "") { ?>
		<th data-name="BusinessSector" class="<?php echo $contractor_list->BusinessSector->headerCellClass() ?>"><div id="elh_contractor_BusinessSector" class="contractor_BusinessSector"><div class="ew-table-header-caption"><?php echo $contractor_list->BusinessSector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessSector" class="<?php echo $contractor_list->BusinessSector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->BusinessSector) ?>', 1);"><div id="elh_contractor_BusinessSector" class="contractor_BusinessSector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->BusinessSector->caption() ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->BusinessSector->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->BusinessSector->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->BusinessDesc->Visible) { // BusinessDesc ?>
	<?php if ($contractor_list->SortUrl($contractor_list->BusinessDesc) == "") { ?>
		<th data-name="BusinessDesc" class="<?php echo $contractor_list->BusinessDesc->headerCellClass() ?>"><div id="elh_contractor_BusinessDesc" class="contractor_BusinessDesc"><div class="ew-table-header-caption"><?php echo $contractor_list->BusinessDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessDesc" class="<?php echo $contractor_list->BusinessDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->BusinessDesc) ?>', 1);"><div id="elh_contractor_BusinessDesc" class="contractor_BusinessDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->BusinessDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->BusinessDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->BusinessDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->PostalAddress->Visible) { // PostalAddress ?>
	<?php if ($contractor_list->SortUrl($contractor_list->PostalAddress) == "") { ?>
		<th data-name="PostalAddress" class="<?php echo $contractor_list->PostalAddress->headerCellClass() ?>"><div id="elh_contractor_PostalAddress" class="contractor_PostalAddress"><div class="ew-table-header-caption"><?php echo $contractor_list->PostalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalAddress" class="<?php echo $contractor_list->PostalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->PostalAddress) ?>', 1);"><div id="elh_contractor_PostalAddress" class="contractor_PostalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->PostalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->PostalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->PostalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->Town->Visible) { // Town ?>
	<?php if ($contractor_list->SortUrl($contractor_list->Town) == "") { ?>
		<th data-name="Town" class="<?php echo $contractor_list->Town->headerCellClass() ?>"><div id="elh_contractor_Town" class="contractor_Town"><div class="ew-table-header-caption"><?php echo $contractor_list->Town->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Town" class="<?php echo $contractor_list->Town->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->Town) ?>', 1);"><div id="elh_contractor_Town" class="contractor_Town">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->Town->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->Town->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->Town->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->PhysicaAddress->Visible) { // PhysicaAddress ?>
	<?php if ($contractor_list->SortUrl($contractor_list->PhysicaAddress) == "") { ?>
		<th data-name="PhysicaAddress" class="<?php echo $contractor_list->PhysicaAddress->headerCellClass() ?>"><div id="elh_contractor_PhysicaAddress" class="contractor_PhysicaAddress"><div class="ew-table-header-caption"><?php echo $contractor_list->PhysicaAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicaAddress" class="<?php echo $contractor_list->PhysicaAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->PhysicaAddress) ?>', 1);"><div id="elh_contractor_PhysicaAddress" class="contractor_PhysicaAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->PhysicaAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->PhysicaAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->PhysicaAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->_Email->Visible) { // Email ?>
	<?php if ($contractor_list->SortUrl($contractor_list->_Email) == "") { ?>
		<th data-name="_Email" class="<?php echo $contractor_list->_Email->headerCellClass() ?>"><div id="elh_contractor__Email" class="contractor__Email"><div class="ew-table-header-caption"><?php echo $contractor_list->_Email->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_Email" class="<?php echo $contractor_list->_Email->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->_Email) ?>', 1);"><div id="elh_contractor__Email" class="contractor__Email">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->_Email->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->_Email->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->_Email->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->Telephone->Visible) { // Telephone ?>
	<?php if ($contractor_list->SortUrl($contractor_list->Telephone) == "") { ?>
		<th data-name="Telephone" class="<?php echo $contractor_list->Telephone->headerCellClass() ?>"><div id="elh_contractor_Telephone" class="contractor_Telephone"><div class="ew-table-header-caption"><?php echo $contractor_list->Telephone->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Telephone" class="<?php echo $contractor_list->Telephone->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->Telephone) ?>', 1);"><div id="elh_contractor_Telephone" class="contractor_Telephone">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->Telephone->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->Telephone->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->Telephone->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->Mobile->Visible) { // Mobile ?>
	<?php if ($contractor_list->SortUrl($contractor_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $contractor_list->Mobile->headerCellClass() ?>"><div id="elh_contractor_Mobile" class="contractor_Mobile"><div class="ew-table-header-caption"><?php echo $contractor_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $contractor_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->Mobile) ?>', 1);"><div id="elh_contractor_Mobile" class="contractor_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->Fax->Visible) { // Fax ?>
	<?php if ($contractor_list->SortUrl($contractor_list->Fax) == "") { ?>
		<th data-name="Fax" class="<?php echo $contractor_list->Fax->headerCellClass() ?>"><div id="elh_contractor_Fax" class="contractor_Fax"><div class="ew-table-header-caption"><?php echo $contractor_list->Fax->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fax" class="<?php echo $contractor_list->Fax->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->Fax) ?>', 1);"><div id="elh_contractor_Fax" class="contractor_Fax">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->Fax->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->Fax->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->Fax->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->Country->Visible) { // Country ?>
	<?php if ($contractor_list->SortUrl($contractor_list->Country) == "") { ?>
		<th data-name="Country" class="<?php echo $contractor_list->Country->headerCellClass() ?>"><div id="elh_contractor_Country" class="contractor_Country"><div class="ew-table-header-caption"><?php echo $contractor_list->Country->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Country" class="<?php echo $contractor_list->Country->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->Country) ?>', 1);"><div id="elh_contractor_Country" class="contractor_Country">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->Country->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->Country->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->Country->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($contractor_list->ContactPerson->Visible) { // ContactPerson ?>
	<?php if ($contractor_list->SortUrl($contractor_list->ContactPerson) == "") { ?>
		<th data-name="ContactPerson" class="<?php echo $contractor_list->ContactPerson->headerCellClass() ?>"><div id="elh_contractor_ContactPerson" class="contractor_ContactPerson"><div class="ew-table-header-caption"><?php echo $contractor_list->ContactPerson->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ContactPerson" class="<?php echo $contractor_list->ContactPerson->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $contractor_list->SortUrl($contractor_list->ContactPerson) ?>', 1);"><div id="elh_contractor_ContactPerson" class="contractor_ContactPerson">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $contractor_list->ContactPerson->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($contractor_list->ContactPerson->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($contractor_list->ContactPerson->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$contractor_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($contractor_list->ExportAll && $contractor_list->isExport()) {
	$contractor_list->StopRecord = $contractor_list->TotalRecords;
} else {

	// Set the last record to display
	if ($contractor_list->TotalRecords > $contractor_list->StartRecord + $contractor_list->DisplayRecords - 1)
		$contractor_list->StopRecord = $contractor_list->StartRecord + $contractor_list->DisplayRecords - 1;
	else
		$contractor_list->StopRecord = $contractor_list->TotalRecords;
}
$contractor_list->RecordCount = $contractor_list->StartRecord - 1;
if ($contractor_list->Recordset && !$contractor_list->Recordset->EOF) {
	$contractor_list->Recordset->moveFirst();
	$selectLimit = $contractor_list->UseSelectLimit;
	if (!$selectLimit && $contractor_list->StartRecord > 1)
		$contractor_list->Recordset->move($contractor_list->StartRecord - 1);
} elseif (!$contractor->AllowAddDeleteRow && $contractor_list->StopRecord == 0) {
	$contractor_list->StopRecord = $contractor->GridAddRowCount;
}

// Initialize aggregate
$contractor->RowType = ROWTYPE_AGGREGATEINIT;
$contractor->resetAttributes();
$contractor_list->renderRow();
while ($contractor_list->RecordCount < $contractor_list->StopRecord) {
	$contractor_list->RecordCount++;
	if ($contractor_list->RecordCount >= $contractor_list->StartRecord) {
		$contractor_list->RowCount++;

		// Set up key count
		$contractor_list->KeyCount = $contractor_list->RowIndex;

		// Init row class and style
		$contractor->resetAttributes();
		$contractor->CssClass = "";
		if ($contractor_list->isGridAdd()) {
		} else {
			$contractor_list->loadRowValues($contractor_list->Recordset); // Load row values
		}
		$contractor->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$contractor->RowAttrs->merge(["data-rowindex" => $contractor_list->RowCount, "id" => "r" . $contractor_list->RowCount . "_contractor", "data-rowtype" => $contractor->RowType]);

		// Render row
		$contractor_list->renderRow();

		// Render list options
		$contractor_list->renderListOptions();
?>
	<tr <?php echo $contractor->rowAttributes() ?>>
<?php

// Render list options (body, left)
$contractor_list->ListOptions->render("body", "left", $contractor_list->RowCount);
?>
	<?php if ($contractor_list->ContractorRef->Visible) { // ContractorRef ?>
		<td data-name="ContractorRef" <?php echo $contractor_list->ContractorRef->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_ContractorRef">
<span<?php echo $contractor_list->ContractorRef->viewAttributes() ?>><?php echo $contractor_list->ContractorRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $contractor_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_ProvinceCode">
<span<?php echo $contractor_list->ProvinceCode->viewAttributes() ?>><?php echo $contractor_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $contractor_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_LACode">
<span<?php echo $contractor_list->LACode->viewAttributes() ?>><?php echo $contractor_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->ContractorName->Visible) { // ContractorName ?>
		<td data-name="ContractorName" <?php echo $contractor_list->ContractorName->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_ContractorName">
<span<?php echo $contractor_list->ContractorName->viewAttributes() ?>><?php echo $contractor_list->ContractorName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->TradingName->Visible) { // TradingName ?>
		<td data-name="TradingName" <?php echo $contractor_list->TradingName->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_TradingName">
<span<?php echo $contractor_list->TradingName->viewAttributes() ?>><?php echo $contractor_list->TradingName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->ZambianContrator->Visible) { // ZambianContrator ?>
		<td data-name="ZambianContrator" <?php echo $contractor_list->ZambianContrator->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_ZambianContrator">
<span<?php echo $contractor_list->ZambianContrator->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_ZambianContrator" class="custom-control-input" value="<?php echo $contractor_list->ZambianContrator->getViewValue() ?>" disabled<?php if (ConvertToBool($contractor_list->ZambianContrator->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_ZambianContrator"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->ContractorType->Visible) { // ContractorType ?>
		<td data-name="ContractorType" <?php echo $contractor_list->ContractorType->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_ContractorType">
<span<?php echo $contractor_list->ContractorType->viewAttributes() ?>><?php echo $contractor_list->ContractorType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->BusinessType->Visible) { // BusinessType ?>
		<td data-name="BusinessType" <?php echo $contractor_list->BusinessType->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_BusinessType">
<span<?php echo $contractor_list->BusinessType->viewAttributes() ?>><?php echo $contractor_list->BusinessType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->BusinessSector->Visible) { // BusinessSector ?>
		<td data-name="BusinessSector" <?php echo $contractor_list->BusinessSector->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_BusinessSector">
<span<?php echo $contractor_list->BusinessSector->viewAttributes() ?>><?php echo $contractor_list->BusinessSector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->BusinessDesc->Visible) { // BusinessDesc ?>
		<td data-name="BusinessDesc" <?php echo $contractor_list->BusinessDesc->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_BusinessDesc">
<span<?php echo $contractor_list->BusinessDesc->viewAttributes() ?>><?php echo $contractor_list->BusinessDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress" <?php echo $contractor_list->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_PostalAddress">
<span<?php echo $contractor_list->PostalAddress->viewAttributes() ?>><?php echo $contractor_list->PostalAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->Town->Visible) { // Town ?>
		<td data-name="Town" <?php echo $contractor_list->Town->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_Town">
<span<?php echo $contractor_list->Town->viewAttributes() ?>><?php echo $contractor_list->Town->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->PhysicaAddress->Visible) { // PhysicaAddress ?>
		<td data-name="PhysicaAddress" <?php echo $contractor_list->PhysicaAddress->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_PhysicaAddress">
<span<?php echo $contractor_list->PhysicaAddress->viewAttributes() ?>><?php echo $contractor_list->PhysicaAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->_Email->Visible) { // Email ?>
		<td data-name="_Email" <?php echo $contractor_list->_Email->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor__Email">
<span<?php echo $contractor_list->_Email->viewAttributes() ?>><?php echo $contractor_list->_Email->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->Telephone->Visible) { // Telephone ?>
		<td data-name="Telephone" <?php echo $contractor_list->Telephone->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_Telephone">
<span<?php echo $contractor_list->Telephone->viewAttributes() ?>><?php echo $contractor_list->Telephone->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $contractor_list->Mobile->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_Mobile">
<span<?php echo $contractor_list->Mobile->viewAttributes() ?>><?php echo $contractor_list->Mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->Fax->Visible) { // Fax ?>
		<td data-name="Fax" <?php echo $contractor_list->Fax->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_Fax">
<span<?php echo $contractor_list->Fax->viewAttributes() ?>><?php echo $contractor_list->Fax->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->Country->Visible) { // Country ?>
		<td data-name="Country" <?php echo $contractor_list->Country->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_Country">
<span<?php echo $contractor_list->Country->viewAttributes() ?>><?php echo $contractor_list->Country->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($contractor_list->ContactPerson->Visible) { // ContactPerson ?>
		<td data-name="ContactPerson" <?php echo $contractor_list->ContactPerson->cellAttributes() ?>>
<span id="el<?php echo $contractor_list->RowCount ?>_contractor_ContactPerson">
<span<?php echo $contractor_list->ContactPerson->viewAttributes() ?>><?php echo $contractor_list->ContactPerson->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$contractor_list->ListOptions->render("body", "right", $contractor_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$contractor_list->isGridAdd())
		$contractor_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$contractor->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($contractor_list->Recordset)
	$contractor_list->Recordset->Close();
?>
<?php if (!$contractor_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$contractor_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $contractor_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $contractor_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($contractor_list->TotalRecords == 0 && !$contractor->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $contractor_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$contractor_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$contractor_list->isExport()) { ?>
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
$contractor_list->terminate();
?>