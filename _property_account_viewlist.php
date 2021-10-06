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
$_property_account_view_list = new _property_account_view_list();

// Run the page
$_property_account_view_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$_property_account_view_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$_property_account_view_list->isExport()) { ?>
<script>
var f_property_account_viewlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	f_property_account_viewlist = currentForm = new ew.Form("f_property_account_viewlist", "list");
	f_property_account_viewlist.formKeyCountName = '<?php echo $_property_account_view_list->FormKeyCountName ?>';
	loadjs.done("f_property_account_viewlist");
});
var f_property_account_viewlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	f_property_account_viewlistsrch = currentSearchForm = new ew.Form("f_property_account_viewlistsrch");

	// Dynamic selection lists
	// Filters

	f_property_account_viewlistsrch.filterList = <?php echo $_property_account_view_list->getFilterList() ?>;

	// Init search panel as collapsed
	f_property_account_viewlistsrch.initSearchPanel = true;
	loadjs.done("f_property_account_viewlistsrch");
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
<?php if (!$_property_account_view_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($_property_account_view_list->TotalRecords > 0 && $_property_account_view_list->ExportOptions->visible()) { ?>
<?php $_property_account_view_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($_property_account_view_list->ImportOptions->visible()) { ?>
<?php $_property_account_view_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($_property_account_view_list->SearchOptions->visible()) { ?>
<?php $_property_account_view_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($_property_account_view_list->FilterOptions->visible()) { ?>
<?php $_property_account_view_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$_property_account_view_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$_property_account_view_list->isExport() && !$_property_account_view->CurrentAction) { ?>
<form name="f_property_account_viewlistsrch" id="f_property_account_viewlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="f_property_account_viewlistsrch-search-panel" class="<?php echo $_property_account_view_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="_property_account_view">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $_property_account_view_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($_property_account_view_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($_property_account_view_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $_property_account_view_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($_property_account_view_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($_property_account_view_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($_property_account_view_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($_property_account_view_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $_property_account_view_list->showPageHeader(); ?>
<?php
$_property_account_view_list->showMessage();
?>
<?php if ($_property_account_view_list->TotalRecords > 0 || $_property_account_view->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($_property_account_view_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> _property_account_view">
<?php if (!$_property_account_view_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$_property_account_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_property_account_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_property_account_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="f_property_account_viewlist" id="f_property_account_viewlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="_property_account_view">
<div id="gmp__property_account_view" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($_property_account_view_list->TotalRecords > 0 || $_property_account_view_list->isGridEdit()) { ?>
<table id="tbl__property_account_viewlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$_property_account_view->RowType = ROWTYPE_HEADER;

// Render list options
$_property_account_view_list->renderListOptions();

// Render list options (header, left)
$_property_account_view_list->ListOptions->render("header", "left");
?>
<?php if ($_property_account_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $_property_account_view_list->ClientSerNo->headerCellClass() ?>"><div id="elh__property_account_view_ClientSerNo" class="_property_account_view_ClientSerNo"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $_property_account_view_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->ClientSerNo) ?>', 1);"><div id="elh__property_account_view_ClientSerNo" class="_property_account_view_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->ClientName->Visible) { // ClientName ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->ClientName) == "") { ?>
		<th data-name="ClientName" class="<?php echo $_property_account_view_list->ClientName->headerCellClass() ?>"><div id="elh__property_account_view_ClientName" class="_property_account_view_ClientName"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->ClientName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientName" class="<?php echo $_property_account_view_list->ClientName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->ClientName) ?>', 1);"><div id="elh__property_account_view_ClientName" class="_property_account_view_ClientName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->ClientName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->ClientName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->ClientName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->PostalAddress->Visible) { // PostalAddress ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->PostalAddress) == "") { ?>
		<th data-name="PostalAddress" class="<?php echo $_property_account_view_list->PostalAddress->headerCellClass() ?>"><div id="elh__property_account_view_PostalAddress" class="_property_account_view_PostalAddress"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->PostalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PostalAddress" class="<?php echo $_property_account_view_list->PostalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->PostalAddress) ?>', 1);"><div id="elh__property_account_view_PostalAddress" class="_property_account_view_PostalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->PostalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->PostalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->PostalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->PhysicalAddress) == "") { ?>
		<th data-name="PhysicalAddress" class="<?php echo $_property_account_view_list->PhysicalAddress->headerCellClass() ?>"><div id="elh__property_account_view_PhysicalAddress" class="_property_account_view_PhysicalAddress"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->PhysicalAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PhysicalAddress" class="<?php echo $_property_account_view_list->PhysicalAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->PhysicalAddress) ?>', 1);"><div id="elh__property_account_view_PhysicalAddress" class="_property_account_view_PhysicalAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->PhysicalAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->PhysicalAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->PhysicalAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->Mobile->Visible) { // Mobile ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->Mobile) == "") { ?>
		<th data-name="Mobile" class="<?php echo $_property_account_view_list->Mobile->headerCellClass() ?>"><div id="elh__property_account_view_Mobile" class="_property_account_view_Mobile"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->Mobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Mobile" class="<?php echo $_property_account_view_list->Mobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->Mobile) ?>', 1);"><div id="elh__property_account_view_Mobile" class="_property_account_view_Mobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->Mobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->Mobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->Mobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $_property_account_view_list->ValuationNo->headerCellClass() ?>"><div id="elh__property_account_view_ValuationNo" class="_property_account_view_ValuationNo"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $_property_account_view_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->ValuationNo) ?>', 1);"><div id="elh__property_account_view_ValuationNo" class="_property_account_view_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $_property_account_view_list->PropertyNo->headerCellClass() ?>"><div id="elh__property_account_view_PropertyNo" class="_property_account_view_PropertyNo"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $_property_account_view_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->PropertyNo) ?>', 1);"><div id="elh__property_account_view_PropertyNo" class="_property_account_view_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->Location->Visible) { // Location ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $_property_account_view_list->Location->headerCellClass() ?>"><div id="elh__property_account_view_Location" class="_property_account_view_Location"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $_property_account_view_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->Location) ?>', 1);"><div id="elh__property_account_view_Location" class="_property_account_view_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->LandValue->Visible) { // LandValue ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->LandValue) == "") { ?>
		<th data-name="LandValue" class="<?php echo $_property_account_view_list->LandValue->headerCellClass() ?>"><div id="elh__property_account_view_LandValue" class="_property_account_view_LandValue"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->LandValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandValue" class="<?php echo $_property_account_view_list->LandValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->LandValue) ?>', 1);"><div id="elh__property_account_view_LandValue" class="_property_account_view_LandValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->LandValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->LandValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->ImprovementsValue) == "") { ?>
		<th data-name="ImprovementsValue" class="<?php echo $_property_account_view_list->ImprovementsValue->headerCellClass() ?>"><div id="elh__property_account_view_ImprovementsValue" class="_property_account_view_ImprovementsValue"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->ImprovementsValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ImprovementsValue" class="<?php echo $_property_account_view_list->ImprovementsValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->ImprovementsValue) ?>', 1);"><div id="elh__property_account_view_ImprovementsValue" class="_property_account_view_ImprovementsValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->ImprovementsValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->ImprovementsValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $_property_account_view_list->RateableValue->headerCellClass() ?>"><div id="elh__property_account_view_RateableValue" class="_property_account_view_RateableValue"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $_property_account_view_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->RateableValue) ?>', 1);"><div id="elh__property_account_view_RateableValue" class="_property_account_view_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->SupplementaryValue) == "") { ?>
		<th data-name="SupplementaryValue" class="<?php echo $_property_account_view_list->SupplementaryValue->headerCellClass() ?>"><div id="elh__property_account_view_SupplementaryValue" class="_property_account_view_SupplementaryValue"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->SupplementaryValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplementaryValue" class="<?php echo $_property_account_view_list->SupplementaryValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->SupplementaryValue) ?>', 1);"><div id="elh__property_account_view_SupplementaryValue" class="_property_account_view_SupplementaryValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->SupplementaryValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->SupplementaryValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->SupplementaryValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->Improvements->Visible) { // Improvements ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->Improvements) == "") { ?>
		<th data-name="Improvements" class="<?php echo $_property_account_view_list->Improvements->headerCellClass() ?>"><div id="elh__property_account_view_Improvements" class="_property_account_view_Improvements"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->Improvements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Improvements" class="<?php echo $_property_account_view_list->Improvements->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->Improvements) ?>', 1);"><div id="elh__property_account_view_Improvements" class="_property_account_view_Improvements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->Improvements->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->Improvements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->Improvements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->LandExtentInHA) == "") { ?>
		<th data-name="LandExtentInHA" class="<?php echo $_property_account_view_list->LandExtentInHA->headerCellClass() ?>"><div id="elh__property_account_view_LandExtentInHA" class="_property_account_view_LandExtentInHA"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->LandExtentInHA->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandExtentInHA" class="<?php echo $_property_account_view_list->LandExtentInHA->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->LandExtentInHA) ?>', 1);"><div id="elh__property_account_view_LandExtentInHA" class="_property_account_view_LandExtentInHA">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->LandExtentInHA->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->LandExtentInHA->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->LandExtentInHA->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->BalanceBF->Visible) { // BalanceBF ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->BalanceBF) == "") { ?>
		<th data-name="BalanceBF" class="<?php echo $_property_account_view_list->BalanceBF->headerCellClass() ?>"><div id="elh__property_account_view_BalanceBF" class="_property_account_view_BalanceBF"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->BalanceBF->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BalanceBF" class="<?php echo $_property_account_view_list->BalanceBF->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->BalanceBF) ?>', 1);"><div id="elh__property_account_view_BalanceBF" class="_property_account_view_BalanceBF">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->BalanceBF->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->BalanceBF->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->BalanceBF->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->CurrentDemand) == "") { ?>
		<th data-name="CurrentDemand" class="<?php echo $_property_account_view_list->CurrentDemand->headerCellClass() ?>"><div id="elh__property_account_view_CurrentDemand" class="_property_account_view_CurrentDemand"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->CurrentDemand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CurrentDemand" class="<?php echo $_property_account_view_list->CurrentDemand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->CurrentDemand) ?>', 1);"><div id="elh__property_account_view_CurrentDemand" class="_property_account_view_CurrentDemand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->CurrentDemand->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->CurrentDemand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->CurrentDemand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->VAT->Visible) { // VAT ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->VAT) == "") { ?>
		<th data-name="VAT" class="<?php echo $_property_account_view_list->VAT->headerCellClass() ?>"><div id="elh__property_account_view_VAT" class="_property_account_view_VAT"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->VAT->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="VAT" class="<?php echo $_property_account_view_list->VAT->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->VAT) ?>', 1);"><div id="elh__property_account_view_VAT" class="_property_account_view_VAT">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->VAT->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->VAT->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->VAT->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->AmountPaid->Visible) { // AmountPaid ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->AmountPaid) == "") { ?>
		<th data-name="AmountPaid" class="<?php echo $_property_account_view_list->AmountPaid->headerCellClass() ?>"><div id="elh__property_account_view_AmountPaid" class="_property_account_view_AmountPaid"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->AmountPaid->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountPaid" class="<?php echo $_property_account_view_list->AmountPaid->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->AmountPaid) ?>', 1);"><div id="elh__property_account_view_AmountPaid" class="_property_account_view_AmountPaid">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->AmountPaid->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->AmountPaid->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->AmountPaid->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->BillPeriod->Visible) { // BillPeriod ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->BillPeriod) == "") { ?>
		<th data-name="BillPeriod" class="<?php echo $_property_account_view_list->BillPeriod->headerCellClass() ?>"><div id="elh__property_account_view_BillPeriod" class="_property_account_view_BillPeriod"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->BillPeriod->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillPeriod" class="<?php echo $_property_account_view_list->BillPeriod->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->BillPeriod) ?>', 1);"><div id="elh__property_account_view_BillPeriod" class="_property_account_view_BillPeriod">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->BillPeriod->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->BillPeriod->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->BillPeriod->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->BillYear->Visible) { // BillYear ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->BillYear) == "") { ?>
		<th data-name="BillYear" class="<?php echo $_property_account_view_list->BillYear->headerCellClass() ?>"><div id="elh__property_account_view_BillYear" class="_property_account_view_BillYear"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->BillYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillYear" class="<?php echo $_property_account_view_list->BillYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->BillYear) ?>', 1);"><div id="elh__property_account_view_BillYear" class="_property_account_view_BillYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->BillYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->BillYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->BillYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->AmountDue->Visible) { // AmountDue ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->AmountDue) == "") { ?>
		<th data-name="AmountDue" class="<?php echo $_property_account_view_list->AmountDue->headerCellClass() ?>"><div id="elh__property_account_view_AmountDue" class="_property_account_view_AmountDue"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->AmountDue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AmountDue" class="<?php echo $_property_account_view_list->AmountDue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->AmountDue) ?>', 1);"><div id="elh__property_account_view_AmountDue" class="_property_account_view_AmountDue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->AmountDue->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->AmountDue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->AmountDue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($_property_account_view_list->ChargeCode->Visible) { // ChargeCode ?>
	<?php if ($_property_account_view_list->SortUrl($_property_account_view_list->ChargeCode) == "") { ?>
		<th data-name="ChargeCode" class="<?php echo $_property_account_view_list->ChargeCode->headerCellClass() ?>"><div id="elh__property_account_view_ChargeCode" class="_property_account_view_ChargeCode"><div class="ew-table-header-caption"><?php echo $_property_account_view_list->ChargeCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeCode" class="<?php echo $_property_account_view_list->ChargeCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $_property_account_view_list->SortUrl($_property_account_view_list->ChargeCode) ?>', 1);"><div id="elh__property_account_view_ChargeCode" class="_property_account_view_ChargeCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $_property_account_view_list->ChargeCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($_property_account_view_list->ChargeCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($_property_account_view_list->ChargeCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$_property_account_view_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($_property_account_view_list->ExportAll && $_property_account_view_list->isExport()) {
	$_property_account_view_list->StopRecord = $_property_account_view_list->TotalRecords;
} else {

	// Set the last record to display
	if ($_property_account_view_list->TotalRecords > $_property_account_view_list->StartRecord + $_property_account_view_list->DisplayRecords - 1)
		$_property_account_view_list->StopRecord = $_property_account_view_list->StartRecord + $_property_account_view_list->DisplayRecords - 1;
	else
		$_property_account_view_list->StopRecord = $_property_account_view_list->TotalRecords;
}
$_property_account_view_list->RecordCount = $_property_account_view_list->StartRecord - 1;
if ($_property_account_view_list->Recordset && !$_property_account_view_list->Recordset->EOF) {
	$_property_account_view_list->Recordset->moveFirst();
	$selectLimit = $_property_account_view_list->UseSelectLimit;
	if (!$selectLimit && $_property_account_view_list->StartRecord > 1)
		$_property_account_view_list->Recordset->move($_property_account_view_list->StartRecord - 1);
} elseif (!$_property_account_view->AllowAddDeleteRow && $_property_account_view_list->StopRecord == 0) {
	$_property_account_view_list->StopRecord = $_property_account_view->GridAddRowCount;
}

// Initialize aggregate
$_property_account_view->RowType = ROWTYPE_AGGREGATEINIT;
$_property_account_view->resetAttributes();
$_property_account_view_list->renderRow();
while ($_property_account_view_list->RecordCount < $_property_account_view_list->StopRecord) {
	$_property_account_view_list->RecordCount++;
	if ($_property_account_view_list->RecordCount >= $_property_account_view_list->StartRecord) {
		$_property_account_view_list->RowCount++;

		// Set up key count
		$_property_account_view_list->KeyCount = $_property_account_view_list->RowIndex;

		// Init row class and style
		$_property_account_view->resetAttributes();
		$_property_account_view->CssClass = "";
		if ($_property_account_view_list->isGridAdd()) {
		} else {
			$_property_account_view_list->loadRowValues($_property_account_view_list->Recordset); // Load row values
		}
		$_property_account_view->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$_property_account_view->RowAttrs->merge(["data-rowindex" => $_property_account_view_list->RowCount, "id" => "r" . $_property_account_view_list->RowCount . "__property_account_view", "data-rowtype" => $_property_account_view->RowType]);

		// Render row
		$_property_account_view_list->renderRow();

		// Render list options
		$_property_account_view_list->renderListOptions();
?>
	<tr <?php echo $_property_account_view->rowAttributes() ?>>
<?php

// Render list options (body, left)
$_property_account_view_list->ListOptions->render("body", "left", $_property_account_view_list->RowCount);
?>
	<?php if ($_property_account_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $_property_account_view_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_ClientSerNo">
<span<?php echo $_property_account_view_list->ClientSerNo->viewAttributes() ?>><?php echo $_property_account_view_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->ClientName->Visible) { // ClientName ?>
		<td data-name="ClientName" <?php echo $_property_account_view_list->ClientName->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_ClientName">
<span<?php echo $_property_account_view_list->ClientName->viewAttributes() ?>><?php echo $_property_account_view_list->ClientName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress" <?php echo $_property_account_view_list->PostalAddress->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_PostalAddress">
<span<?php echo $_property_account_view_list->PostalAddress->viewAttributes() ?>><?php echo $_property_account_view_list->PostalAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress" <?php echo $_property_account_view_list->PhysicalAddress->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_PhysicalAddress">
<span<?php echo $_property_account_view_list->PhysicalAddress->viewAttributes() ?>><?php echo $_property_account_view_list->PhysicalAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" <?php echo $_property_account_view_list->Mobile->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_Mobile">
<span<?php echo $_property_account_view_list->Mobile->viewAttributes() ?>><?php echo $_property_account_view_list->Mobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $_property_account_view_list->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_ValuationNo">
<span<?php echo $_property_account_view_list->ValuationNo->viewAttributes() ?>><?php echo $_property_account_view_list->ValuationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $_property_account_view_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_PropertyNo">
<span<?php echo $_property_account_view_list->PropertyNo->viewAttributes() ?>><?php echo $_property_account_view_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $_property_account_view_list->Location->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_Location">
<span<?php echo $_property_account_view_list->Location->viewAttributes() ?>><?php echo $_property_account_view_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" <?php echo $_property_account_view_list->LandValue->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_LandValue">
<span<?php echo $_property_account_view_list->LandValue->viewAttributes() ?>><?php echo $_property_account_view_list->LandValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" <?php echo $_property_account_view_list->ImprovementsValue->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_ImprovementsValue">
<span<?php echo $_property_account_view_list->ImprovementsValue->viewAttributes() ?>><?php echo $_property_account_view_list->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $_property_account_view_list->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_RateableValue">
<span<?php echo $_property_account_view_list->RateableValue->viewAttributes() ?>><?php echo $_property_account_view_list->RateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td data-name="SupplementaryValue" <?php echo $_property_account_view_list->SupplementaryValue->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_SupplementaryValue">
<span<?php echo $_property_account_view_list->SupplementaryValue->viewAttributes() ?>><?php echo $_property_account_view_list->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements" <?php echo $_property_account_view_list->Improvements->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_Improvements">
<span<?php echo $_property_account_view_list->Improvements->viewAttributes() ?>><?php echo $_property_account_view_list->Improvements->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA" <?php echo $_property_account_view_list->LandExtentInHA->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_LandExtentInHA">
<span<?php echo $_property_account_view_list->LandExtentInHA->viewAttributes() ?>><?php echo $_property_account_view_list->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" <?php echo $_property_account_view_list->BalanceBF->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_BalanceBF">
<span<?php echo $_property_account_view_list->BalanceBF->viewAttributes() ?>><?php echo $_property_account_view_list->BalanceBF->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" <?php echo $_property_account_view_list->CurrentDemand->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_CurrentDemand">
<span<?php echo $_property_account_view_list->CurrentDemand->viewAttributes() ?>><?php echo $_property_account_view_list->CurrentDemand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" <?php echo $_property_account_view_list->VAT->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_VAT">
<span<?php echo $_property_account_view_list->VAT->viewAttributes() ?>><?php echo $_property_account_view_list->VAT->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" <?php echo $_property_account_view_list->AmountPaid->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_AmountPaid">
<span<?php echo $_property_account_view_list->AmountPaid->viewAttributes() ?>><?php echo $_property_account_view_list->AmountPaid->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" <?php echo $_property_account_view_list->BillPeriod->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_BillPeriod">
<span<?php echo $_property_account_view_list->BillPeriod->viewAttributes() ?>><?php echo $_property_account_view_list->BillPeriod->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" <?php echo $_property_account_view_list->BillYear->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_BillYear">
<span<?php echo $_property_account_view_list->BillYear->viewAttributes() ?>><?php echo $_property_account_view_list->BillYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" <?php echo $_property_account_view_list->AmountDue->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_AmountDue">
<span<?php echo $_property_account_view_list->AmountDue->viewAttributes() ?>><?php echo $_property_account_view_list->AmountDue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($_property_account_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" <?php echo $_property_account_view_list->ChargeCode->cellAttributes() ?>>
<span id="el<?php echo $_property_account_view_list->RowCount ?>__property_account_view_ChargeCode">
<span<?php echo $_property_account_view_list->ChargeCode->viewAttributes() ?>><?php echo $_property_account_view_list->ChargeCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$_property_account_view_list->ListOptions->render("body", "right", $_property_account_view_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$_property_account_view_list->isGridAdd())
		$_property_account_view_list->Recordset->moveNext();
}
?>
</tbody>
<?php

// Render aggregate row
$_property_account_view->RowType = ROWTYPE_AGGREGATE;
$_property_account_view->resetAttributes();
$_property_account_view_list->renderRow();
?>
<?php if ($_property_account_view_list->TotalRecords > 0 && !$_property_account_view_list->isGridAdd() && !$_property_account_view_list->isGridEdit()) { ?>
<tfoot><!-- Table footer -->
	<tr class="ew-table-footer">
<?php

// Render list options
$_property_account_view_list->renderListOptions();

// Render list options (footer, left)
$_property_account_view_list->ListOptions->render("footer", "left");
?>
	<?php if ($_property_account_view_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" class="<?php echo $_property_account_view_list->ClientSerNo->footerCellClass() ?>"><span id="elf__property_account_view_ClientSerNo" class="_property_account_view_ClientSerNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->ClientName->Visible) { // ClientName ?>
		<td data-name="ClientName" class="<?php echo $_property_account_view_list->ClientName->footerCellClass() ?>"><span id="elf__property_account_view_ClientName" class="_property_account_view_ClientName">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->PostalAddress->Visible) { // PostalAddress ?>
		<td data-name="PostalAddress" class="<?php echo $_property_account_view_list->PostalAddress->footerCellClass() ?>"><span id="elf__property_account_view_PostalAddress" class="_property_account_view_PostalAddress">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->PhysicalAddress->Visible) { // PhysicalAddress ?>
		<td data-name="PhysicalAddress" class="<?php echo $_property_account_view_list->PhysicalAddress->footerCellClass() ?>"><span id="elf__property_account_view_PhysicalAddress" class="_property_account_view_PhysicalAddress">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->Mobile->Visible) { // Mobile ?>
		<td data-name="Mobile" class="<?php echo $_property_account_view_list->Mobile->footerCellClass() ?>"><span id="elf__property_account_view_Mobile" class="_property_account_view_Mobile">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" class="<?php echo $_property_account_view_list->ValuationNo->footerCellClass() ?>"><span id="elf__property_account_view_ValuationNo" class="_property_account_view_ValuationNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" class="<?php echo $_property_account_view_list->PropertyNo->footerCellClass() ?>"><span id="elf__property_account_view_PropertyNo" class="_property_account_view_PropertyNo">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->Location->Visible) { // Location ?>
		<td data-name="Location" class="<?php echo $_property_account_view_list->Location->footerCellClass() ?>"><span id="elf__property_account_view_Location" class="_property_account_view_Location">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" class="<?php echo $_property_account_view_list->LandValue->footerCellClass() ?>"><span id="elf__property_account_view_LandValue" class="_property_account_view_LandValue">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" class="<?php echo $_property_account_view_list->ImprovementsValue->footerCellClass() ?>"><span id="elf__property_account_view_ImprovementsValue" class="_property_account_view_ImprovementsValue">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" class="<?php echo $_property_account_view_list->RateableValue->footerCellClass() ?>"><span id="elf__property_account_view_RateableValue" class="_property_account_view_RateableValue">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td data-name="SupplementaryValue" class="<?php echo $_property_account_view_list->SupplementaryValue->footerCellClass() ?>"><span id="elf__property_account_view_SupplementaryValue" class="_property_account_view_SupplementaryValue">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements" class="<?php echo $_property_account_view_list->Improvements->footerCellClass() ?>"><span id="elf__property_account_view_Improvements" class="_property_account_view_Improvements">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA" class="<?php echo $_property_account_view_list->LandExtentInHA->footerCellClass() ?>"><span id="elf__property_account_view_LandExtentInHA" class="_property_account_view_LandExtentInHA">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->BalanceBF->Visible) { // BalanceBF ?>
		<td data-name="BalanceBF" class="<?php echo $_property_account_view_list->BalanceBF->footerCellClass() ?>"><span id="elf__property_account_view_BalanceBF" class="_property_account_view_BalanceBF">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $_property_account_view_list->BalanceBF->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->CurrentDemand->Visible) { // CurrentDemand ?>
		<td data-name="CurrentDemand" class="<?php echo $_property_account_view_list->CurrentDemand->footerCellClass() ?>"><span id="elf__property_account_view_CurrentDemand" class="_property_account_view_CurrentDemand">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $_property_account_view_list->CurrentDemand->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->VAT->Visible) { // VAT ?>
		<td data-name="VAT" class="<?php echo $_property_account_view_list->VAT->footerCellClass() ?>"><span id="elf__property_account_view_VAT" class="_property_account_view_VAT">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $_property_account_view_list->VAT->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->AmountPaid->Visible) { // AmountPaid ?>
		<td data-name="AmountPaid" class="<?php echo $_property_account_view_list->AmountPaid->footerCellClass() ?>"><span id="elf__property_account_view_AmountPaid" class="_property_account_view_AmountPaid">
		<span class="ew-aggregate"><?php echo $Language->phrase("TOTAL") ?></span><span class="ew-aggregate-value">
		<?php echo $_property_account_view_list->AmountPaid->ViewValue ?></span>
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->BillPeriod->Visible) { // BillPeriod ?>
		<td data-name="BillPeriod" class="<?php echo $_property_account_view_list->BillPeriod->footerCellClass() ?>"><span id="elf__property_account_view_BillPeriod" class="_property_account_view_BillPeriod">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->BillYear->Visible) { // BillYear ?>
		<td data-name="BillYear" class="<?php echo $_property_account_view_list->BillYear->footerCellClass() ?>"><span id="elf__property_account_view_BillYear" class="_property_account_view_BillYear">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->AmountDue->Visible) { // AmountDue ?>
		<td data-name="AmountDue" class="<?php echo $_property_account_view_list->AmountDue->footerCellClass() ?>"><span id="elf__property_account_view_AmountDue" class="_property_account_view_AmountDue">
		&nbsp;
		</span></td>
	<?php } ?>
	<?php if ($_property_account_view_list->ChargeCode->Visible) { // ChargeCode ?>
		<td data-name="ChargeCode" class="<?php echo $_property_account_view_list->ChargeCode->footerCellClass() ?>"><span id="elf__property_account_view_ChargeCode" class="_property_account_view_ChargeCode">
		&nbsp;
		</span></td>
	<?php } ?>
<?php

// Render list options (footer, right)
$_property_account_view_list->ListOptions->render("footer", "right");
?>
	</tr>
</tfoot>
<?php } ?>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$_property_account_view->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($_property_account_view_list->Recordset)
	$_property_account_view_list->Recordset->Close();
?>
<?php if (!$_property_account_view_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$_property_account_view_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $_property_account_view_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $_property_account_view_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($_property_account_view_list->TotalRecords == 0 && !$_property_account_view->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $_property_account_view_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$_property_account_view_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$_property_account_view_list->isExport()) { ?>
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
$_property_account_view_list->terminate();
?>