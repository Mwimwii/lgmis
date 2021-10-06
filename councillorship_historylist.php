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
$councillorship_history_list = new councillorship_history_list();

// Run the page
$councillorship_history_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$councillorship_history_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$councillorship_history_list->isExport()) { ?>
<script>
var fcouncillorship_historylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcouncillorship_historylist = currentForm = new ew.Form("fcouncillorship_historylist", "list");
	fcouncillorship_historylist.formKeyCountName = '<?php echo $councillorship_history_list->FormKeyCountName ?>';
	loadjs.done("fcouncillorship_historylist");
});
var fcouncillorship_historylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcouncillorship_historylistsrch = currentSearchForm = new ew.Form("fcouncillorship_historylistsrch");

	// Dynamic selection lists
	// Filters

	fcouncillorship_historylistsrch.filterList = <?php echo $councillorship_history_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcouncillorship_historylistsrch.initSearchPanel = true;
	loadjs.done("fcouncillorship_historylistsrch");
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
<?php if (!$councillorship_history_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($councillorship_history_list->TotalRecords > 0 && $councillorship_history_list->ExportOptions->visible()) { ?>
<?php $councillorship_history_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_history_list->ImportOptions->visible()) { ?>
<?php $councillorship_history_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_history_list->SearchOptions->visible()) { ?>
<?php $councillorship_history_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($councillorship_history_list->FilterOptions->visible()) { ?>
<?php $councillorship_history_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$councillorship_history_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$councillorship_history_list->isExport() && !$councillorship_history->CurrentAction) { ?>
<form name="fcouncillorship_historylistsrch" id="fcouncillorship_historylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcouncillorship_historylistsrch-search-panel" class="<?php echo $councillorship_history_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="councillorship_history">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $councillorship_history_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($councillorship_history_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($councillorship_history_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $councillorship_history_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($councillorship_history_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($councillorship_history_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($councillorship_history_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($councillorship_history_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $councillorship_history_list->showPageHeader(); ?>
<?php
$councillorship_history_list->showMessage();
?>
<?php if ($councillorship_history_list->TotalRecords > 0 || $councillorship_history->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($councillorship_history_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> councillorship_history">
<?php if (!$councillorship_history_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$councillorship_history_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_history_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillorship_history_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcouncillorship_historylist" id="fcouncillorship_historylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="councillorship_history">
<div id="gmp_councillorship_history" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($councillorship_history_list->TotalRecords > 0 || $councillorship_history_list->isGridEdit()) { ?>
<table id="tbl_councillorship_historylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$councillorship_history->RowType = ROWTYPE_HEADER;

// Render list options
$councillorship_history_list->renderListOptions();

// Render list options (header, left)
$councillorship_history_list->ListOptions->render("header", "left");
?>
<?php if ($councillorship_history_list->EmployeeID->Visible) { // EmployeeID ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->EmployeeID) == "") { ?>
		<th data-name="EmployeeID" class="<?php echo $councillorship_history_list->EmployeeID->headerCellClass() ?>"><div id="elh_councillorship_history_EmployeeID" class="councillorship_history_EmployeeID"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->EmployeeID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EmployeeID" class="<?php echo $councillorship_history_list->EmployeeID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->EmployeeID) ?>', 1);"><div id="elh_councillorship_history_EmployeeID" class="councillorship_history_EmployeeID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->EmployeeID->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->EmployeeID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->EmployeeID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $councillorship_history_list->ProvinceCode->headerCellClass() ?>"><div id="elh_councillorship_history_ProvinceCode" class="councillorship_history_ProvinceCode"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $councillorship_history_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->ProvinceCode) ?>', 1);"><div id="elh_councillorship_history_ProvinceCode" class="councillorship_history_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->LACode->Visible) { // LACode ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $councillorship_history_list->LACode->headerCellClass() ?>"><div id="elh_councillorship_history_LACode" class="councillorship_history_LACode"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $councillorship_history_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->LACode) ?>', 1);"><div id="elh_councillorship_history_LACode" class="councillorship_history_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->LACode->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->PoliticalParty->Visible) { // PoliticalParty ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->PoliticalParty) == "") { ?>
		<th data-name="PoliticalParty" class="<?php echo $councillorship_history_list->PoliticalParty->headerCellClass() ?>"><div id="elh_councillorship_history_PoliticalParty" class="councillorship_history_PoliticalParty"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->PoliticalParty->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PoliticalParty" class="<?php echo $councillorship_history_list->PoliticalParty->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->PoliticalParty) ?>', 1);"><div id="elh_councillorship_history_PoliticalParty" class="councillorship_history_PoliticalParty">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->PoliticalParty->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->PoliticalParty->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->PoliticalParty->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->Occupation->Visible) { // Occupation ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->Occupation) == "") { ?>
		<th data-name="Occupation" class="<?php echo $councillorship_history_list->Occupation->headerCellClass() ?>"><div id="elh_councillorship_history_Occupation" class="councillorship_history_Occupation"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->Occupation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Occupation" class="<?php echo $councillorship_history_list->Occupation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->Occupation) ?>', 1);"><div id="elh_councillorship_history_Occupation" class="councillorship_history_Occupation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->Occupation->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->Occupation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->Occupation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->PositionInCouncil) == "") { ?>
		<th data-name="PositionInCouncil" class="<?php echo $councillorship_history_list->PositionInCouncil->headerCellClass() ?>"><div id="elh_councillorship_history_PositionInCouncil" class="councillorship_history_PositionInCouncil"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->PositionInCouncil->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PositionInCouncil" class="<?php echo $councillorship_history_list->PositionInCouncil->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->PositionInCouncil) ?>', 1);"><div id="elh_councillorship_history_PositionInCouncil" class="councillorship_history_PositionInCouncil">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->PositionInCouncil->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->PositionInCouncil->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->PositionInCouncil->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->Committee->Visible) { // Committee ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->Committee) == "") { ?>
		<th data-name="Committee" class="<?php echo $councillorship_history_list->Committee->headerCellClass() ?>"><div id="elh_councillorship_history_Committee" class="councillorship_history_Committee"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->Committee->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Committee" class="<?php echo $councillorship_history_list->Committee->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->Committee) ?>', 1);"><div id="elh_councillorship_history_Committee" class="councillorship_history_Committee">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->Committee->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->Committee->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->Committee->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->CouncilTerm->Visible) { // CouncilTerm ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->CouncilTerm) == "") { ?>
		<th data-name="CouncilTerm" class="<?php echo $councillorship_history_list->CouncilTerm->headerCellClass() ?>"><div id="elh_councillorship_history_CouncilTerm" class="councillorship_history_CouncilTerm"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->CouncilTerm->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilTerm" class="<?php echo $councillorship_history_list->CouncilTerm->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->CouncilTerm) ?>', 1);"><div id="elh_councillorship_history_CouncilTerm" class="councillorship_history_CouncilTerm">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->CouncilTerm->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->CouncilTerm->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->CouncilTerm->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->DateOfExit->Visible) { // DateOfExit ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->DateOfExit) == "") { ?>
		<th data-name="DateOfExit" class="<?php echo $councillorship_history_list->DateOfExit->headerCellClass() ?>"><div id="elh_councillorship_history_DateOfExit" class="councillorship_history_DateOfExit"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->DateOfExit->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DateOfExit" class="<?php echo $councillorship_history_list->DateOfExit->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->DateOfExit) ?>', 1);"><div id="elh_councillorship_history_DateOfExit" class="councillorship_history_DateOfExit">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->DateOfExit->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->DateOfExit->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->DateOfExit->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->Allowance->Visible) { // Allowance ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->Allowance) == "") { ?>
		<th data-name="Allowance" class="<?php echo $councillorship_history_list->Allowance->headerCellClass() ?>"><div id="elh_councillorship_history_Allowance" class="councillorship_history_Allowance"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->Allowance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Allowance" class="<?php echo $councillorship_history_list->Allowance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->Allowance) ?>', 1);"><div id="elh_councillorship_history_Allowance" class="councillorship_history_Allowance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->Allowance->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->Allowance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->Allowance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->CouncillorTypeType) == "") { ?>
		<th data-name="CouncillorTypeType" class="<?php echo $councillorship_history_list->CouncillorTypeType->headerCellClass() ?>"><div id="elh_councillorship_history_CouncillorTypeType" class="councillorship_history_CouncillorTypeType"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->CouncillorTypeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorTypeType" class="<?php echo $councillorship_history_list->CouncillorTypeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->CouncillorTypeType) ?>', 1);"><div id="elh_councillorship_history_CouncillorTypeType" class="councillorship_history_CouncillorTypeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->CouncillorTypeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->CouncillorTypeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->CouncillorTypeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->CouncillorshipStatus) == "") { ?>
		<th data-name="CouncillorshipStatus" class="<?php echo $councillorship_history_list->CouncillorshipStatus->headerCellClass() ?>"><div id="elh_councillorship_history_CouncillorshipStatus" class="councillorship_history_CouncillorshipStatus"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->CouncillorshipStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncillorshipStatus" class="<?php echo $councillorship_history_list->CouncillorshipStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->CouncillorshipStatus) ?>', 1);"><div id="elh_councillorship_history_CouncillorshipStatus" class="councillorship_history_CouncillorshipStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->CouncillorshipStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->CouncillorshipStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->CouncillorshipStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->ExitReason->Visible) { // ExitReason ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->ExitReason) == "") { ?>
		<th data-name="ExitReason" class="<?php echo $councillorship_history_list->ExitReason->headerCellClass() ?>"><div id="elh_councillorship_history_ExitReason" class="councillorship_history_ExitReason"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->ExitReason->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExitReason" class="<?php echo $councillorship_history_list->ExitReason->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->ExitReason) ?>', 1);"><div id="elh_councillorship_history_ExitReason" class="councillorship_history_ExitReason">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->ExitReason->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->ExitReason->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->ExitReason->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($councillorship_history_list->RetirementType->Visible) { // RetirementType ?>
	<?php if ($councillorship_history_list->SortUrl($councillorship_history_list->RetirementType) == "") { ?>
		<th data-name="RetirementType" class="<?php echo $councillorship_history_list->RetirementType->headerCellClass() ?>"><div id="elh_councillorship_history_RetirementType" class="councillorship_history_RetirementType"><div class="ew-table-header-caption"><?php echo $councillorship_history_list->RetirementType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="RetirementType" class="<?php echo $councillorship_history_list->RetirementType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $councillorship_history_list->SortUrl($councillorship_history_list->RetirementType) ?>', 1);"><div id="elh_councillorship_history_RetirementType" class="councillorship_history_RetirementType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $councillorship_history_list->RetirementType->caption() ?></span><span class="ew-table-header-sort"><?php if ($councillorship_history_list->RetirementType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($councillorship_history_list->RetirementType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$councillorship_history_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($councillorship_history_list->ExportAll && $councillorship_history_list->isExport()) {
	$councillorship_history_list->StopRecord = $councillorship_history_list->TotalRecords;
} else {

	// Set the last record to display
	if ($councillorship_history_list->TotalRecords > $councillorship_history_list->StartRecord + $councillorship_history_list->DisplayRecords - 1)
		$councillorship_history_list->StopRecord = $councillorship_history_list->StartRecord + $councillorship_history_list->DisplayRecords - 1;
	else
		$councillorship_history_list->StopRecord = $councillorship_history_list->TotalRecords;
}
$councillorship_history_list->RecordCount = $councillorship_history_list->StartRecord - 1;
if ($councillorship_history_list->Recordset && !$councillorship_history_list->Recordset->EOF) {
	$councillorship_history_list->Recordset->moveFirst();
	$selectLimit = $councillorship_history_list->UseSelectLimit;
	if (!$selectLimit && $councillorship_history_list->StartRecord > 1)
		$councillorship_history_list->Recordset->move($councillorship_history_list->StartRecord - 1);
} elseif (!$councillorship_history->AllowAddDeleteRow && $councillorship_history_list->StopRecord == 0) {
	$councillorship_history_list->StopRecord = $councillorship_history->GridAddRowCount;
}

// Initialize aggregate
$councillorship_history->RowType = ROWTYPE_AGGREGATEINIT;
$councillorship_history->resetAttributes();
$councillorship_history_list->renderRow();
while ($councillorship_history_list->RecordCount < $councillorship_history_list->StopRecord) {
	$councillorship_history_list->RecordCount++;
	if ($councillorship_history_list->RecordCount >= $councillorship_history_list->StartRecord) {
		$councillorship_history_list->RowCount++;

		// Set up key count
		$councillorship_history_list->KeyCount = $councillorship_history_list->RowIndex;

		// Init row class and style
		$councillorship_history->resetAttributes();
		$councillorship_history->CssClass = "";
		if ($councillorship_history_list->isGridAdd()) {
		} else {
			$councillorship_history_list->loadRowValues($councillorship_history_list->Recordset); // Load row values
		}
		$councillorship_history->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$councillorship_history->RowAttrs->merge(["data-rowindex" => $councillorship_history_list->RowCount, "id" => "r" . $councillorship_history_list->RowCount . "_councillorship_history", "data-rowtype" => $councillorship_history->RowType]);

		// Render row
		$councillorship_history_list->renderRow();

		// Render list options
		$councillorship_history_list->renderListOptions();
?>
	<tr <?php echo $councillorship_history->rowAttributes() ?>>
<?php

// Render list options (body, left)
$councillorship_history_list->ListOptions->render("body", "left", $councillorship_history_list->RowCount);
?>
	<?php if ($councillorship_history_list->EmployeeID->Visible) { // EmployeeID ?>
		<td data-name="EmployeeID" <?php echo $councillorship_history_list->EmployeeID->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_EmployeeID">
<span<?php echo $councillorship_history_list->EmployeeID->viewAttributes() ?>><?php echo $councillorship_history_list->EmployeeID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $councillorship_history_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_ProvinceCode">
<span<?php echo $councillorship_history_list->ProvinceCode->viewAttributes() ?>><?php echo $councillorship_history_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $councillorship_history_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_LACode">
<span<?php echo $councillorship_history_list->LACode->viewAttributes() ?>><?php echo $councillorship_history_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->PoliticalParty->Visible) { // PoliticalParty ?>
		<td data-name="PoliticalParty" <?php echo $councillorship_history_list->PoliticalParty->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_PoliticalParty">
<span<?php echo $councillorship_history_list->PoliticalParty->viewAttributes() ?>><?php echo $councillorship_history_list->PoliticalParty->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->Occupation->Visible) { // Occupation ?>
		<td data-name="Occupation" <?php echo $councillorship_history_list->Occupation->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_Occupation">
<span<?php echo $councillorship_history_list->Occupation->viewAttributes() ?>><?php echo $councillorship_history_list->Occupation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->PositionInCouncil->Visible) { // PositionInCouncil ?>
		<td data-name="PositionInCouncil" <?php echo $councillorship_history_list->PositionInCouncil->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_PositionInCouncil">
<span<?php echo $councillorship_history_list->PositionInCouncil->viewAttributes() ?>><?php echo $councillorship_history_list->PositionInCouncil->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->Committee->Visible) { // Committee ?>
		<td data-name="Committee" <?php echo $councillorship_history_list->Committee->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_Committee">
<span<?php echo $councillorship_history_list->Committee->viewAttributes() ?>><?php echo $councillorship_history_list->Committee->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->CouncilTerm->Visible) { // CouncilTerm ?>
		<td data-name="CouncilTerm" <?php echo $councillorship_history_list->CouncilTerm->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_CouncilTerm">
<span<?php echo $councillorship_history_list->CouncilTerm->viewAttributes() ?>><?php echo $councillorship_history_list->CouncilTerm->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->DateOfExit->Visible) { // DateOfExit ?>
		<td data-name="DateOfExit" <?php echo $councillorship_history_list->DateOfExit->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_DateOfExit">
<span<?php echo $councillorship_history_list->DateOfExit->viewAttributes() ?>><?php echo $councillorship_history_list->DateOfExit->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->Allowance->Visible) { // Allowance ?>
		<td data-name="Allowance" <?php echo $councillorship_history_list->Allowance->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_Allowance">
<span<?php echo $councillorship_history_list->Allowance->viewAttributes() ?>><?php echo $councillorship_history_list->Allowance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->CouncillorTypeType->Visible) { // CouncillorTypeType ?>
		<td data-name="CouncillorTypeType" <?php echo $councillorship_history_list->CouncillorTypeType->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_CouncillorTypeType">
<span<?php echo $councillorship_history_list->CouncillorTypeType->viewAttributes() ?>><?php echo $councillorship_history_list->CouncillorTypeType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->CouncillorshipStatus->Visible) { // CouncillorshipStatus ?>
		<td data-name="CouncillorshipStatus" <?php echo $councillorship_history_list->CouncillorshipStatus->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_CouncillorshipStatus">
<span<?php echo $councillorship_history_list->CouncillorshipStatus->viewAttributes() ?>><?php echo $councillorship_history_list->CouncillorshipStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->ExitReason->Visible) { // ExitReason ?>
		<td data-name="ExitReason" <?php echo $councillorship_history_list->ExitReason->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_ExitReason">
<span<?php echo $councillorship_history_list->ExitReason->viewAttributes() ?>><?php echo $councillorship_history_list->ExitReason->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($councillorship_history_list->RetirementType->Visible) { // RetirementType ?>
		<td data-name="RetirementType" <?php echo $councillorship_history_list->RetirementType->cellAttributes() ?>>
<span id="el<?php echo $councillorship_history_list->RowCount ?>_councillorship_history_RetirementType">
<span<?php echo $councillorship_history_list->RetirementType->viewAttributes() ?>><?php echo $councillorship_history_list->RetirementType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$councillorship_history_list->ListOptions->render("body", "right", $councillorship_history_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$councillorship_history_list->isGridAdd())
		$councillorship_history_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$councillorship_history->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($councillorship_history_list->Recordset)
	$councillorship_history_list->Recordset->Close();
?>
<?php if (!$councillorship_history_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$councillorship_history_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $councillorship_history_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $councillorship_history_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($councillorship_history_list->TotalRecords == 0 && !$councillorship_history->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $councillorship_history_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$councillorship_history_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$councillorship_history_list->isExport()) { ?>
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
$councillorship_history_list->terminate();
?>