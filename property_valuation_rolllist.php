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
$property_valuation_roll_list = new property_valuation_roll_list();

// Run the page
$property_valuation_roll_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_valuation_roll_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_valuation_roll_list->isExport()) { ?>
<script>
var fproperty_valuation_rolllist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_valuation_rolllist = currentForm = new ew.Form("fproperty_valuation_rolllist", "list");
	fproperty_valuation_rolllist.formKeyCountName = '<?php echo $property_valuation_roll_list->FormKeyCountName ?>';
	loadjs.done("fproperty_valuation_rolllist");
});
var fproperty_valuation_rolllistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_valuation_rolllistsrch = currentSearchForm = new ew.Form("fproperty_valuation_rolllistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_valuation_rolllistsrch.filterList = <?php echo $property_valuation_roll_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_valuation_rolllistsrch.initSearchPanel = true;
	loadjs.done("fproperty_valuation_rolllistsrch");
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
<?php if (!$property_valuation_roll_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_valuation_roll_list->TotalRecords > 0 && $property_valuation_roll_list->ExportOptions->visible()) { ?>
<?php $property_valuation_roll_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_valuation_roll_list->ImportOptions->visible()) { ?>
<?php $property_valuation_roll_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_valuation_roll_list->SearchOptions->visible()) { ?>
<?php $property_valuation_roll_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_valuation_roll_list->FilterOptions->visible()) { ?>
<?php $property_valuation_roll_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_valuation_roll_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_valuation_roll_list->isExport() && !$property_valuation_roll->CurrentAction) { ?>
<form name="fproperty_valuation_rolllistsrch" id="fproperty_valuation_rolllistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_valuation_rolllistsrch-search-panel" class="<?php echo $property_valuation_roll_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_valuation_roll">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_valuation_roll_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_valuation_roll_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_valuation_roll_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_valuation_roll_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_valuation_roll_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_valuation_roll_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_valuation_roll_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_valuation_roll_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_valuation_roll_list->showPageHeader(); ?>
<?php
$property_valuation_roll_list->showMessage();
?>
<?php if ($property_valuation_roll_list->TotalRecords > 0 || $property_valuation_roll->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_valuation_roll_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_valuation_roll">
<?php if (!$property_valuation_roll_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_valuation_roll_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_valuation_roll_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_valuation_roll_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_valuation_rolllist" id="fproperty_valuation_rolllist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_valuation_roll">
<div id="gmp_property_valuation_roll" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_valuation_roll_list->TotalRecords > 0 || $property_valuation_roll_list->isGridEdit()) { ?>
<table id="tbl_property_valuation_rolllist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_valuation_roll->RowType = ROWTYPE_HEADER;

// Render list options
$property_valuation_roll_list->renderListOptions();

// Render list options (header, left)
$property_valuation_roll_list->ListOptions->render("header", "left");
?>
<?php if ($property_valuation_roll_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_valuation_roll_list->ValuationNo->headerCellClass() ?>"><div id="elh_property_valuation_roll_ValuationNo" class="property_valuation_roll_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_valuation_roll_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->ValuationNo) ?>', 1);"><div id="elh_property_valuation_roll_ValuationNo" class="property_valuation_roll_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $property_valuation_roll_list->PropertyNo->headerCellClass() ?>"><div id="elh_property_valuation_roll_PropertyNo" class="property_valuation_roll_PropertyNo"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $property_valuation_roll_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->PropertyNo) ?>', 1);"><div id="elh_property_valuation_roll_PropertyNo" class="property_valuation_roll_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->PropertyNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->StandNo->Visible) { // StandNo ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->StandNo) == "") { ?>
		<th data-name="StandNo" class="<?php echo $property_valuation_roll_list->StandNo->headerCellClass() ?>"><div id="elh_property_valuation_roll_StandNo" class="property_valuation_roll_StandNo"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->StandNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StandNo" class="<?php echo $property_valuation_roll_list->StandNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->StandNo) ?>', 1);"><div id="elh_property_valuation_roll_StandNo" class="property_valuation_roll_StandNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->StandNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->StandNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->StandNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->ClientID->Visible) { // ClientID ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $property_valuation_roll_list->ClientID->headerCellClass() ?>"><div id="elh_property_valuation_roll_ClientID" class="property_valuation_roll_ClientID"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $property_valuation_roll_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->ClientID) ?>', 1);"><div id="elh_property_valuation_roll_ClientID" class="property_valuation_roll_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_valuation_roll_list->PropertyGroup->headerCellClass() ?>"><div id="elh_property_valuation_roll_PropertyGroup" class="property_valuation_roll_PropertyGroup"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_valuation_roll_list->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->PropertyGroup) ?>', 1);"><div id="elh_property_valuation_roll_PropertyGroup" class="property_valuation_roll_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->PropertyType) == "") { ?>
		<th data-name="PropertyType" class="<?php echo $property_valuation_roll_list->PropertyType->headerCellClass() ?>"><div id="elh_property_valuation_roll_PropertyType" class="property_valuation_roll_PropertyType"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->PropertyType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyType" class="<?php echo $property_valuation_roll_list->PropertyType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->PropertyType) ?>', 1);"><div id="elh_property_valuation_roll_PropertyType" class="property_valuation_roll_PropertyType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->PropertyType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->PropertyType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->PropertyType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->Location->Visible) { // Location ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_valuation_roll_list->Location->headerCellClass() ?>"><div id="elh_property_valuation_roll_Location" class="property_valuation_roll_Location"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_valuation_roll_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->Location) ?>', 1);"><div id="elh_property_valuation_roll_Location" class="property_valuation_roll_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->RollStatus->Visible) { // RollStatus ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->RollStatus) == "") { ?>
		<th data-name="RollStatus" class="<?php echo $property_valuation_roll_list->RollStatus->headerCellClass() ?>"><div id="elh_property_valuation_roll_RollStatus" class="property_valuation_roll_RollStatus"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->RollStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RollStatus" class="<?php echo $property_valuation_roll_list->RollStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->RollStatus) ?>', 1);"><div id="elh_property_valuation_roll_RollStatus" class="property_valuation_roll_RollStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->RollStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->RollStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->RollStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->UseCode->Visible) { // UseCode ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->UseCode) == "") { ?>
		<th data-name="UseCode" class="<?php echo $property_valuation_roll_list->UseCode->headerCellClass() ?>"><div id="elh_property_valuation_roll_UseCode" class="property_valuation_roll_UseCode"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->UseCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UseCode" class="<?php echo $property_valuation_roll_list->UseCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->UseCode) ?>', 1);"><div id="elh_property_valuation_roll_UseCode" class="property_valuation_roll_UseCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->UseCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->UseCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->UseCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->AreaOfLand->Visible) { // AreaOfLand ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->AreaOfLand) == "") { ?>
		<th data-name="AreaOfLand" class="<?php echo $property_valuation_roll_list->AreaOfLand->headerCellClass() ?>"><div id="elh_property_valuation_roll_AreaOfLand" class="property_valuation_roll_AreaOfLand"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->AreaOfLand->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaOfLand" class="<?php echo $property_valuation_roll_list->AreaOfLand->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->AreaOfLand) ?>', 1);"><div id="elh_property_valuation_roll_AreaOfLand" class="property_valuation_roll_AreaOfLand">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->AreaOfLand->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->AreaOfLand->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->AreaOfLand->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->AreaCode->Visible) { // AreaCode ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->AreaCode) == "") { ?>
		<th data-name="AreaCode" class="<?php echo $property_valuation_roll_list->AreaCode->headerCellClass() ?>"><div id="elh_property_valuation_roll_AreaCode" class="property_valuation_roll_AreaCode"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->AreaCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AreaCode" class="<?php echo $property_valuation_roll_list->AreaCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->AreaCode) ?>', 1);"><div id="elh_property_valuation_roll_AreaCode" class="property_valuation_roll_AreaCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->AreaCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->AreaCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->AreaCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->SiteNumber->Visible) { // SiteNumber ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->SiteNumber) == "") { ?>
		<th data-name="SiteNumber" class="<?php echo $property_valuation_roll_list->SiteNumber->headerCellClass() ?>"><div id="elh_property_valuation_roll_SiteNumber" class="property_valuation_roll_SiteNumber"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->SiteNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SiteNumber" class="<?php echo $property_valuation_roll_list->SiteNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->SiteNumber) ?>', 1);"><div id="elh_property_valuation_roll_SiteNumber" class="property_valuation_roll_SiteNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->SiteNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->SiteNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->SiteNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $property_valuation_roll_list->RateableValue->headerCellClass() ?>"><div id="elh_property_valuation_roll_RateableValue" class="property_valuation_roll_RateableValue"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $property_valuation_roll_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->RateableValue) ?>', 1);"><div id="elh_property_valuation_roll_RateableValue" class="property_valuation_roll_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->NewRateableValue->Visible) { // NewRateableValue ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->NewRateableValue) == "") { ?>
		<th data-name="NewRateableValue" class="<?php echo $property_valuation_roll_list->NewRateableValue->headerCellClass() ?>"><div id="elh_property_valuation_roll_NewRateableValue" class="property_valuation_roll_NewRateableValue"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->NewRateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewRateableValue" class="<?php echo $property_valuation_roll_list->NewRateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->NewRateableValue) ?>', 1);"><div id="elh_property_valuation_roll_NewRateableValue" class="property_valuation_roll_NewRateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->NewRateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->NewRateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->NewRateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->ExemptCode) == "") { ?>
		<th data-name="ExemptCode" class="<?php echo $property_valuation_roll_list->ExemptCode->headerCellClass() ?>"><div id="elh_property_valuation_roll_ExemptCode" class="property_valuation_roll_ExemptCode"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->ExemptCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExemptCode" class="<?php echo $property_valuation_roll_list->ExemptCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->ExemptCode) ?>', 1);"><div id="elh_property_valuation_roll_ExemptCode" class="property_valuation_roll_ExemptCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->ExemptCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->ExemptCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->Improvements->Visible) { // Improvements ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->Improvements) == "") { ?>
		<th data-name="Improvements" class="<?php echo $property_valuation_roll_list->Improvements->headerCellClass() ?>"><div id="elh_property_valuation_roll_Improvements" class="property_valuation_roll_Improvements"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Improvements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Improvements" class="<?php echo $property_valuation_roll_list->Improvements->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->Improvements) ?>', 1);"><div id="elh_property_valuation_roll_Improvements" class="property_valuation_roll_Improvements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Improvements->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->Improvements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->Improvements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->NewImprovements->Visible) { // NewImprovements ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->NewImprovements) == "") { ?>
		<th data-name="NewImprovements" class="<?php echo $property_valuation_roll_list->NewImprovements->headerCellClass() ?>"><div id="elh_property_valuation_roll_NewImprovements" class="property_valuation_roll_NewImprovements"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->NewImprovements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="NewImprovements" class="<?php echo $property_valuation_roll_list->NewImprovements->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->NewImprovements) ?>', 1);"><div id="elh_property_valuation_roll_NewImprovements" class="property_valuation_roll_NewImprovements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->NewImprovements->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->NewImprovements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->NewImprovements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->Longitude->Visible) { // Longitude ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $property_valuation_roll_list->Longitude->headerCellClass() ?>"><div id="elh_property_valuation_roll_Longitude" class="property_valuation_roll_Longitude"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $property_valuation_roll_list->Longitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->Longitude) ?>', 1);"><div id="elh_property_valuation_roll_Longitude" class="property_valuation_roll_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->Latitude->Visible) { // Latitude ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $property_valuation_roll_list->Latitude->headerCellClass() ?>"><div id="elh_property_valuation_roll_Latitude" class="property_valuation_roll_Latitude"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $property_valuation_roll_list->Latitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->Latitude) ?>', 1);"><div id="elh_property_valuation_roll_Latitude" class="property_valuation_roll_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->DateEvaluated->Visible) { // DateEvaluated ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->DateEvaluated) == "") { ?>
		<th data-name="DateEvaluated" class="<?php echo $property_valuation_roll_list->DateEvaluated->headerCellClass() ?>"><div id="elh_property_valuation_roll_DateEvaluated" class="property_valuation_roll_DateEvaluated"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->DateEvaluated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateEvaluated" class="<?php echo $property_valuation_roll_list->DateEvaluated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->DateEvaluated) ?>', 1);"><div id="elh_property_valuation_roll_DateEvaluated" class="property_valuation_roll_DateEvaluated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->DateEvaluated->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->DateEvaluated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->DateEvaluated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->DateEntered->Visible) { // DateEntered ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->DateEntered) == "") { ?>
		<th data-name="DateEntered" class="<?php echo $property_valuation_roll_list->DateEntered->headerCellClass() ?>"><div id="elh_property_valuation_roll_DateEntered" class="property_valuation_roll_DateEntered"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->DateEntered->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateEntered" class="<?php echo $property_valuation_roll_list->DateEntered->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->DateEntered) ?>', 1);"><div id="elh_property_valuation_roll_DateEntered" class="property_valuation_roll_DateEntered">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->DateEntered->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->DateEntered->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->DateEntered->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_valuation_roll_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_property_valuation_roll_LastUpdatedBy" class="property_valuation_roll_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_valuation_roll_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->LastUpdatedBy) ?>', 1);"><div id="elh_property_valuation_roll_LastUpdatedBy" class="property_valuation_roll_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_valuation_roll_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($property_valuation_roll_list->SortUrl($property_valuation_roll_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_valuation_roll_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_property_valuation_roll_LastUpdateDate" class="property_valuation_roll_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $property_valuation_roll_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_valuation_roll_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_valuation_roll_list->SortUrl($property_valuation_roll_list->LastUpdateDate) ?>', 1);"><div id="elh_property_valuation_roll_LastUpdateDate" class="property_valuation_roll_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_valuation_roll_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_valuation_roll_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_valuation_roll_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_valuation_roll_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_valuation_roll_list->ExportAll && $property_valuation_roll_list->isExport()) {
	$property_valuation_roll_list->StopRecord = $property_valuation_roll_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_valuation_roll_list->TotalRecords > $property_valuation_roll_list->StartRecord + $property_valuation_roll_list->DisplayRecords - 1)
		$property_valuation_roll_list->StopRecord = $property_valuation_roll_list->StartRecord + $property_valuation_roll_list->DisplayRecords - 1;
	else
		$property_valuation_roll_list->StopRecord = $property_valuation_roll_list->TotalRecords;
}
$property_valuation_roll_list->RecordCount = $property_valuation_roll_list->StartRecord - 1;
if ($property_valuation_roll_list->Recordset && !$property_valuation_roll_list->Recordset->EOF) {
	$property_valuation_roll_list->Recordset->moveFirst();
	$selectLimit = $property_valuation_roll_list->UseSelectLimit;
	if (!$selectLimit && $property_valuation_roll_list->StartRecord > 1)
		$property_valuation_roll_list->Recordset->move($property_valuation_roll_list->StartRecord - 1);
} elseif (!$property_valuation_roll->AllowAddDeleteRow && $property_valuation_roll_list->StopRecord == 0) {
	$property_valuation_roll_list->StopRecord = $property_valuation_roll->GridAddRowCount;
}

// Initialize aggregate
$property_valuation_roll->RowType = ROWTYPE_AGGREGATEINIT;
$property_valuation_roll->resetAttributes();
$property_valuation_roll_list->renderRow();
while ($property_valuation_roll_list->RecordCount < $property_valuation_roll_list->StopRecord) {
	$property_valuation_roll_list->RecordCount++;
	if ($property_valuation_roll_list->RecordCount >= $property_valuation_roll_list->StartRecord) {
		$property_valuation_roll_list->RowCount++;

		// Set up key count
		$property_valuation_roll_list->KeyCount = $property_valuation_roll_list->RowIndex;

		// Init row class and style
		$property_valuation_roll->resetAttributes();
		$property_valuation_roll->CssClass = "";
		if ($property_valuation_roll_list->isGridAdd()) {
		} else {
			$property_valuation_roll_list->loadRowValues($property_valuation_roll_list->Recordset); // Load row values
		}
		$property_valuation_roll->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_valuation_roll->RowAttrs->merge(["data-rowindex" => $property_valuation_roll_list->RowCount, "id" => "r" . $property_valuation_roll_list->RowCount . "_property_valuation_roll", "data-rowtype" => $property_valuation_roll->RowType]);

		// Render row
		$property_valuation_roll_list->renderRow();

		// Render list options
		$property_valuation_roll_list->renderListOptions();
?>
	<tr <?php echo $property_valuation_roll->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_valuation_roll_list->ListOptions->render("body", "left", $property_valuation_roll_list->RowCount);
?>
	<?php if ($property_valuation_roll_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_valuation_roll_list->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_ValuationNo">
<span<?php echo $property_valuation_roll_list->ValuationNo->viewAttributes() ?>><?php echo $property_valuation_roll_list->ValuationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $property_valuation_roll_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_PropertyNo">
<span<?php echo $property_valuation_roll_list->PropertyNo->viewAttributes() ?>><?php echo $property_valuation_roll_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->StandNo->Visible) { // StandNo ?>
		<td data-name="StandNo" <?php echo $property_valuation_roll_list->StandNo->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_StandNo">
<span<?php echo $property_valuation_roll_list->StandNo->viewAttributes() ?>><?php echo $property_valuation_roll_list->StandNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $property_valuation_roll_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_ClientID">
<span<?php echo $property_valuation_roll_list->ClientID->viewAttributes() ?>><?php echo $property_valuation_roll_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $property_valuation_roll_list->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_PropertyGroup">
<span<?php echo $property_valuation_roll_list->PropertyGroup->viewAttributes() ?>><?php echo $property_valuation_roll_list->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType" <?php echo $property_valuation_roll_list->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_PropertyType">
<span<?php echo $property_valuation_roll_list->PropertyType->viewAttributes() ?>><?php echo $property_valuation_roll_list->PropertyType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_valuation_roll_list->Location->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_Location">
<span<?php echo $property_valuation_roll_list->Location->viewAttributes() ?>><?php echo $property_valuation_roll_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->RollStatus->Visible) { // RollStatus ?>
		<td data-name="RollStatus" <?php echo $property_valuation_roll_list->RollStatus->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_RollStatus">
<span<?php echo $property_valuation_roll_list->RollStatus->viewAttributes() ?>><?php echo $property_valuation_roll_list->RollStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->UseCode->Visible) { // UseCode ?>
		<td data-name="UseCode" <?php echo $property_valuation_roll_list->UseCode->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_UseCode">
<span<?php echo $property_valuation_roll_list->UseCode->viewAttributes() ?>><?php echo $property_valuation_roll_list->UseCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->AreaOfLand->Visible) { // AreaOfLand ?>
		<td data-name="AreaOfLand" <?php echo $property_valuation_roll_list->AreaOfLand->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_AreaOfLand">
<span<?php echo $property_valuation_roll_list->AreaOfLand->viewAttributes() ?>><?php echo $property_valuation_roll_list->AreaOfLand->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->AreaCode->Visible) { // AreaCode ?>
		<td data-name="AreaCode" <?php echo $property_valuation_roll_list->AreaCode->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_AreaCode">
<span<?php echo $property_valuation_roll_list->AreaCode->viewAttributes() ?>><?php echo $property_valuation_roll_list->AreaCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->SiteNumber->Visible) { // SiteNumber ?>
		<td data-name="SiteNumber" <?php echo $property_valuation_roll_list->SiteNumber->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_SiteNumber">
<span<?php echo $property_valuation_roll_list->SiteNumber->viewAttributes() ?>><?php echo $property_valuation_roll_list->SiteNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $property_valuation_roll_list->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_RateableValue">
<span<?php echo $property_valuation_roll_list->RateableValue->viewAttributes() ?>><?php echo $property_valuation_roll_list->RateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->NewRateableValue->Visible) { // NewRateableValue ?>
		<td data-name="NewRateableValue" <?php echo $property_valuation_roll_list->NewRateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_NewRateableValue">
<span<?php echo $property_valuation_roll_list->NewRateableValue->viewAttributes() ?>><?php echo $property_valuation_roll_list->NewRateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode" <?php echo $property_valuation_roll_list->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_ExemptCode">
<span<?php echo $property_valuation_roll_list->ExemptCode->viewAttributes() ?>><?php echo $property_valuation_roll_list->ExemptCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements" <?php echo $property_valuation_roll_list->Improvements->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_Improvements">
<span<?php echo $property_valuation_roll_list->Improvements->viewAttributes() ?>><?php echo $property_valuation_roll_list->Improvements->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->NewImprovements->Visible) { // NewImprovements ?>
		<td data-name="NewImprovements" <?php echo $property_valuation_roll_list->NewImprovements->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_NewImprovements">
<span<?php echo $property_valuation_roll_list->NewImprovements->viewAttributes() ?>><?php echo $property_valuation_roll_list->NewImprovements->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $property_valuation_roll_list->Longitude->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_Longitude">
<span<?php echo $property_valuation_roll_list->Longitude->viewAttributes() ?>><?php echo $property_valuation_roll_list->Longitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $property_valuation_roll_list->Latitude->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_Latitude">
<span<?php echo $property_valuation_roll_list->Latitude->viewAttributes() ?>><?php echo $property_valuation_roll_list->Latitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->DateEvaluated->Visible) { // DateEvaluated ?>
		<td data-name="DateEvaluated" <?php echo $property_valuation_roll_list->DateEvaluated->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_DateEvaluated">
<span<?php echo $property_valuation_roll_list->DateEvaluated->viewAttributes() ?>><?php echo $property_valuation_roll_list->DateEvaluated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->DateEntered->Visible) { // DateEntered ?>
		<td data-name="DateEntered" <?php echo $property_valuation_roll_list->DateEntered->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_DateEntered">
<span<?php echo $property_valuation_roll_list->DateEntered->viewAttributes() ?>><?php echo $property_valuation_roll_list->DateEntered->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $property_valuation_roll_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_LastUpdatedBy">
<span<?php echo $property_valuation_roll_list->LastUpdatedBy->viewAttributes() ?>><?php echo $property_valuation_roll_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_valuation_roll_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $property_valuation_roll_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $property_valuation_roll_list->RowCount ?>_property_valuation_roll_LastUpdateDate">
<span<?php echo $property_valuation_roll_list->LastUpdateDate->viewAttributes() ?>><?php echo $property_valuation_roll_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_valuation_roll_list->ListOptions->render("body", "right", $property_valuation_roll_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_valuation_roll_list->isGridAdd())
		$property_valuation_roll_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_valuation_roll->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_valuation_roll_list->Recordset)
	$property_valuation_roll_list->Recordset->Close();
?>
<?php if (!$property_valuation_roll_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_valuation_roll_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_valuation_roll_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_valuation_roll_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_valuation_roll_list->TotalRecords == 0 && !$property_valuation_roll->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_valuation_roll_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_valuation_roll_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_valuation_roll_list->isExport()) { ?>
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
$property_valuation_roll_list->terminate();
?>