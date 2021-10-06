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
$property_no_use_list = new property_no_use_list();

// Run the page
$property_no_use_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$property_no_use_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$property_no_use_list->isExport()) { ?>
<script>
var fproperty_no_uselist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fproperty_no_uselist = currentForm = new ew.Form("fproperty_no_uselist", "list");
	fproperty_no_uselist.formKeyCountName = '<?php echo $property_no_use_list->FormKeyCountName ?>';
	loadjs.done("fproperty_no_uselist");
});
var fproperty_no_uselistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fproperty_no_uselistsrch = currentSearchForm = new ew.Form("fproperty_no_uselistsrch");

	// Dynamic selection lists
	// Filters

	fproperty_no_uselistsrch.filterList = <?php echo $property_no_use_list->getFilterList() ?>;

	// Init search panel as collapsed
	fproperty_no_uselistsrch.initSearchPanel = true;
	loadjs.done("fproperty_no_uselistsrch");
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
<?php if (!$property_no_use_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($property_no_use_list->TotalRecords > 0 && $property_no_use_list->ExportOptions->visible()) { ?>
<?php $property_no_use_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($property_no_use_list->ImportOptions->visible()) { ?>
<?php $property_no_use_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($property_no_use_list->SearchOptions->visible()) { ?>
<?php $property_no_use_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($property_no_use_list->FilterOptions->visible()) { ?>
<?php $property_no_use_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$property_no_use_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$property_no_use_list->isExport() && !$property_no_use->CurrentAction) { ?>
<form name="fproperty_no_uselistsrch" id="fproperty_no_uselistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fproperty_no_uselistsrch-search-panel" class="<?php echo $property_no_use_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="property_no_use">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $property_no_use_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($property_no_use_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($property_no_use_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $property_no_use_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($property_no_use_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($property_no_use_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($property_no_use_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($property_no_use_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $property_no_use_list->showPageHeader(); ?>
<?php
$property_no_use_list->showMessage();
?>
<?php if ($property_no_use_list->TotalRecords > 0 || $property_no_use->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($property_no_use_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> property_no_use">
<?php if (!$property_no_use_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$property_no_use_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_no_use_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_no_use_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fproperty_no_uselist" id="fproperty_no_uselist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="property_no_use">
<div id="gmp_property_no_use" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($property_no_use_list->TotalRecords > 0 || $property_no_use_list->isGridEdit()) { ?>
<table id="tbl_property_no_uselist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$property_no_use->RowType = ROWTYPE_HEADER;

// Render list options
$property_no_use_list->renderListOptions();

// Render list options (header, left)
$property_no_use_list->ListOptions->render("header", "left");
?>
<?php if ($property_no_use_list->ValuationNo->Visible) { // ValuationNo ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->ValuationNo) == "") { ?>
		<th data-name="ValuationNo" class="<?php echo $property_no_use_list->ValuationNo->headerCellClass() ?>"><div id="elh_property_no_use_ValuationNo" class="property_no_use_ValuationNo"><div class="ew-table-header-caption"><?php echo $property_no_use_list->ValuationNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValuationNo" class="<?php echo $property_no_use_list->ValuationNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->ValuationNo) ?>', 1);"><div id="elh_property_no_use_ValuationNo" class="property_no_use_ValuationNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->ValuationNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->ValuationNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->ValuationNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->PropertyNo->Visible) { // PropertyNo ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->PropertyNo) == "") { ?>
		<th data-name="PropertyNo" class="<?php echo $property_no_use_list->PropertyNo->headerCellClass() ?>"><div id="elh_property_no_use_PropertyNo" class="property_no_use_PropertyNo"><div class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyNo" class="<?php echo $property_no_use_list->PropertyNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->PropertyNo) ?>', 1);"><div id="elh_property_no_use_PropertyNo" class="property_no_use_PropertyNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->PropertyNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->PropertyNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_no_use_list->ClientSerNo->headerCellClass() ?>"><div id="elh_property_no_use_ClientSerNo" class="property_no_use_ClientSerNo"><div class="ew-table-header-caption"><?php echo $property_no_use_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $property_no_use_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->ClientSerNo) ?>', 1);"><div id="elh_property_no_use_ClientSerNo" class="property_no_use_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->ClientID->Visible) { // ClientID ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $property_no_use_list->ClientID->headerCellClass() ?>"><div id="elh_property_no_use_ClientID" class="property_no_use_ClientID"><div class="ew-table-header-caption"><?php echo $property_no_use_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $property_no_use_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->ClientID) ?>', 1);"><div id="elh_property_no_use_ClientID" class="property_no_use_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->PropertyGroup->Visible) { // PropertyGroup ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->PropertyGroup) == "") { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_no_use_list->PropertyGroup->headerCellClass() ?>"><div id="elh_property_no_use_PropertyGroup" class="property_no_use_PropertyGroup"><div class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyGroup" class="<?php echo $property_no_use_list->PropertyGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->PropertyGroup) ?>', 1);"><div id="elh_property_no_use_PropertyGroup" class="property_no_use_PropertyGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyGroup->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->PropertyGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->PropertyGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->PropertyType->Visible) { // PropertyType ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->PropertyType) == "") { ?>
		<th data-name="PropertyType" class="<?php echo $property_no_use_list->PropertyType->headerCellClass() ?>"><div id="elh_property_no_use_PropertyType" class="property_no_use_PropertyType"><div class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyType" class="<?php echo $property_no_use_list->PropertyType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->PropertyType) ?>', 1);"><div id="elh_property_no_use_PropertyType" class="property_no_use_PropertyType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyType->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->PropertyType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->PropertyType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->Location->Visible) { // Location ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->Location) == "") { ?>
		<th data-name="Location" class="<?php echo $property_no_use_list->Location->headerCellClass() ?>"><div id="elh_property_no_use_Location" class="property_no_use_Location"><div class="ew-table-header-caption"><?php echo $property_no_use_list->Location->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Location" class="<?php echo $property_no_use_list->Location->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->Location) ?>', 1);"><div id="elh_property_no_use_Location" class="property_no_use_Location">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->Location->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->Location->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->Location->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->PropertyStatus->Visible) { // PropertyStatus ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->PropertyStatus) == "") { ?>
		<th data-name="PropertyStatus" class="<?php echo $property_no_use_list->PropertyStatus->headerCellClass() ?>"><div id="elh_property_no_use_PropertyStatus" class="property_no_use_PropertyStatus"><div class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyStatus" class="<?php echo $property_no_use_list->PropertyStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->PropertyStatus) ?>', 1);"><div id="elh_property_no_use_PropertyStatus" class="property_no_use_PropertyStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->PropertyStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->PropertyStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->PropertyUse->Visible) { // PropertyUse ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->PropertyUse) == "") { ?>
		<th data-name="PropertyUse" class="<?php echo $property_no_use_list->PropertyUse->headerCellClass() ?>"><div id="elh_property_no_use_PropertyUse" class="property_no_use_PropertyUse"><div class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyUse->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PropertyUse" class="<?php echo $property_no_use_list->PropertyUse->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->PropertyUse) ?>', 1);"><div id="elh_property_no_use_PropertyUse" class="property_no_use_PropertyUse">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->PropertyUse->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->PropertyUse->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->PropertyUse->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->LandExtentInHA) == "") { ?>
		<th data-name="LandExtentInHA" class="<?php echo $property_no_use_list->LandExtentInHA->headerCellClass() ?>"><div id="elh_property_no_use_LandExtentInHA" class="property_no_use_LandExtentInHA"><div class="ew-table-header-caption"><?php echo $property_no_use_list->LandExtentInHA->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandExtentInHA" class="<?php echo $property_no_use_list->LandExtentInHA->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->LandExtentInHA) ?>', 1);"><div id="elh_property_no_use_LandExtentInHA" class="property_no_use_LandExtentInHA">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->LandExtentInHA->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->LandExtentInHA->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->LandExtentInHA->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->LandValue->Visible) { // LandValue ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->LandValue) == "") { ?>
		<th data-name="LandValue" class="<?php echo $property_no_use_list->LandValue->headerCellClass() ?>"><div id="elh_property_no_use_LandValue" class="property_no_use_LandValue"><div class="ew-table-header-caption"><?php echo $property_no_use_list->LandValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LandValue" class="<?php echo $property_no_use_list->LandValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->LandValue) ?>', 1);"><div id="elh_property_no_use_LandValue" class="property_no_use_LandValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->LandValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->LandValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->LandValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->ImprovementsValue) == "") { ?>
		<th data-name="ImprovementsValue" class="<?php echo $property_no_use_list->ImprovementsValue->headerCellClass() ?>"><div id="elh_property_no_use_ImprovementsValue" class="property_no_use_ImprovementsValue"><div class="ew-table-header-caption"><?php echo $property_no_use_list->ImprovementsValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ImprovementsValue" class="<?php echo $property_no_use_list->ImprovementsValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->ImprovementsValue) ?>', 1);"><div id="elh_property_no_use_ImprovementsValue" class="property_no_use_ImprovementsValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->ImprovementsValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->ImprovementsValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->ImprovementsValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->RateableValue->Visible) { // RateableValue ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->RateableValue) == "") { ?>
		<th data-name="RateableValue" class="<?php echo $property_no_use_list->RateableValue->headerCellClass() ?>"><div id="elh_property_no_use_RateableValue" class="property_no_use_RateableValue"><div class="ew-table-header-caption"><?php echo $property_no_use_list->RateableValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RateableValue" class="<?php echo $property_no_use_list->RateableValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->RateableValue) ?>', 1);"><div id="elh_property_no_use_RateableValue" class="property_no_use_RateableValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->RateableValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->RateableValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->RateableValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->SupplementaryValue) == "") { ?>
		<th data-name="SupplementaryValue" class="<?php echo $property_no_use_list->SupplementaryValue->headerCellClass() ?>"><div id="elh_property_no_use_SupplementaryValue" class="property_no_use_SupplementaryValue"><div class="ew-table-header-caption"><?php echo $property_no_use_list->SupplementaryValue->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SupplementaryValue" class="<?php echo $property_no_use_list->SupplementaryValue->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->SupplementaryValue) ?>', 1);"><div id="elh_property_no_use_SupplementaryValue" class="property_no_use_SupplementaryValue">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->SupplementaryValue->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->SupplementaryValue->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->SupplementaryValue->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->ExemptCode) == "") { ?>
		<th data-name="ExemptCode" class="<?php echo $property_no_use_list->ExemptCode->headerCellClass() ?>"><div id="elh_property_no_use_ExemptCode" class="property_no_use_ExemptCode"><div class="ew-table-header-caption"><?php echo $property_no_use_list->ExemptCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExemptCode" class="<?php echo $property_no_use_list->ExemptCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->ExemptCode) ?>', 1);"><div id="elh_property_no_use_ExemptCode" class="property_no_use_ExemptCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->ExemptCode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->ExemptCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->ExemptCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->Improvements->Visible) { // Improvements ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->Improvements) == "") { ?>
		<th data-name="Improvements" class="<?php echo $property_no_use_list->Improvements->headerCellClass() ?>"><div id="elh_property_no_use_Improvements" class="property_no_use_Improvements"><div class="ew-table-header-caption"><?php echo $property_no_use_list->Improvements->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Improvements" class="<?php echo $property_no_use_list->Improvements->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->Improvements) ?>', 1);"><div id="elh_property_no_use_Improvements" class="property_no_use_Improvements">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->Improvements->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->Improvements->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->Improvements->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->StreetAddress) == "") { ?>
		<th data-name="StreetAddress" class="<?php echo $property_no_use_list->StreetAddress->headerCellClass() ?>"><div id="elh_property_no_use_StreetAddress" class="property_no_use_StreetAddress"><div class="ew-table-header-caption"><?php echo $property_no_use_list->StreetAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StreetAddress" class="<?php echo $property_no_use_list->StreetAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->StreetAddress) ?>', 1);"><div id="elh_property_no_use_StreetAddress" class="property_no_use_StreetAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->StreetAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->StreetAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->StreetAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->Longitude->Visible) { // Longitude ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $property_no_use_list->Longitude->headerCellClass() ?>"><div id="elh_property_no_use_Longitude" class="property_no_use_Longitude"><div class="ew-table-header-caption"><?php echo $property_no_use_list->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $property_no_use_list->Longitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->Longitude) ?>', 1);"><div id="elh_property_no_use_Longitude" class="property_no_use_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->Latitude->Visible) { // Latitude ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $property_no_use_list->Latitude->headerCellClass() ?>"><div id="elh_property_no_use_Latitude" class="property_no_use_Latitude"><div class="ew-table-header-caption"><?php echo $property_no_use_list->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $property_no_use_list->Latitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->Latitude) ?>', 1);"><div id="elh_property_no_use_Latitude" class="property_no_use_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->Incumberance->Visible) { // Incumberance ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->Incumberance) == "") { ?>
		<th data-name="Incumberance" class="<?php echo $property_no_use_list->Incumberance->headerCellClass() ?>"><div id="elh_property_no_use_Incumberance" class="property_no_use_Incumberance"><div class="ew-table-header-caption"><?php echo $property_no_use_list->Incumberance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Incumberance" class="<?php echo $property_no_use_list->Incumberance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->Incumberance) ?>', 1);"><div id="elh_property_no_use_Incumberance" class="property_no_use_Incumberance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->Incumberance->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->Incumberance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->Incumberance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->SubDivisionOf->Visible) { // SubDivisionOf ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->SubDivisionOf) == "") { ?>
		<th data-name="SubDivisionOf" class="<?php echo $property_no_use_list->SubDivisionOf->headerCellClass() ?>"><div id="elh_property_no_use_SubDivisionOf" class="property_no_use_SubDivisionOf"><div class="ew-table-header-caption"><?php echo $property_no_use_list->SubDivisionOf->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SubDivisionOf" class="<?php echo $property_no_use_list->SubDivisionOf->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->SubDivisionOf) ?>', 1);"><div id="elh_property_no_use_SubDivisionOf" class="property_no_use_SubDivisionOf">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->SubDivisionOf->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->SubDivisionOf->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->SubDivisionOf->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->LastUpdatedBy) == "") { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_no_use_list->LastUpdatedBy->headerCellClass() ?>"><div id="elh_property_no_use_LastUpdatedBy" class="property_no_use_LastUpdatedBy"><div class="ew-table-header-caption"><?php echo $property_no_use_list->LastUpdatedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdatedBy" class="<?php echo $property_no_use_list->LastUpdatedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->LastUpdatedBy) ?>', 1);"><div id="elh_property_no_use_LastUpdatedBy" class="property_no_use_LastUpdatedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->LastUpdatedBy->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->LastUpdatedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->LastUpdatedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($property_no_use_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
	<?php if ($property_no_use_list->SortUrl($property_no_use_list->LastUpdateDate) == "") { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_no_use_list->LastUpdateDate->headerCellClass() ?>"><div id="elh_property_no_use_LastUpdateDate" class="property_no_use_LastUpdateDate"><div class="ew-table-header-caption"><?php echo $property_no_use_list->LastUpdateDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LastUpdateDate" class="<?php echo $property_no_use_list->LastUpdateDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $property_no_use_list->SortUrl($property_no_use_list->LastUpdateDate) ?>', 1);"><div id="elh_property_no_use_LastUpdateDate" class="property_no_use_LastUpdateDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $property_no_use_list->LastUpdateDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($property_no_use_list->LastUpdateDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($property_no_use_list->LastUpdateDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$property_no_use_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($property_no_use_list->ExportAll && $property_no_use_list->isExport()) {
	$property_no_use_list->StopRecord = $property_no_use_list->TotalRecords;
} else {

	// Set the last record to display
	if ($property_no_use_list->TotalRecords > $property_no_use_list->StartRecord + $property_no_use_list->DisplayRecords - 1)
		$property_no_use_list->StopRecord = $property_no_use_list->StartRecord + $property_no_use_list->DisplayRecords - 1;
	else
		$property_no_use_list->StopRecord = $property_no_use_list->TotalRecords;
}
$property_no_use_list->RecordCount = $property_no_use_list->StartRecord - 1;
if ($property_no_use_list->Recordset && !$property_no_use_list->Recordset->EOF) {
	$property_no_use_list->Recordset->moveFirst();
	$selectLimit = $property_no_use_list->UseSelectLimit;
	if (!$selectLimit && $property_no_use_list->StartRecord > 1)
		$property_no_use_list->Recordset->move($property_no_use_list->StartRecord - 1);
} elseif (!$property_no_use->AllowAddDeleteRow && $property_no_use_list->StopRecord == 0) {
	$property_no_use_list->StopRecord = $property_no_use->GridAddRowCount;
}

// Initialize aggregate
$property_no_use->RowType = ROWTYPE_AGGREGATEINIT;
$property_no_use->resetAttributes();
$property_no_use_list->renderRow();
while ($property_no_use_list->RecordCount < $property_no_use_list->StopRecord) {
	$property_no_use_list->RecordCount++;
	if ($property_no_use_list->RecordCount >= $property_no_use_list->StartRecord) {
		$property_no_use_list->RowCount++;

		// Set up key count
		$property_no_use_list->KeyCount = $property_no_use_list->RowIndex;

		// Init row class and style
		$property_no_use->resetAttributes();
		$property_no_use->CssClass = "";
		if ($property_no_use_list->isGridAdd()) {
		} else {
			$property_no_use_list->loadRowValues($property_no_use_list->Recordset); // Load row values
		}
		$property_no_use->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$property_no_use->RowAttrs->merge(["data-rowindex" => $property_no_use_list->RowCount, "id" => "r" . $property_no_use_list->RowCount . "_property_no_use", "data-rowtype" => $property_no_use->RowType]);

		// Render row
		$property_no_use_list->renderRow();

		// Render list options
		$property_no_use_list->renderListOptions();
?>
	<tr <?php echo $property_no_use->rowAttributes() ?>>
<?php

// Render list options (body, left)
$property_no_use_list->ListOptions->render("body", "left", $property_no_use_list->RowCount);
?>
	<?php if ($property_no_use_list->ValuationNo->Visible) { // ValuationNo ?>
		<td data-name="ValuationNo" <?php echo $property_no_use_list->ValuationNo->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_ValuationNo">
<span<?php echo $property_no_use_list->ValuationNo->viewAttributes() ?>><?php echo $property_no_use_list->ValuationNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->PropertyNo->Visible) { // PropertyNo ?>
		<td data-name="PropertyNo" <?php echo $property_no_use_list->PropertyNo->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_PropertyNo">
<span<?php echo $property_no_use_list->PropertyNo->viewAttributes() ?>><?php echo $property_no_use_list->PropertyNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $property_no_use_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_ClientSerNo">
<span<?php echo $property_no_use_list->ClientSerNo->viewAttributes() ?>><?php echo $property_no_use_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $property_no_use_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_ClientID">
<span<?php echo $property_no_use_list->ClientID->viewAttributes() ?>><?php echo $property_no_use_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->PropertyGroup->Visible) { // PropertyGroup ?>
		<td data-name="PropertyGroup" <?php echo $property_no_use_list->PropertyGroup->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_PropertyGroup">
<span<?php echo $property_no_use_list->PropertyGroup->viewAttributes() ?>><?php echo $property_no_use_list->PropertyGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->PropertyType->Visible) { // PropertyType ?>
		<td data-name="PropertyType" <?php echo $property_no_use_list->PropertyType->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_PropertyType">
<span<?php echo $property_no_use_list->PropertyType->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_PropertyType" class="custom-control-input" value="<?php echo $property_no_use_list->PropertyType->getViewValue() ?>" disabled<?php if (ConvertToBool($property_no_use_list->PropertyType->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_PropertyType"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->Location->Visible) { // Location ?>
		<td data-name="Location" <?php echo $property_no_use_list->Location->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_Location">
<span<?php echo $property_no_use_list->Location->viewAttributes() ?>><?php echo $property_no_use_list->Location->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->PropertyStatus->Visible) { // PropertyStatus ?>
		<td data-name="PropertyStatus" <?php echo $property_no_use_list->PropertyStatus->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_PropertyStatus">
<span<?php echo $property_no_use_list->PropertyStatus->viewAttributes() ?>><div class="custom-control custom-checkbox d-inline-block"><input type="checkbox" id="x_PropertyStatus" class="custom-control-input" value="<?php echo $property_no_use_list->PropertyStatus->getViewValue() ?>" disabled<?php if (ConvertToBool($property_no_use_list->PropertyStatus->CurrentValue)) { ?> checked<?php } ?>><label class="custom-control-label" for="x_PropertyStatus"></label></div></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->PropertyUse->Visible) { // PropertyUse ?>
		<td data-name="PropertyUse" <?php echo $property_no_use_list->PropertyUse->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_PropertyUse">
<span<?php echo $property_no_use_list->PropertyUse->viewAttributes() ?>><?php echo $property_no_use_list->PropertyUse->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->LandExtentInHA->Visible) { // LandExtentInHA ?>
		<td data-name="LandExtentInHA" <?php echo $property_no_use_list->LandExtentInHA->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_LandExtentInHA">
<span<?php echo $property_no_use_list->LandExtentInHA->viewAttributes() ?>><?php echo $property_no_use_list->LandExtentInHA->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->LandValue->Visible) { // LandValue ?>
		<td data-name="LandValue" <?php echo $property_no_use_list->LandValue->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_LandValue">
<span<?php echo $property_no_use_list->LandValue->viewAttributes() ?>><?php echo $property_no_use_list->LandValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->ImprovementsValue->Visible) { // ImprovementsValue ?>
		<td data-name="ImprovementsValue" <?php echo $property_no_use_list->ImprovementsValue->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_ImprovementsValue">
<span<?php echo $property_no_use_list->ImprovementsValue->viewAttributes() ?>><?php echo $property_no_use_list->ImprovementsValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->RateableValue->Visible) { // RateableValue ?>
		<td data-name="RateableValue" <?php echo $property_no_use_list->RateableValue->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_RateableValue">
<span<?php echo $property_no_use_list->RateableValue->viewAttributes() ?>><?php echo $property_no_use_list->RateableValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->SupplementaryValue->Visible) { // SupplementaryValue ?>
		<td data-name="SupplementaryValue" <?php echo $property_no_use_list->SupplementaryValue->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_SupplementaryValue">
<span<?php echo $property_no_use_list->SupplementaryValue->viewAttributes() ?>><?php echo $property_no_use_list->SupplementaryValue->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode" <?php echo $property_no_use_list->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_ExemptCode">
<span<?php echo $property_no_use_list->ExemptCode->viewAttributes() ?>><?php echo $property_no_use_list->ExemptCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->Improvements->Visible) { // Improvements ?>
		<td data-name="Improvements" <?php echo $property_no_use_list->Improvements->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_Improvements">
<span<?php echo $property_no_use_list->Improvements->viewAttributes() ?>><?php echo $property_no_use_list->Improvements->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress" <?php echo $property_no_use_list->StreetAddress->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_StreetAddress">
<span<?php echo $property_no_use_list->StreetAddress->viewAttributes() ?>><?php echo $property_no_use_list->StreetAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $property_no_use_list->Longitude->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_Longitude">
<span<?php echo $property_no_use_list->Longitude->viewAttributes() ?>><?php echo $property_no_use_list->Longitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $property_no_use_list->Latitude->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_Latitude">
<span<?php echo $property_no_use_list->Latitude->viewAttributes() ?>><?php echo $property_no_use_list->Latitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance" <?php echo $property_no_use_list->Incumberance->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_Incumberance">
<span<?php echo $property_no_use_list->Incumberance->viewAttributes() ?>><?php echo $property_no_use_list->Incumberance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->SubDivisionOf->Visible) { // SubDivisionOf ?>
		<td data-name="SubDivisionOf" <?php echo $property_no_use_list->SubDivisionOf->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_SubDivisionOf">
<span<?php echo $property_no_use_list->SubDivisionOf->viewAttributes() ?>><?php echo $property_no_use_list->SubDivisionOf->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->LastUpdatedBy->Visible) { // LastUpdatedBy ?>
		<td data-name="LastUpdatedBy" <?php echo $property_no_use_list->LastUpdatedBy->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_LastUpdatedBy">
<span<?php echo $property_no_use_list->LastUpdatedBy->viewAttributes() ?>><?php echo $property_no_use_list->LastUpdatedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($property_no_use_list->LastUpdateDate->Visible) { // LastUpdateDate ?>
		<td data-name="LastUpdateDate" <?php echo $property_no_use_list->LastUpdateDate->cellAttributes() ?>>
<span id="el<?php echo $property_no_use_list->RowCount ?>_property_no_use_LastUpdateDate">
<span<?php echo $property_no_use_list->LastUpdateDate->viewAttributes() ?>><?php echo $property_no_use_list->LastUpdateDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$property_no_use_list->ListOptions->render("body", "right", $property_no_use_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$property_no_use_list->isGridAdd())
		$property_no_use_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$property_no_use->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($property_no_use_list->Recordset)
	$property_no_use_list->Recordset->Close();
?>
<?php if (!$property_no_use_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$property_no_use_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $property_no_use_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $property_no_use_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($property_no_use_list->TotalRecords == 0 && !$property_no_use->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $property_no_use_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$property_no_use_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$property_no_use_list->isExport()) { ?>
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
$property_no_use_list->terminate();
?>