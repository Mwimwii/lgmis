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
$business_list = new business_list();

// Run the page
$business_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$business_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$business_list->isExport()) { ?>
<script>
var fbusinesslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbusinesslist = currentForm = new ew.Form("fbusinesslist", "list");
	fbusinesslist.formKeyCountName = '<?php echo $business_list->FormKeyCountName ?>';
	loadjs.done("fbusinesslist");
});
var fbusinesslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbusinesslistsrch = currentSearchForm = new ew.Form("fbusinesslistsrch");

	// Dynamic selection lists
	// Filters

	fbusinesslistsrch.filterList = <?php echo $business_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbusinesslistsrch.initSearchPanel = true;
	loadjs.done("fbusinesslistsrch");
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
<?php if (!$business_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($business_list->TotalRecords > 0 && $business_list->ExportOptions->visible()) { ?>
<?php $business_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($business_list->ImportOptions->visible()) { ?>
<?php $business_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($business_list->SearchOptions->visible()) { ?>
<?php $business_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($business_list->FilterOptions->visible()) { ?>
<?php $business_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$business_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$business_list->isExport() && !$business->CurrentAction) { ?>
<form name="fbusinesslistsrch" id="fbusinesslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbusinesslistsrch-search-panel" class="<?php echo $business_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="business">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $business_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($business_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($business_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $business_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($business_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $business_list->showPageHeader(); ?>
<?php
$business_list->showMessage();
?>
<?php if ($business_list->TotalRecords > 0 || $business->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($business_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> business">
<?php if (!$business_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$business_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbusinesslist" id="fbusinesslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="business">
<div id="gmp_business" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($business_list->TotalRecords > 0 || $business_list->isGridEdit()) { ?>
<table id="tbl_businesslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$business->RowType = ROWTYPE_HEADER;

// Render list options
$business_list->renderListOptions();

// Render list options (header, left)
$business_list->ListOptions->render("header", "left");
?>
<?php if ($business_list->BusinessID->Visible) { // BusinessID ?>
	<?php if ($business_list->SortUrl($business_list->BusinessID) == "") { ?>
		<th data-name="BusinessID" class="<?php echo $business_list->BusinessID->headerCellClass() ?>"><div id="elh_business_BusinessID" class="business_BusinessID"><div class="ew-table-header-caption"><?php echo $business_list->BusinessID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessID" class="<?php echo $business_list->BusinessID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->BusinessID) ?>', 1);"><div id="elh_business_BusinessID" class="business_BusinessID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->BusinessID->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->BusinessID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->BusinessID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->PACRANo->Visible) { // PACRANo ?>
	<?php if ($business_list->SortUrl($business_list->PACRANo) == "") { ?>
		<th data-name="PACRANo" class="<?php echo $business_list->PACRANo->headerCellClass() ?>"><div id="elh_business_PACRANo" class="business_PACRANo"><div class="ew-table-header-caption"><?php echo $business_list->PACRANo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PACRANo" class="<?php echo $business_list->PACRANo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->PACRANo) ?>', 1);"><div id="elh_business_PACRANo" class="business_PACRANo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->PACRANo->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->PACRANo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->PACRANo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->TPIN->Visible) { // TPIN ?>
	<?php if ($business_list->SortUrl($business_list->TPIN) == "") { ?>
		<th data-name="TPIN" class="<?php echo $business_list->TPIN->headerCellClass() ?>"><div id="elh_business_TPIN" class="business_TPIN"><div class="ew-table-header-caption"><?php echo $business_list->TPIN->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TPIN" class="<?php echo $business_list->TPIN->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->TPIN) ?>', 1);"><div id="elh_business_TPIN" class="business_TPIN">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->TPIN->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->TPIN->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->TPIN->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->BusinessName->Visible) { // BusinessName ?>
	<?php if ($business_list->SortUrl($business_list->BusinessName) == "") { ?>
		<th data-name="BusinessName" class="<?php echo $business_list->BusinessName->headerCellClass() ?>"><div id="elh_business_BusinessName" class="business_BusinessName"><div class="ew-table-header-caption"><?php echo $business_list->BusinessName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessName" class="<?php echo $business_list->BusinessName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->BusinessName) ?>', 1);"><div id="elh_business_BusinessName" class="business_BusinessName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->BusinessName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->BusinessName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->BusinessName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->ClientID->Visible) { // ClientID ?>
	<?php if ($business_list->SortUrl($business_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $business_list->ClientID->headerCellClass() ?>"><div id="elh_business_ClientID" class="business_ClientID"><div class="ew-table-header-caption"><?php echo $business_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $business_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->ClientID) ?>', 1);"><div id="elh_business_ClientID" class="business_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->BusinessSector->Visible) { // BusinessSector ?>
	<?php if ($business_list->SortUrl($business_list->BusinessSector) == "") { ?>
		<th data-name="BusinessSector" class="<?php echo $business_list->BusinessSector->headerCellClass() ?>"><div id="elh_business_BusinessSector" class="business_BusinessSector"><div class="ew-table-header-caption"><?php echo $business_list->BusinessSector->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessSector" class="<?php echo $business_list->BusinessSector->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->BusinessSector) ?>', 1);"><div id="elh_business_BusinessSector" class="business_BusinessSector">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->BusinessSector->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->BusinessSector->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->BusinessSector->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->BusinessType->Visible) { // BusinessType ?>
	<?php if ($business_list->SortUrl($business_list->BusinessType) == "") { ?>
		<th data-name="BusinessType" class="<?php echo $business_list->BusinessType->headerCellClass() ?>"><div id="elh_business_BusinessType" class="business_BusinessType"><div class="ew-table-header-caption"><?php echo $business_list->BusinessType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessType" class="<?php echo $business_list->BusinessType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->BusinessType) ?>', 1);"><div id="elh_business_BusinessType" class="business_BusinessType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->BusinessType->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->BusinessType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->BusinessType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->Location->Visible) { // Location ?>
	<?php if ($business_list->SortUrl($business_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $business_list->Location->headerCellClass() ?>"><div id="elh_business_Location" class="business_Location"><div class="ew-table-header-caption"><?php echo $business_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $business_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->Location) ?>', 1);"><div id="elh_business_Location" class="business_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->Turnover->Visible) { // Turnover ?>
	<?php if ($business_list->SortUrl($business_list->Turnover) == "") { ?>
		<th data-name="Turnover" class="<?php echo $business_list->Turnover->headerCellClass() ?>"><div id="elh_business_Turnover" class="business_Turnover"><div class="ew-table-header-caption"><?php echo $business_list->Turnover->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Turnover" class="<?php echo $business_list->Turnover->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->Turnover) ?>', 1);"><div id="elh_business_Turnover" class="business_Turnover">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->Turnover->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->Turnover->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->Turnover->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->Branches->Visible) { // Branches ?>
	<?php if ($business_list->SortUrl($business_list->Branches) == "") { ?>
		<th data-name="Branches" class="<?php echo $business_list->Branches->headerCellClass() ?>"><div id="elh_business_Branches" class="business_Branches"><div class="ew-table-header-caption"><?php echo $business_list->Branches->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Branches" class="<?php echo $business_list->Branches->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->Branches) ?>', 1);"><div id="elh_business_Branches" class="business_Branches">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->Branches->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->Branches->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->Branches->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->NewImprovements->Visible) { // NewImprovements ?>
	<?php if ($business_list->SortUrl($business_list->NewImprovements) == "") { ?>
		<th data-name="NewImprovements" class="<?php echo $business_list->NewImprovements->headerCellClass() ?>"><div id="elh_business_NewImprovements" class="business_NewImprovements"><div class="ew-table-header-caption"><?php echo $business_list->NewImprovements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewImprovements" class="<?php echo $business_list->NewImprovements->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->NewImprovements) ?>', 1);"><div id="elh_business_NewImprovements" class="business_NewImprovements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->NewImprovements->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->NewImprovements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->NewImprovements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->Longitude->Visible) { // Longitude ?>
	<?php if ($business_list->SortUrl($business_list->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $business_list->Longitude->headerCellClass() ?>"><div id="elh_business_Longitude" class="business_Longitude"><div class="ew-table-header-caption"><?php echo $business_list->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $business_list->Longitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->Longitude) ?>', 1);"><div id="elh_business_Longitude" class="business_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->Latitude->Visible) { // Latitude ?>
	<?php if ($business_list->SortUrl($business_list->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $business_list->Latitude->headerCellClass() ?>"><div id="elh_business_Latitude" class="business_Latitude"><div class="ew-table-header-caption"><?php echo $business_list->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $business_list->Latitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->Latitude) ?>', 1);"><div id="elh_business_Latitude" class="business_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->DateOpened->Visible) { // DateOpened ?>
	<?php if ($business_list->SortUrl($business_list->DateOpened) == "") { ?>
		<th data-name="DateOpened" class="<?php echo $business_list->DateOpened->headerCellClass() ?>"><div id="elh_business_DateOpened" class="business_DateOpened"><div class="ew-table-header-caption"><?php echo $business_list->DateOpened->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOpened" class="<?php echo $business_list->DateOpened->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->DateOpened) ?>', 1);"><div id="elh_business_DateOpened" class="business_DateOpened">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->DateOpened->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->DateOpened->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->DateOpened->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->BusinessDesc->Visible) { // BusinessDesc ?>
	<?php if ($business_list->SortUrl($business_list->BusinessDesc) == "") { ?>
		<th data-name="BusinessDesc" class="<?php echo $business_list->BusinessDesc->headerCellClass() ?>"><div id="elh_business_BusinessDesc" class="business_BusinessDesc"><div class="ew-table-header-caption"><?php echo $business_list->BusinessDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BusinessDesc" class="<?php echo $business_list->BusinessDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->BusinessDesc) ?>', 1);"><div id="elh_business_BusinessDesc" class="business_BusinessDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->BusinessDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->BusinessDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->BusinessDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($business_list->SortUrl($business_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $business_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_business_LastUpdatedBy" class="business_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $business_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $business_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->LastUpdatedBy) ?>', 1);"><div id="elh_business_LastUpdatedBy" class="business_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($business_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($business_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($business_list->SortUrl($business_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $business_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_business_LastUpdateDate" class="business_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $business_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $business_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $business_list->SortUrl($business_list->LastUpdateDate) ?>', 1);"><div id="elh_business_LastUpdateDate" class="business_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $business_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($business_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($business_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$business_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($business_list->ExportAll && $business_list->isExport()) {
	$business_list->StopRecord = $business_list->TotalRecords;
} else {

	// Set the last record to display
	if ($business_list->TotalRecords > $business_list->StartRecord + $business_list->DisplayRecords - 1)
		$business_list->StopRecord = $business_list->StartRecord + $business_list->DisplayRecords - 1;
	else
		$business_list->StopRecord = $business_list->TotalRecords;
}
$business_list->RecordCount = $business_list->StartRecord - 1;
if ($business_list->Recordset && !$business_list->Recordset->EOF) {
	$business_list->Recordset->moveFirst();
	$selectLimit = $business_list->UseSelectLimit;
	if (!$selectLimit && $business_list->StartRecord > 1)
		$business_list->Recordset->move($business_list->StartRecord - 1);
} elseif (!$business->AllowAddDeleteRow && $business_list->StopRecord == 0) {
	$business_list->StopRecord = $business->GridAddRowCount;
}

// Initialize aggregate
$business->RowType = ROWTYPE_AGGREGATEINIT;
$business->resetAttributes();
$business_list->renderRow();
while ($business_list->RecordCount < $business_list->StopRecord) {
	$business_list->RecordCount++;
	if ($business_list->RecordCount >= $business_list->StartRecord) {
		$business_list->RowCount++;

		// Set up key count
		$business_list->KeyCount = $business_list->RowIndex;

		// Init row class and style
		$business->resetAttributes();
		$business->CssClass = "";
		if ($business_list->isGridAdd()) {
		} else {
			$business_list->loadRowValues($business_list->Recordset); // Load row values
		}
		$business->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$business->RowAttrs->merge(["data-rowindex" => $business_list->RowCount, "id" => "r" . $business_list->RowCount . "_business", "data-rowtype" => $business->RowType]);

		// Render row
		$business_list->renderRow();

		// Render list options
		$business_list->renderListOptions();
?>
	<tr <?php echo $business->rowAttributes() ?>>
<?php

// Render list options (body, left)
$business_list->ListOptions->render("body", "left", $business_list->RowCount);
?>
	<?php if ($business_list->BusinessID->Visible) { // BusinessID ?>
		<td data-name="BusinessID" <?php echo $business_list->BusinessID->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_BusinessID">
<span<?php echo $business_list->BusinessID->viewAttributes() ?>><?php echo $business_list->BusinessID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->PACRANo->Visible) { // PACRANo ?>
		<td data-name="PACRANo" <?php echo $business_list->PACRANo->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_PACRANo">
<span<?php echo $business_list->PACRANo->viewAttributes() ?>><?php echo $business_list->PACRANo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->TPIN->Visible) { // TPIN ?>
		<td data-name="TPIN" <?php echo $business_list->TPIN->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_TPIN">
<span<?php echo $business_list->TPIN->viewAttributes() ?>><?php echo $business_list->TPIN->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->BusinessName->Visible) { // BusinessName ?>
		<td data-name="BusinessName" <?php echo $business_list->BusinessName->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_BusinessName">
<span<?php echo $business_list->BusinessName->viewAttributes() ?>><?php echo $business_list->BusinessName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $business_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_ClientID">
<span<?php echo $business_list->ClientID->viewAttributes() ?>><?php echo $business_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->BusinessSector->Visible) { // BusinessSector ?>
		<td data-name="BusinessSector" <?php echo $business_list->BusinessSector->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_BusinessSector">
<span<?php echo $business_list->BusinessSector->viewAttributes() ?>><?php echo $business_list->BusinessSector->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->BusinessType->Visible) { // BusinessType ?>
		<td data-name="BusinessType" <?php echo $business_list->BusinessType->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_BusinessType">
<span<?php echo $business_list->BusinessType->viewAttributes() ?>><?php echo $business_list->BusinessType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $business_list->Location->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_Location">
<span<?php echo $business_list->Location->viewAttributes() ?>><?php echo $business_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->Turnover->Visible) { // Turnover ?>
		<td data-name="Turnover" <?php echo $business_list->Turnover->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_Turnover">
<span<?php echo $business_list->Turnover->viewAttributes() ?>><?php echo $business_list->Turnover->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->Branches->Visible) { // Branches ?>
		<td data-name="Branches" <?php echo $business_list->Branches->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_Branches">
<span<?php echo $business_list->Branches->viewAttributes() ?>><?php echo $business_list->Branches->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->NewImprovements->Visible) { // NewImprovements ?>
		<td data-name="NewImprovements" <?php echo $business_list->NewImprovements->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_NewImprovements">
<span<?php echo $business_list->NewImprovements->viewAttributes() ?>><?php echo $business_list->NewImprovements->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $business_list->Longitude->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_Longitude">
<span<?php echo $business_list->Longitude->viewAttributes() ?>><?php echo $business_list->Longitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $business_list->Latitude->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_Latitude">
<span<?php echo $business_list->Latitude->viewAttributes() ?>><?php echo $business_list->Latitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->DateOpened->Visible) { // DateOpened ?>
		<td data-name="DateOpened" <?php echo $business_list->DateOpened->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_DateOpened">
<span<?php echo $business_list->DateOpened->viewAttributes() ?>><?php echo $business_list->DateOpened->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->BusinessDesc->Visible) { // BusinessDesc ?>
		<td data-name="BusinessDesc" <?php echo $business_list->BusinessDesc->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_BusinessDesc">
<span<?php echo $business_list->BusinessDesc->viewAttributes() ?>><?php echo $business_list->BusinessDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $business_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_LastUpdatedBy">
<span<?php echo $business_list->LastUpdatedBy->viewAttributes() ?>><?php echo $business_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($business_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $business_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $business_list->RowCount ?>_business_LastUpdateDate">
<span<?php echo $business_list->LastUpdateDate->viewAttributes() ?>><?php echo $business_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$business_list->ListOptions->render("body", "right", $business_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$business_list->isGridAdd())
		$business_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$business->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($business_list->Recordset)
	$business_list->Recordset->Close();
?>
<?php if (!$business_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$business_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $business_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $business_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($business_list->TotalRecords == 0 && !$business->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $business_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$business_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$business_list->isExport()) { ?>
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
$business_list->terminate();
?>