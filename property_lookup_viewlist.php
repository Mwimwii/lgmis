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
$property_lookup_view_list = new property_lookup_view_list();

// Run the page
$property_lookup_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_lookup_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_lookup_view_list->isExport()) { ?>
<script>
var fproperty_lookup_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_lookup_viewlist = currentForm = new ew.Form("fproperty_lookup_viewlist", "list");
	fproperty_lookup_viewlist.formKeyCountName = '<?php echo $property_lookup_view_list->FormKeyCountName ?>';
	loadjs.done("fproperty_lookup_viewlist");
});
var fproperty_lookup_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_lookup_viewlistsrch = currentSearchForm = new ew.Form("fproperty_lookup_viewlistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_lookup_viewlistsrch.filterList = <?php echo $property_lookup_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_lookup_viewlistsrch.initSearchPanel = true;
	loadjs.done("fproperty_lookup_viewlistsrch");
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
<?php if (!$property_lookup_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_lookup_view_list->TotalRecords > 0 && $property_lookup_view_list->ExportOptions->visible()) { ?>
<?php $property_lookup_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_lookup_view_list->ImportOptions->visible()) { ?>
<?php $property_lookup_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_lookup_view_list->SearchOptions->visible()) { ?>
<?php $property_lookup_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_lookup_view_list->FilterOptions->visible()) { ?>
<?php $property_lookup_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$property_lookup_view_list->isExport() || Config("EXPORT_MASTER_RECORD") && $property_lookup_view_list->isExport("print")) { ?>
<?php
if ($property_lookup_view_list->DbMasterFilter != "" && $property_lookup_view->getCurrentMasterTable() == "client") {
	if ($property_lookup_view_list->MasterRecordExists) {
		include_once "clientmaster.php";
	}
}
?>
<?php } ?>
<?php
$property_lookup_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_lookup_view_list->isExport() && !$property_lookup_view->CurrentAction) { ?>
<form name="fproperty_lookup_viewlistsrch" id="fproperty_lookup_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_lookup_viewlistsrch-search-panel" class="<?php echo $property_lookup_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_lookup_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_lookup_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_lookup_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_lookup_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_lookup_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_lookup_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_lookup_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_lookup_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_lookup_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_lookup_view_list->showPageHeader(); ?>
<?php
$property_lookup_view_list->showMessage();
?>
<?php if ($property_lookup_view_list->TotalRecords > 0 || $property_lookup_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_lookup_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_lookup_view">
<?php if (!$property_lookup_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_lookup_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_lookup_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_lookup_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_lookup_viewlist" id="fproperty_lookup_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_lookup_view">
<?php if ($property_lookup_view->getCurrentMasterTable() == "client" && $property_lookup_view->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($property_lookup_view_list->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_property_lookup_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_lookup_view_list->TotalRecords > 0 || $property_lookup_view_list->isGridEdit()) { ?>
<table id="tbl_property_lookup_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_lookup_view->RowType = ROWTYPE_HEADER;

// Render list options
$property_lookup_view_list->renderListOptions();

// Render list options (header, left)
$property_lookup_view_list->ListOptions->render("header", "left");
?>
<?php if ($property_lookup_view_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_lookup_view_list->ValuationNo->headerCellClass() ?>"><div id="elh_property_lookup_view_ValuationNo" class="property_lookup_view_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_lookup_view_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->ValuationNo) ?>', 1);"><div id="elh_property_lookup_view_ValuationNo" class="property_lookup_view_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $property_lookup_view_list->PropertyNo->headerCellClass() ?>"><div id="elh_property_lookup_view_PropertyNo" class="property_lookup_view_PropertyNo"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $property_lookup_view_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->PropertyNo) ?>', 1);"><div id="elh_property_lookup_view_PropertyNo" class="property_lookup_view_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_lookup_view_list->ClientSerNo->headerCellClass() ?>"><div id="elh_property_lookup_view_ClientSerNo" class="property_lookup_view_ClientSerNo"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_lookup_view_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->ClientSerNo) ?>', 1);"><div id="elh_property_lookup_view_ClientSerNo" class="property_lookup_view_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_lookup_view_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_lookup_view_PropertyUse" class="property_lookup_view_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_lookup_view_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->PropertyUse) ?>', 1);"><div id="elh_property_lookup_view_PropertyUse" class="property_lookup_view_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->Location->Visible) { // Location ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_lookup_view_list->Location->headerCellClass() ?>"><div id="elh_property_lookup_view_Location" class="property_lookup_view_Location"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_lookup_view_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->Location) ?>', 1);"><div id="elh_property_lookup_view_Location" class="property_lookup_view_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $property_lookup_view_list->ChargeCode->headerCellClass() ?>"><div id="elh_property_lookup_view_ChargeCode" class="property_lookup_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $property_lookup_view_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->ChargeCode) ?>', 1);"><div id="elh_property_lookup_view_ChargeCode" class="property_lookup_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_lookup_view_list->ChargeGroup->headerCellClass() ?>"><div id="elh_property_lookup_view_ChargeGroup" class="property_lookup_view_ChargeGroup"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $property_lookup_view_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->ChargeGroup) ?>', 1);"><div id="elh_property_lookup_view_ChargeGroup" class="property_lookup_view_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->ChargeGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $property_lookup_view_list->BalanceBF->headerCellClass() ?>"><div id="elh_property_lookup_view_BalanceBF" class="property_lookup_view_BalanceBF"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $property_lookup_view_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->BalanceBF) ?>', 1);"><div id="elh_property_lookup_view_BalanceBF" class="property_lookup_view_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $property_lookup_view_list->CurrentDemand->headerCellClass() ?>"><div id="elh_property_lookup_view_CurrentDemand" class="property_lookup_view_CurrentDemand"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $property_lookup_view_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->CurrentDemand) ?>', 1);"><div id="elh_property_lookup_view_CurrentDemand" class="property_lookup_view_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->VAT->Visible) { // VAT ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $property_lookup_view_list->VAT->headerCellClass() ?>"><div id="elh_property_lookup_view_VAT" class="property_lookup_view_VAT"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $property_lookup_view_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->VAT) ?>', 1);"><div id="elh_property_lookup_view_VAT" class="property_lookup_view_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $property_lookup_view_list->AmountPaid->headerCellClass() ?>"><div id="elh_property_lookup_view_AmountPaid" class="property_lookup_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $property_lookup_view_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->AmountPaid) ?>', 1);"><div id="elh_property_lookup_view_AmountPaid" class="property_lookup_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $property_lookup_view_list->BillPeriod->headerCellClass() ?>"><div id="elh_property_lookup_view_BillPeriod" class="property_lookup_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $property_lookup_view_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->BillPeriod) ?>', 1);"><div id="elh_property_lookup_view_BillPeriod" class="property_lookup_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->PeriodType->Visible) { // PeriodType ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->PeriodType) == "") { ?>
		<th data-name="PeriodType" class="<?php echo $property_lookup_view_list->PeriodType->headerCellClass() ?>"><div id="elh_property_lookup_view_PeriodType" class="property_lookup_view_PeriodType"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->PeriodType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PeriodType" class="<?php echo $property_lookup_view_list->PeriodType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->PeriodType) ?>', 1);"><div id="elh_property_lookup_view_PeriodType" class="property_lookup_view_PeriodType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->PeriodType->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->PeriodType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->PeriodType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->BillYear->Visible) { // BillYear ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $property_lookup_view_list->BillYear->headerCellClass() ?>"><div id="elh_property_lookup_view_BillYear" class="property_lookup_view_BillYear"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $property_lookup_view_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->BillYear) ?>', 1);"><div id="elh_property_lookup_view_BillYear" class="property_lookup_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->StartDate->Visible) { // StartDate ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $property_lookup_view_list->StartDate->headerCellClass() ?>"><div id="elh_property_lookup_view_StartDate" class="property_lookup_view_StartDate"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $property_lookup_view_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->StartDate) ?>', 1);"><div id="elh_property_lookup_view_StartDate" class="property_lookup_view_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->EndDate->Visible) { // EndDate ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $property_lookup_view_list->EndDate->headerCellClass() ?>"><div id="elh_property_lookup_view_EndDate" class="property_lookup_view_EndDate"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $property_lookup_view_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->EndDate) ?>', 1);"><div id="elh_property_lookup_view_EndDate" class="property_lookup_view_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->ChargeDesc) == "") { ?>
		<th data-name="ChargeDesc" class="<?php echo $property_lookup_view_list->ChargeDesc->headerCellClass() ?>"><div id="elh_property_lookup_view_ChargeDesc" class="property_lookup_view_ChargeDesc"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->ChargeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeDesc" class="<?php echo $property_lookup_view_list->ChargeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->ChargeDesc) ?>', 1);"><div id="elh_property_lookup_view_ChargeDesc" class="property_lookup_view_ChargeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->ChargeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->ChargeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->ChargeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->Fee->Visible) { // Fee ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->Fee) == "") { ?>
		<th data-name="Fee" class="<?php echo $property_lookup_view_list->Fee->headerCellClass() ?>"><div id="elh_property_lookup_view_Fee" class="property_lookup_view_Fee"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->Fee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Fee" class="<?php echo $property_lookup_view_list->Fee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->Fee) ?>', 1);"><div id="elh_property_lookup_view_Fee" class="property_lookup_view_Fee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->Fee->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->Fee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->Fee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_lookup_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($property_lookup_view_list->SortUrl($property_lookup_view_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $property_lookup_view_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_property_lookup_view_UnitOfMeasure" class="property_lookup_view_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $property_lookup_view_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $property_lookup_view_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_lookup_view_list->SortUrl($property_lookup_view_list->UnitOfMeasure) ?>', 1);"><div id="elh_property_lookup_view_UnitOfMeasure" class="property_lookup_view_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_lookup_view_list->UnitOfMeasure->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_lookup_view_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_lookup_view_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_lookup_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_lookup_view_list->ExportAll && $property_lookup_view_list->isExport()) {
	$property_lookup_view_list->StopRecord = $property_lookup_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_lookup_view_list->TotalRecords > $property_lookup_view_list->StartRecord + $property_lookup_view_list->DisplayRecords - 1)
		$property_lookup_view_list->StopRecord = $property_lookup_view_list->StartRecord + $property_lookup_view_list->DisplayRecords - 1;
	else
		$property_lookup_view_list->StopRecord = $property_lookup_view_list->TotalRecords;
}
$property_lookup_view_list->RecordCount = $property_lookup_view_list->StartRecord - 1;
if ($property_lookup_view_list->Recordset && !$property_lookup_view_list->Recordset->EOF) {
	$property_lookup_view_list->Recordset->moveFirst();
	$selectLimit = $property_lookup_view_list->UseSelectLimit;
	if (!$selectLimit && $property_lookup_view_list->StartRecord > 1)
		$property_lookup_view_list->Recordset->move($property_lookup_view_list->StartRecord - 1);
} elseif (!$property_lookup_view->AllowAddDeleteRow && $property_lookup_view_list->StopRecord == 0) {
	$property_lookup_view_list->StopRecord = $property_lookup_view->GridAddRowCount;
}

// Initialize aggregate
$property_lookup_view->RowType = ROWTYPE_AGGREGATEINIT;
$property_lookup_view->resetAttributes();
$property_lookup_view_list->renderRow();
while ($property_lookup_view_list->RecordCount < $property_lookup_view_list->StopRecord) {
	$property_lookup_view_list->RecordCount++;
	if ($property_lookup_view_list->RecordCount >= $property_lookup_view_list->StartRecord) {
		$property_lookup_view_list->RowCount++;

		// Set up key count
		$property_lookup_view_list->KeyCount = $property_lookup_view_list->RowIndex;

		// Init row class and style
		$property_lookup_view->resetAttributes();
		$property_lookup_view->CssClass = "";
		if ($property_lookup_view_list->isGridAdd()) {
		} else {
			$property_lookup_view_list->loadRowValues($property_lookup_view_list->Recordset); // Load row values
		}
		$property_lookup_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_lookup_view->RowAttrs->merge(["data-rowindex" => $property_lookup_view_list->RowCount, "id" => "r" . $property_lookup_view_list->RowCount . "_property_lookup_view", "data-rowtype" => $property_lookup_view->RowType]);

		// Render row
		$property_lookup_view_list->renderRow();

		// Render list options
		$property_lookup_view_list->renderListOptions();
?>
	<tr <?php echo $property_lookup_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_lookup_view_list->ListOptions->render("body", "left", $property_lookup_view_list->RowCount);
?>
	<?php if ($property_lookup_view_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_lookup_view_list->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_ValuationNo">
<span<?php echo $property_lookup_view_list->ValuationNo->viewAttributes() ?>><?php echo $property_lookup_view_list->ValuationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $property_lookup_view_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_PropertyNo">
<span<?php echo $property_lookup_view_list->PropertyNo->viewAttributes() ?>><?php echo $property_lookup_view_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $property_lookup_view_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_ClientSerNo">
<span<?php echo $property_lookup_view_list->ClientSerNo->viewAttributes() ?>><?php echo $property_lookup_view_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_lookup_view_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_PropertyUse">
<span<?php echo $property_lookup_view_list->PropertyUse->viewAttributes() ?>><?php echo $property_lookup_view_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_lookup_view_list->Location->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_Location">
<span<?php echo $property_lookup_view_list->Location->viewAttributes() ?>><?php echo $property_lookup_view_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $property_lookup_view_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_ChargeCode">
<span<?php echo $property_lookup_view_list->ChargeCode->viewAttributes() ?>><?php echo $property_lookup_view_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $property_lookup_view_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_ChargeGroup">
<span<?php echo $property_lookup_view_list->ChargeGroup->viewAttributes() ?>><?php echo $property_lookup_view_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $property_lookup_view_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_BalanceBF">
<span<?php echo $property_lookup_view_list->BalanceBF->viewAttributes() ?>><?php echo $property_lookup_view_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $property_lookup_view_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_CurrentDemand">
<span<?php echo $property_lookup_view_list->CurrentDemand->viewAttributes() ?>><?php echo $property_lookup_view_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $property_lookup_view_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_VAT">
<span<?php echo $property_lookup_view_list->VAT->viewAttributes() ?>><?php echo $property_lookup_view_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $property_lookup_view_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_AmountPaid">
<span<?php echo $property_lookup_view_list->AmountPaid->viewAttributes() ?>><?php echo $property_lookup_view_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $property_lookup_view_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_BillPeriod">
<span<?php echo $property_lookup_view_list->BillPeriod->viewAttributes() ?>><?php echo $property_lookup_view_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->PeriodType->Visible) { // PeriodType ?>
		<td data-name="PeriodType" <?php echo $property_lookup_view_list->PeriodType->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_PeriodType">
<span<?php echo $property_lookup_view_list->PeriodType->viewAttributes() ?>><?php echo $property_lookup_view_list->PeriodType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $property_lookup_view_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_BillYear">
<span<?php echo $property_lookup_view_list->BillYear->viewAttributes() ?>><?php echo $property_lookup_view_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $property_lookup_view_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_StartDate">
<span<?php echo $property_lookup_view_list->StartDate->viewAttributes() ?>><?php echo $property_lookup_view_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $property_lookup_view_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_EndDate">
<span<?php echo $property_lookup_view_list->EndDate->viewAttributes() ?>><?php echo $property_lookup_view_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->ChargeDesc->Visible) { // ChargeDesc ?>
		<td data-name="ChargeDesc" <?php echo $property_lookup_view_list->ChargeDesc->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_ChargeDesc">
<span<?php echo $property_lookup_view_list->ChargeDesc->viewAttributes() ?>><?php echo $property_lookup_view_list->ChargeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->Fee->Visible) { // Fee ?>
		<td data-name="Fee" <?php echo $property_lookup_view_list->Fee->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_Fee">
<span<?php echo $property_lookup_view_list->Fee->viewAttributes() ?>><?php echo $property_lookup_view_list->Fee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_lookup_view_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $property_lookup_view_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $property_lookup_view_list->RowCount ?>_property_lookup_view_UnitOfMeasure">
<span<?php echo $property_lookup_view_list->UnitOfMeasure->viewAttributes() ?>><?php echo $property_lookup_view_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_lookup_view_list->ListOptions->render("body", "right", $property_lookup_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_lookup_view_list->isGridAdd())
		$property_lookup_view_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_lookup_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_lookup_view_list->Recordset)
	$property_lookup_view_list->Recordset->Close();
?>
<?php if (!$property_lookup_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_lookup_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_lookup_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_lookup_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_lookup_view_list->TotalRecords == 0 && !$property_lookup_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_lookup_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_lookup_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_lookup_view_list->isExport()) { ?>
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
$property_lookup_view_list->terminate();
?>