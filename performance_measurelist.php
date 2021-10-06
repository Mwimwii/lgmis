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
$performance_measure_list = new performance_measure_list();

// Run the page
$performance_measure_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$performance_measure_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$performance_measure_list->isExport()) { ?>
<script>
var fperformance_measurelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fperformance_measurelist = currentForm = new ew.Form("fperformance_measurelist", "list");
	fperformance_measurelist.formKeyCountName = '<?php echo $performance_measure_list->FormKeyCountName ?>';
	loadjs.done("fperformance_measurelist");
});
var fperformance_measurelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fperformance_measurelistsrch = currentSearchForm = new ew.Form("fperformance_measurelistsrch");

	// Dynamic selection lists
	// Filters

	fperformance_measurelistsrch.filterList = <?php echo $performance_measure_list->getFilterList() ?>;

	// Init search panel as collapsed
	fperformance_measurelistsrch.initSearchPanel = true;
	loadjs.done("fperformance_measurelistsrch");
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
<?php if (!$performance_measure_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($performance_measure_list->TotalRecords > 0 && $performance_measure_list->ExportOptions->visible()) { ?>
<?php $performance_measure_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($performance_measure_list->ImportOptions->visible()) { ?>
<?php $performance_measure_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($performance_measure_list->SearchOptions->visible()) { ?>
<?php $performance_measure_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($performance_measure_list->FilterOptions->visible()) { ?>
<?php $performance_measure_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$performance_measure_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$performance_measure_list->isExport() && !$performance_measure->CurrentAction) { ?>
<form name="fperformance_measurelistsrch" id="fperformance_measurelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fperformance_measurelistsrch-search-panel" class="<?php echo $performance_measure_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="performance_measure">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $performance_measure_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($performance_measure_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($performance_measure_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $performance_measure_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($performance_measure_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($performance_measure_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($performance_measure_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($performance_measure_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $performance_measure_list->showPageHeader(); ?>
<?php
$performance_measure_list->showMessage();
?>
<?php if ($performance_measure_list->TotalRecords > 0 || $performance_measure->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($performance_measure_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> performance_measure">
<?php if (!$performance_measure_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$performance_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $performance_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $performance_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fperformance_measurelist" id="fperformance_measurelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="performance_measure">
<div id="gmp_performance_measure" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($performance_measure_list->TotalRecords > 0 || $performance_measure_list->isGridEdit()) { ?>
<table id="tbl_performance_measurelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$performance_measure->RowType = ROWTYPE_HEADER;

// Render list options
$performance_measure_list->renderListOptions();

// Render list options (header, left)
$performance_measure_list->ListOptions->render("header", "left");
?>
<?php if ($performance_measure_list->PefromanceRef->Visible) { // PefromanceRef ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->PefromanceRef) == "") { ?>
		<th data-name="PefromanceRef" class="<?php echo $performance_measure_list->PefromanceRef->headerCellClass() ?>"><div id="elh_performance_measure_PefromanceRef" class="performance_measure_PefromanceRef"><div class="ew-table-header-caption"><?php echo $performance_measure_list->PefromanceRef->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PefromanceRef" class="<?php echo $performance_measure_list->PefromanceRef->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->PefromanceRef) ?>', 1);"><div id="elh_performance_measure_PefromanceRef" class="performance_measure_PefromanceRef">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->PefromanceRef->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->PefromanceRef->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->PefromanceRef->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->IndicatorCode->Visible) { // IndicatorCode ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->IndicatorCode) == "") { ?>
		<th data-name="IndicatorCode" class="<?php echo $performance_measure_list->IndicatorCode->headerCellClass() ?>"><div id="elh_performance_measure_IndicatorCode" class="performance_measure_IndicatorCode"><div class="ew-table-header-caption"><?php echo $performance_measure_list->IndicatorCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IndicatorCode" class="<?php echo $performance_measure_list->IndicatorCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->IndicatorCode) ?>', 1);"><div id="elh_performance_measure_IndicatorCode" class="performance_measure_IndicatorCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->IndicatorCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->IndicatorCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->IndicatorCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->Category->Visible) { // Category ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->Category) == "") { ?>
		<th data-name="Category" class="<?php echo $performance_measure_list->Category->headerCellClass() ?>"><div id="elh_performance_measure_Category" class="performance_measure_Category"><div class="ew-table-header-caption"><?php echo $performance_measure_list->Category->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Category" class="<?php echo $performance_measure_list->Category->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->Category) ?>', 1);"><div id="elh_performance_measure_Category" class="performance_measure_Category">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->Category->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->Category->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->Category->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->TargetDesc->Visible) { // TargetDesc ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->TargetDesc) == "") { ?>
		<th data-name="TargetDesc" class="<?php echo $performance_measure_list->TargetDesc->headerCellClass() ?>"><div id="elh_performance_measure_TargetDesc" class="performance_measure_TargetDesc"><div class="ew-table-header-caption"><?php echo $performance_measure_list->TargetDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TargetDesc" class="<?php echo $performance_measure_list->TargetDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->TargetDesc) ?>', 1);"><div id="elh_performance_measure_TargetDesc" class="performance_measure_TargetDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->TargetDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->TargetDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->TargetDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->Target->Visible) { // Target ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->Target) == "") { ?>
		<th data-name="Target" class="<?php echo $performance_measure_list->Target->headerCellClass() ?>"><div id="elh_performance_measure_Target" class="performance_measure_Target"><div class="ew-table-header-caption"><?php echo $performance_measure_list->Target->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Target" class="<?php echo $performance_measure_list->Target->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->Target) ?>', 1);"><div id="elh_performance_measure_Target" class="performance_measure_Target">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->Target->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->Target->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->Target->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->ValueDesc->Visible) { // ValueDesc ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->ValueDesc) == "") { ?>
		<th data-name="ValueDesc" class="<?php echo $performance_measure_list->ValueDesc->headerCellClass() ?>"><div id="elh_performance_measure_ValueDesc" class="performance_measure_ValueDesc"><div class="ew-table-header-caption"><?php echo $performance_measure_list->ValueDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ValueDesc" class="<?php echo $performance_measure_list->ValueDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->ValueDesc) ?>', 1);"><div id="elh_performance_measure_ValueDesc" class="performance_measure_ValueDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->ValueDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->ValueDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->ValueDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->Value->Visible) { // Value ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->Value) == "") { ?>
		<th data-name="Value" class="<?php echo $performance_measure_list->Value->headerCellClass() ?>"><div id="elh_performance_measure_Value" class="performance_measure_Value"><div class="ew-table-header-caption"><?php echo $performance_measure_list->Value->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Value" class="<?php echo $performance_measure_list->Value->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->Value) ?>', 1);"><div id="elh_performance_measure_Value" class="performance_measure_Value">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->Value->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->Value->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->Value->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->UnitOfMeasure) == "") { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $performance_measure_list->UnitOfMeasure->headerCellClass() ?>"><div id="elh_performance_measure_UnitOfMeasure" class="performance_measure_UnitOfMeasure"><div class="ew-table-header-caption"><?php echo $performance_measure_list->UnitOfMeasure->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="UnitOfMeasure" class="<?php echo $performance_measure_list->UnitOfMeasure->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->UnitOfMeasure) ?>', 1);"><div id="elh_performance_measure_UnitOfMeasure" class="performance_measure_UnitOfMeasure">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->UnitOfMeasure->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->UnitOfMeasure->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->UnitOfMeasure->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->Deviation->Visible) { // Deviation ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->Deviation) == "") { ?>
		<th data-name="Deviation" class="<?php echo $performance_measure_list->Deviation->headerCellClass() ?>"><div id="elh_performance_measure_Deviation" class="performance_measure_Deviation"><div class="ew-table-header-caption"><?php echo $performance_measure_list->Deviation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Deviation" class="<?php echo $performance_measure_list->Deviation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->Deviation) ?>', 1);"><div id="elh_performance_measure_Deviation" class="performance_measure_Deviation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->Deviation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->Deviation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->Deviation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->Recommendation->Visible) { // Recommendation ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->Recommendation) == "") { ?>
		<th data-name="Recommendation" class="<?php echo $performance_measure_list->Recommendation->headerCellClass() ?>"><div id="elh_performance_measure_Recommendation" class="performance_measure_Recommendation"><div class="ew-table-header-caption"><?php echo $performance_measure_list->Recommendation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Recommendation" class="<?php echo $performance_measure_list->Recommendation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->Recommendation) ?>', 1);"><div id="elh_performance_measure_Recommendation" class="performance_measure_Recommendation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->Recommendation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->Recommendation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->Recommendation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->Remedies->Visible) { // Remedies ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->Remedies) == "") { ?>
		<th data-name="Remedies" class="<?php echo $performance_measure_list->Remedies->headerCellClass() ?>"><div id="elh_performance_measure_Remedies" class="performance_measure_Remedies"><div class="ew-table-header-caption"><?php echo $performance_measure_list->Remedies->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Remedies" class="<?php echo $performance_measure_list->Remedies->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->Remedies) ?>', 1);"><div id="elh_performance_measure_Remedies" class="performance_measure_Remedies">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->Remedies->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->Remedies->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->Remedies->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->PMonth->Visible) { // PMonth ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->PMonth) == "") { ?>
		<th data-name="PMonth" class="<?php echo $performance_measure_list->PMonth->headerCellClass() ?>"><div id="elh_performance_measure_PMonth" class="performance_measure_PMonth"><div class="ew-table-header-caption"><?php echo $performance_measure_list->PMonth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PMonth" class="<?php echo $performance_measure_list->PMonth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->PMonth) ?>', 1);"><div id="elh_performance_measure_PMonth" class="performance_measure_PMonth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->PMonth->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->PMonth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->PMonth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($performance_measure_list->PYear->Visible) { // PYear ?>
	<?php if ($performance_measure_list->SortUrl($performance_measure_list->PYear) == "") { ?>
		<th data-name="PYear" class="<?php echo $performance_measure_list->PYear->headerCellClass() ?>"><div id="elh_performance_measure_PYear" class="performance_measure_PYear"><div class="ew-table-header-caption"><?php echo $performance_measure_list->PYear->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PYear" class="<?php echo $performance_measure_list->PYear->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $performance_measure_list->SortUrl($performance_measure_list->PYear) ?>', 1);"><div id="elh_performance_measure_PYear" class="performance_measure_PYear">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $performance_measure_list->PYear->caption() ?></span><span class="ew-table-header-sort"><?php if ($performance_measure_list->PYear->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($performance_measure_list->PYear->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$performance_measure_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($performance_measure_list->ExportAll && $performance_measure_list->isExport()) {
	$performance_measure_list->StopRecord = $performance_measure_list->TotalRecords;
} else {

	// Set the last record to display
	if ($performance_measure_list->TotalRecords > $performance_measure_list->StartRecord + $performance_measure_list->DisplayRecords - 1)
		$performance_measure_list->StopRecord = $performance_measure_list->StartRecord + $performance_measure_list->DisplayRecords - 1;
	else
		$performance_measure_list->StopRecord = $performance_measure_list->TotalRecords;
}
$performance_measure_list->RecordCount = $performance_measure_list->StartRecord - 1;
if ($performance_measure_list->Recordset && !$performance_measure_list->Recordset->EOF) {
	$performance_measure_list->Recordset->moveFirst();
	$selectLimit = $performance_measure_list->UseSelectLimit;
	if (!$selectLimit && $performance_measure_list->StartRecord > 1)
		$performance_measure_list->Recordset->move($performance_measure_list->StartRecord - 1);
} elseif (!$performance_measure->AllowAddDeleteRow && $performance_measure_list->StopRecord == 0) {
	$performance_measure_list->StopRecord = $performance_measure->GridAddRowCount;
}

// Initialize aggregate
$performance_measure->RowType = ROWTYPE_AGGREGATEINIT;
$performance_measure->resetAttributes();
$performance_measure_list->renderRow();
while ($performance_measure_list->RecordCount < $performance_measure_list->StopRecord) {
	$performance_measure_list->RecordCount++;
	if ($performance_measure_list->RecordCount >= $performance_measure_list->StartRecord) {
		$performance_measure_list->RowCount++;

		// Set up key count
		$performance_measure_list->KeyCount = $performance_measure_list->RowIndex;

		// Init row class and style
		$performance_measure->resetAttributes();
		$performance_measure->CssClass = "";
		if ($performance_measure_list->isGridAdd()) {
		} else {
			$performance_measure_list->loadRowValues($performance_measure_list->Recordset); // Load row values
		}
		$performance_measure->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$performance_measure->RowAttrs->merge(["data-rowindex" => $performance_measure_list->RowCount, "id" => "r" . $performance_measure_list->RowCount . "_performance_measure", "data-rowtype" => $performance_measure->RowType]);

		// Render row
		$performance_measure_list->renderRow();

		// Render list options
		$performance_measure_list->renderListOptions();
?>
	<tr <?php echo $performance_measure->rowAttributes() ?>>
<?php

// Render list options (body, left)
$performance_measure_list->ListOptions->render("body", "left", $performance_measure_list->RowCount);
?>
	<?php if ($performance_measure_list->PefromanceRef->Visible) { // PefromanceRef ?>
		<td data-name="PefromanceRef" <?php echo $performance_measure_list->PefromanceRef->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_PefromanceRef">
<span<?php echo $performance_measure_list->PefromanceRef->viewAttributes() ?>><?php echo $performance_measure_list->PefromanceRef->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->IndicatorCode->Visible) { // IndicatorCode ?>
		<td data-name="IndicatorCode" <?php echo $performance_measure_list->IndicatorCode->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_IndicatorCode">
<span<?php echo $performance_measure_list->IndicatorCode->viewAttributes() ?>><?php echo $performance_measure_list->IndicatorCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->Category->Visible) { // Category ?>
		<td data-name="Category" <?php echo $performance_measure_list->Category->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_Category">
<span<?php echo $performance_measure_list->Category->viewAttributes() ?>><?php echo $performance_measure_list->Category->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->TargetDesc->Visible) { // TargetDesc ?>
		<td data-name="TargetDesc" <?php echo $performance_measure_list->TargetDesc->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_TargetDesc">
<span<?php echo $performance_measure_list->TargetDesc->viewAttributes() ?>><?php echo $performance_measure_list->TargetDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->Target->Visible) { // Target ?>
		<td data-name="Target" <?php echo $performance_measure_list->Target->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_Target">
<span<?php echo $performance_measure_list->Target->viewAttributes() ?>><?php echo $performance_measure_list->Target->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->ValueDesc->Visible) { // ValueDesc ?>
		<td data-name="ValueDesc" <?php echo $performance_measure_list->ValueDesc->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_ValueDesc">
<span<?php echo $performance_measure_list->ValueDesc->viewAttributes() ?>><?php echo $performance_measure_list->ValueDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->Value->Visible) { // Value ?>
		<td data-name="Value" <?php echo $performance_measure_list->Value->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_Value">
<span<?php echo $performance_measure_list->Value->viewAttributes() ?>><?php echo $performance_measure_list->Value->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->UnitOfMeasure->Visible) { // UnitOfMeasure ?>
		<td data-name="UnitOfMeasure" <?php echo $performance_measure_list->UnitOfMeasure->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_UnitOfMeasure">
<span<?php echo $performance_measure_list->UnitOfMeasure->viewAttributes() ?>><?php echo $performance_measure_list->UnitOfMeasure->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->Deviation->Visible) { // Deviation ?>
		<td data-name="Deviation" <?php echo $performance_measure_list->Deviation->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_Deviation">
<span<?php echo $performance_measure_list->Deviation->viewAttributes() ?>><?php echo $performance_measure_list->Deviation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->Recommendation->Visible) { // Recommendation ?>
		<td data-name="Recommendation" <?php echo $performance_measure_list->Recommendation->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_Recommendation">
<span<?php echo $performance_measure_list->Recommendation->viewAttributes() ?>><?php echo $performance_measure_list->Recommendation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->Remedies->Visible) { // Remedies ?>
		<td data-name="Remedies" <?php echo $performance_measure_list->Remedies->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_Remedies">
<span<?php echo $performance_measure_list->Remedies->viewAttributes() ?>><?php echo $performance_measure_list->Remedies->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->PMonth->Visible) { // PMonth ?>
		<td data-name="PMonth" <?php echo $performance_measure_list->PMonth->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_PMonth">
<span<?php echo $performance_measure_list->PMonth->viewAttributes() ?>><?php echo $performance_measure_list->PMonth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($performance_measure_list->PYear->Visible) { // PYear ?>
		<td data-name="PYear" <?php echo $performance_measure_list->PYear->cellAttributes() ?>>
<span id="el<?php echo $performance_measure_list->RowCount ?>_performance_measure_PYear">
<span<?php echo $performance_measure_list->PYear->viewAttributes() ?>><?php echo $performance_measure_list->PYear->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$performance_measure_list->ListOptions->render("body", "right", $performance_measure_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$performance_measure_list->isGridAdd())
		$performance_measure_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$performance_measure->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($performance_measure_list->Recordset)
	$performance_measure_list->Recordset->Close();
?>
<?php if (!$performance_measure_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$performance_measure_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $performance_measure_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $performance_measure_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($performance_measure_list->TotalRecords == 0 && !$performance_measure->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $performance_measure_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$performance_measure_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$performance_measure_list->isExport()) { ?>
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
$performance_measure_list->terminate();
?>