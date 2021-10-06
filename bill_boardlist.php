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
$bill_board_list = new bill_board_list();

// Run the page
$bill_board_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$bill_board_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$bill_board_list->isExport()) { ?>
<script>
var fbill_boardlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fbill_boardlist = currentForm = new ew.Form("fbill_boardlist", "list");
	fbill_boardlist.formKeyCountName = '<?php echo $bill_board_list->FormKeyCountName ?>';
	loadjs.done("fbill_boardlist");
});
var fbill_boardlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fbill_boardlistsrch = currentSearchForm = new ew.Form("fbill_boardlistsrch");

	// Dynamic selection lists
	// Filters

	fbill_boardlistsrch.filterList = <?php echo $bill_board_list->getFilterList() ?>;

	// Init search panel as collapsed
	fbill_boardlistsrch.initSearchPanel = true;
	loadjs.done("fbill_boardlistsrch");
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
<?php if (!$bill_board_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($bill_board_list->TotalRecords > 0 && $bill_board_list->ExportOptions->visible()) { ?>
<?php $bill_board_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($bill_board_list->ImportOptions->visible()) { ?>
<?php $bill_board_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($bill_board_list->SearchOptions->visible()) { ?>
<?php $bill_board_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($bill_board_list->FilterOptions->visible()) { ?>
<?php $bill_board_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$bill_board_list->isExport() || Config("EXPORT_MASTER_RECORD") && $bill_board_list->isExport("print")) { ?>
<?php
if ($bill_board_list->DbMasterFilter != "" && $bill_board->getCurrentMasterTable() == "client") {
	if ($bill_board_list->MasterRecordExists) {
		include_once "clientmaster.php";
	}
}
?>
<?php } ?>
<?php
$bill_board_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$bill_board_list->isExport() && !$bill_board->CurrentAction) { ?>
<form name="fbill_boardlistsrch" id="fbill_boardlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fbill_boardlistsrch-search-panel" class="<?php echo $bill_board_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="bill_board">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $bill_board_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($bill_board_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($bill_board_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $bill_board_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($bill_board_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($bill_board_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($bill_board_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($bill_board_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $bill_board_list->showPageHeader(); ?>
<?php
$bill_board_list->showMessage();
?>
<?php if ($bill_board_list->TotalRecords > 0 || $bill_board->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($bill_board_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> bill_board">
<?php if (!$bill_board_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$bill_board_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bill_board_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fbill_boardlist" id="fbill_boardlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="bill_board">
<?php if ($bill_board->getCurrentMasterTable() == "client" && $bill_board->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="client">
<input type="hidden" name="fk_ClientSerNo" value="<?php echo HtmlEncode($bill_board_list->ClientSerNo->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_bill_board" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($bill_board_list->TotalRecords > 0 || $bill_board_list->isGridEdit()) { ?>
<table id="tbl_bill_boardlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$bill_board->RowType = ROWTYPE_HEADER;

// Render list options
$bill_board_list->renderListOptions();

// Render list options (header, left)
$bill_board_list->ListOptions->render("header", "left");
?>
<?php if ($bill_board_list->BillBoardNo->Visible) { // BillBoardNo ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BillBoardNo) == "") { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_list->BillBoardNo->headerCellClass() ?>"><div id="elh_bill_board_BillBoardNo" class="bill_board_BillBoardNo"><div class="ew-table-header-caption"><?php echo $bill_board_list->BillBoardNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BillBoardNo" class="<?php echo $bill_board_list->BillBoardNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BillBoardNo) ?>', 1);"><div id="elh_bill_board_BillBoardNo" class="bill_board_BillBoardNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BillBoardNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BillBoardNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BillBoardNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardStandNo->Visible) { // BoardStandNo ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardStandNo) == "") { ?>
		<th data-name="BoardStandNo" class="<?php echo $bill_board_list->BoardStandNo->headerCellClass() ?>"><div id="elh_bill_board_BoardStandNo" class="bill_board_BoardStandNo"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardStandNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardStandNo" class="<?php echo $bill_board_list->BoardStandNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardStandNo) ?>', 1);"><div id="elh_bill_board_BoardStandNo" class="bill_board_BoardStandNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardStandNo->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardStandNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardStandNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->ClientSerNo->Visible) { // ClientSerNo ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->ClientSerNo) == "") { ?>
		<th data-name="ClientSerNo" class="<?php echo $bill_board_list->ClientSerNo->headerCellClass() ?>"><div id="elh_bill_board_ClientSerNo" class="bill_board_ClientSerNo"><div class="ew-table-header-caption"><?php echo $bill_board_list->ClientSerNo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientSerNo" class="<?php echo $bill_board_list->ClientSerNo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->ClientSerNo) ?>', 1);"><div id="elh_bill_board_ClientSerNo" class="bill_board_ClientSerNo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->ClientSerNo->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->ClientSerNo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->ClientSerNo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->ClientID->Visible) { // ClientID ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->ClientID) == "") { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_list->ClientID->headerCellClass() ?>"><div id="elh_bill_board_ClientID" class="bill_board_ClientID"><div class="ew-table-header-caption"><?php echo $bill_board_list->ClientID->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientID" class="<?php echo $bill_board_list->ClientID->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->ClientID) ?>', 1);"><div id="elh_bill_board_ClientID" class="bill_board_ClientID">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->ClientID->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->ClientID->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->ClientID->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardLength->Visible) { // BoardLength ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardLength) == "") { ?>
		<th data-name="BoardLength" class="<?php echo $bill_board_list->BoardLength->headerCellClass() ?>"><div id="elh_bill_board_BoardLength" class="bill_board_BoardLength"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardLength->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardLength" class="<?php echo $bill_board_list->BoardLength->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardLength) ?>', 1);"><div id="elh_bill_board_BoardLength" class="bill_board_BoardLength">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardLength->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardLength->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardLength->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardWidth->Visible) { // BoardWidth ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardWidth) == "") { ?>
		<th data-name="BoardWidth" class="<?php echo $bill_board_list->BoardWidth->headerCellClass() ?>"><div id="elh_bill_board_BoardWidth" class="bill_board_BoardWidth"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardWidth->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardWidth" class="<?php echo $bill_board_list->BoardWidth->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardWidth) ?>', 1);"><div id="elh_bill_board_BoardWidth" class="bill_board_BoardWidth">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardWidth->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardWidth->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardWidth->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardSize->Visible) { // BoardSize ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardSize) == "") { ?>
		<th data-name="BoardSize" class="<?php echo $bill_board_list->BoardSize->headerCellClass() ?>"><div id="elh_bill_board_BoardSize" class="bill_board_BoardSize"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardSize->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardSize" class="<?php echo $bill_board_list->BoardSize->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardSize) ?>', 1);"><div id="elh_bill_board_BoardSize" class="bill_board_BoardSize">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardSize->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardSize->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardSize->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardType->Visible) { // BoardType ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardType) == "") { ?>
		<th data-name="BoardType" class="<?php echo $bill_board_list->BoardType->headerCellClass() ?>"><div id="elh_bill_board_BoardType" class="bill_board_BoardType"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardType" class="<?php echo $bill_board_list->BoardType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardType) ?>', 1);"><div id="elh_bill_board_BoardType" class="bill_board_BoardType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardType->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardLocation->Visible) { // BoardLocation ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardLocation) == "") { ?>
		<th data-name="BoardLocation" class="<?php echo $bill_board_list->BoardLocation->headerCellClass() ?>"><div id="elh_bill_board_BoardLocation" class="bill_board_BoardLocation"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardLocation->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardLocation" class="<?php echo $bill_board_list->BoardLocation->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardLocation) ?>', 1);"><div id="elh_bill_board_BoardLocation" class="bill_board_BoardLocation">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardLocation->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardLocation->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardLocation->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->BoardStatus->Visible) { // BoardStatus ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->BoardStatus) == "") { ?>
		<th data-name="BoardStatus" class="<?php echo $bill_board_list->BoardStatus->headerCellClass() ?>"><div id="elh_bill_board_BoardStatus" class="bill_board_BoardStatus"><div class="ew-table-header-caption"><?php echo $bill_board_list->BoardStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="BoardStatus" class="<?php echo $bill_board_list->BoardStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->BoardStatus) ?>', 1);"><div id="elh_bill_board_BoardStatus" class="bill_board_BoardStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->BoardStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->BoardStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->BoardStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->ExemptCode->Visible) { // ExemptCode ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->ExemptCode) == "") { ?>
		<th data-name="ExemptCode" class="<?php echo $bill_board_list->ExemptCode->headerCellClass() ?>"><div id="elh_bill_board_ExemptCode" class="bill_board_ExemptCode"><div class="ew-table-header-caption"><?php echo $bill_board_list->ExemptCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExemptCode" class="<?php echo $bill_board_list->ExemptCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->ExemptCode) ?>', 1);"><div id="elh_bill_board_ExemptCode" class="bill_board_ExemptCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->ExemptCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->ExemptCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->ExemptCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->StreetAddress->Visible) { // StreetAddress ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->StreetAddress) == "") { ?>
		<th data-name="StreetAddress" class="<?php echo $bill_board_list->StreetAddress->headerCellClass() ?>"><div id="elh_bill_board_StreetAddress" class="bill_board_StreetAddress"><div class="ew-table-header-caption"><?php echo $bill_board_list->StreetAddress->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StreetAddress" class="<?php echo $bill_board_list->StreetAddress->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->StreetAddress) ?>', 1);"><div id="elh_bill_board_StreetAddress" class="bill_board_StreetAddress">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->StreetAddress->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->StreetAddress->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->StreetAddress->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->Longitude->Visible) { // Longitude ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->Longitude) == "") { ?>
		<th data-name="Longitude" class="<?php echo $bill_board_list->Longitude->headerCellClass() ?>"><div id="elh_bill_board_Longitude" class="bill_board_Longitude"><div class="ew-table-header-caption"><?php echo $bill_board_list->Longitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Longitude" class="<?php echo $bill_board_list->Longitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->Longitude) ?>', 1);"><div id="elh_bill_board_Longitude" class="bill_board_Longitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->Longitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->Longitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->Longitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->Latitude->Visible) { // Latitude ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->Latitude) == "") { ?>
		<th data-name="Latitude" class="<?php echo $bill_board_list->Latitude->headerCellClass() ?>"><div id="elh_bill_board_Latitude" class="bill_board_Latitude"><div class="ew-table-header-caption"><?php echo $bill_board_list->Latitude->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Latitude" class="<?php echo $bill_board_list->Latitude->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->Latitude) ?>', 1);"><div id="elh_bill_board_Latitude" class="bill_board_Latitude">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->Latitude->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->Latitude->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->Latitude->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->Incumberance->Visible) { // Incumberance ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->Incumberance) == "") { ?>
		<th data-name="Incumberance" class="<?php echo $bill_board_list->Incumberance->headerCellClass() ?>"><div id="elh_bill_board_Incumberance" class="bill_board_Incumberance"><div class="ew-table-header-caption"><?php echo $bill_board_list->Incumberance->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Incumberance" class="<?php echo $bill_board_list->Incumberance->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->Incumberance) ?>', 1);"><div id="elh_bill_board_Incumberance" class="bill_board_Incumberance">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->Incumberance->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->Incumberance->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->Incumberance->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->StartDate->Visible) { // StartDate ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->StartDate) == "") { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_list->StartDate->headerCellClass() ?>"><div id="elh_bill_board_StartDate" class="bill_board_StartDate"><div class="ew-table-header-caption"><?php echo $bill_board_list->StartDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StartDate" class="<?php echo $bill_board_list->StartDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->StartDate) ?>', 1);"><div id="elh_bill_board_StartDate" class="bill_board_StartDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->StartDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->StartDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->StartDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($bill_board_list->EndDate->Visible) { // EndDate ?>
	<?php if ($bill_board_list->SortUrl($bill_board_list->EndDate) == "") { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_list->EndDate->headerCellClass() ?>"><div id="elh_bill_board_EndDate" class="bill_board_EndDate"><div class="ew-table-header-caption"><?php echo $bill_board_list->EndDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EndDate" class="<?php echo $bill_board_list->EndDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $bill_board_list->SortUrl($bill_board_list->EndDate) ?>', 1);"><div id="elh_bill_board_EndDate" class="bill_board_EndDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $bill_board_list->EndDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($bill_board_list->EndDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($bill_board_list->EndDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$bill_board_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($bill_board_list->ExportAll && $bill_board_list->isExport()) {
	$bill_board_list->StopRecord = $bill_board_list->TotalRecords;
} else {

	// Set the last record to display
	if ($bill_board_list->TotalRecords > $bill_board_list->StartRecord + $bill_board_list->DisplayRecords - 1)
		$bill_board_list->StopRecord = $bill_board_list->StartRecord + $bill_board_list->DisplayRecords - 1;
	else
		$bill_board_list->StopRecord = $bill_board_list->TotalRecords;
}
$bill_board_list->RecordCount = $bill_board_list->StartRecord - 1;
if ($bill_board_list->Recordset && !$bill_board_list->Recordset->EOF) {
	$bill_board_list->Recordset->moveFirst();
	$selectLimit = $bill_board_list->UseSelectLimit;
	if (!$selectLimit && $bill_board_list->StartRecord > 1)
		$bill_board_list->Recordset->move($bill_board_list->StartRecord - 1);
} elseif (!$bill_board->AllowAddDeleteRow && $bill_board_list->StopRecord == 0) {
	$bill_board_list->StopRecord = $bill_board->GridAddRowCount;
}

// Initialize aggregate
$bill_board->RowType = ROWTYPE_AGGREGATEINIT;
$bill_board->resetAttributes();
$bill_board_list->renderRow();
while ($bill_board_list->RecordCount < $bill_board_list->StopRecord) {
	$bill_board_list->RecordCount++;
	if ($bill_board_list->RecordCount >= $bill_board_list->StartRecord) {
		$bill_board_list->RowCount++;

		// Set up key count
		$bill_board_list->KeyCount = $bill_board_list->RowIndex;

		// Init row class and style
		$bill_board->resetAttributes();
		$bill_board->CssClass = "";
		if ($bill_board_list->isGridAdd()) {
		} else {
			$bill_board_list->loadRowValues($bill_board_list->Recordset); // Load row values
		}
		$bill_board->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$bill_board->RowAttrs->merge(["data-rowindex" => $bill_board_list->RowCount, "id" => "r" . $bill_board_list->RowCount . "_bill_board", "data-rowtype" => $bill_board->RowType]);

		// Render row
		$bill_board_list->renderRow();

		// Render list options
		$bill_board_list->renderListOptions();
?>
	<tr <?php echo $bill_board->rowAttributes() ?>>
<?php

// Render list options (body, left)
$bill_board_list->ListOptions->render("body", "left", $bill_board_list->RowCount);
?>
	<?php if ($bill_board_list->BillBoardNo->Visible) { // BillBoardNo ?>
		<td data-name="BillBoardNo" <?php echo $bill_board_list->BillBoardNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BillBoardNo">
<span<?php echo $bill_board_list->BillBoardNo->viewAttributes() ?>><?php echo $bill_board_list->BillBoardNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardStandNo->Visible) { // BoardStandNo ?>
		<td data-name="BoardStandNo" <?php echo $bill_board_list->BoardStandNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardStandNo">
<span<?php echo $bill_board_list->BoardStandNo->viewAttributes() ?>><?php echo $bill_board_list->BoardStandNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->ClientSerNo->Visible) { // ClientSerNo ?>
		<td data-name="ClientSerNo" <?php echo $bill_board_list->ClientSerNo->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_ClientSerNo">
<span<?php echo $bill_board_list->ClientSerNo->viewAttributes() ?>><?php echo $bill_board_list->ClientSerNo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->ClientID->Visible) { // ClientID ?>
		<td data-name="ClientID" <?php echo $bill_board_list->ClientID->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_ClientID">
<span<?php echo $bill_board_list->ClientID->viewAttributes() ?>><?php echo $bill_board_list->ClientID->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardLength->Visible) { // BoardLength ?>
		<td data-name="BoardLength" <?php echo $bill_board_list->BoardLength->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardLength">
<span<?php echo $bill_board_list->BoardLength->viewAttributes() ?>><?php echo $bill_board_list->BoardLength->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardWidth->Visible) { // BoardWidth ?>
		<td data-name="BoardWidth" <?php echo $bill_board_list->BoardWidth->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardWidth">
<span<?php echo $bill_board_list->BoardWidth->viewAttributes() ?>><?php echo $bill_board_list->BoardWidth->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardSize->Visible) { // BoardSize ?>
		<td data-name="BoardSize" <?php echo $bill_board_list->BoardSize->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardSize">
<span<?php echo $bill_board_list->BoardSize->viewAttributes() ?>><?php echo $bill_board_list->BoardSize->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardType->Visible) { // BoardType ?>
		<td data-name="BoardType" <?php echo $bill_board_list->BoardType->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardType">
<span<?php echo $bill_board_list->BoardType->viewAttributes() ?>><?php echo $bill_board_list->BoardType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardLocation->Visible) { // BoardLocation ?>
		<td data-name="BoardLocation" <?php echo $bill_board_list->BoardLocation->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardLocation">
<span<?php echo $bill_board_list->BoardLocation->viewAttributes() ?>><?php echo $bill_board_list->BoardLocation->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->BoardStatus->Visible) { // BoardStatus ?>
		<td data-name="BoardStatus" <?php echo $bill_board_list->BoardStatus->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_BoardStatus">
<span<?php echo $bill_board_list->BoardStatus->viewAttributes() ?>><?php echo $bill_board_list->BoardStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->ExemptCode->Visible) { // ExemptCode ?>
		<td data-name="ExemptCode" <?php echo $bill_board_list->ExemptCode->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_ExemptCode">
<span<?php echo $bill_board_list->ExemptCode->viewAttributes() ?>><?php echo $bill_board_list->ExemptCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->StreetAddress->Visible) { // StreetAddress ?>
		<td data-name="StreetAddress" <?php echo $bill_board_list->StreetAddress->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_StreetAddress">
<span<?php echo $bill_board_list->StreetAddress->viewAttributes() ?>><?php echo $bill_board_list->StreetAddress->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->Longitude->Visible) { // Longitude ?>
		<td data-name="Longitude" <?php echo $bill_board_list->Longitude->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_Longitude">
<span<?php echo $bill_board_list->Longitude->viewAttributes() ?>><?php echo $bill_board_list->Longitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->Latitude->Visible) { // Latitude ?>
		<td data-name="Latitude" <?php echo $bill_board_list->Latitude->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_Latitude">
<span<?php echo $bill_board_list->Latitude->viewAttributes() ?>><?php echo $bill_board_list->Latitude->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->Incumberance->Visible) { // Incumberance ?>
		<td data-name="Incumberance" <?php echo $bill_board_list->Incumberance->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_Incumberance">
<span<?php echo $bill_board_list->Incumberance->viewAttributes() ?>><?php echo $bill_board_list->Incumberance->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->StartDate->Visible) { // StartDate ?>
		<td data-name="StartDate" <?php echo $bill_board_list->StartDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_StartDate">
<span<?php echo $bill_board_list->StartDate->viewAttributes() ?>><?php echo $bill_board_list->StartDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($bill_board_list->EndDate->Visible) { // EndDate ?>
		<td data-name="EndDate" <?php echo $bill_board_list->EndDate->cellAttributes() ?>>
<span id="el<?php echo $bill_board_list->RowCount ?>_bill_board_EndDate">
<span<?php echo $bill_board_list->EndDate->viewAttributes() ?>><?php echo $bill_board_list->EndDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$bill_board_list->ListOptions->render("body", "right", $bill_board_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$bill_board_list->isGridAdd())
		$bill_board_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$bill_board->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($bill_board_list->Recordset)
	$bill_board_list->Recordset->Close();
?>
<?php if (!$bill_board_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$bill_board_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $bill_board_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $bill_board_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($bill_board_list->TotalRecords == 0 && !$bill_board->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $bill_board_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$bill_board_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$bill_board_list->isExport()) { ?>
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
$bill_board_list->terminate();
?>