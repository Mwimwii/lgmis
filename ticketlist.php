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
$ticket_list = new ticket_list();

// Run the page
$ticket_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_list->isExport()) { ?>
<script>
var fticketlist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fticketlist = currentForm = new ew.Form("fticketlist", "list");
	fticketlist.formKeyCountName = '<?php echo $ticket_list->FormKeyCountName ?>';
	loadjs.done("fticketlist");
});
var fticketlistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fticketlistsrch = currentSearchForm = new ew.Form("fticketlistsrch");

	// Dynamic selection lists
	// Filters

	fticketlistsrch.filterList = <?php echo $ticket_list->getFilterList() ?>;

	// Init search panel as collapsed
	fticketlistsrch.initSearchPanel = true;
	loadjs.done("fticketlistsrch");
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
<?php if (!$ticket_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ticket_list->TotalRecords > 0 && $ticket_list->ExportOptions->visible()) { ?>
<?php $ticket_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_list->ImportOptions->visible()) { ?>
<?php $ticket_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_list->SearchOptions->visible()) { ?>
<?php $ticket_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_list->FilterOptions->visible()) { ?>
<?php $ticket_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ticket_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ticket_list->isExport() && !$ticket->CurrentAction) { ?>
<form name="fticketlistsrch" id="fticketlistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fticketlistsrch-search-panel" class="<?php echo $ticket_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ticket">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ticket_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ticket_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ticket_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ticket_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ticket_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ticket_list->showPageHeader(); ?>
<?php
$ticket_list->showMessage();
?>
<?php if ($ticket_list->TotalRecords > 0 || $ticket->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ticket_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ticket">
<?php if (!$ticket_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ticket_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticket_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fticketlist" id="fticketlist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket">
<div id="gmp_ticket" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ticket_list->TotalRecords > 0 || $ticket_list->isGridEdit()) { ?>
<table id="tbl_ticketlist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ticket->RowType = ROWTYPE_HEADER;

// Render list options
$ticket_list->renderListOptions();

// Render list options (header, left)
$ticket_list->ListOptions->render("header", "left");
?>
<?php if ($ticket_list->Subject->Visible) { // Subject ?>
	<?php if ($ticket_list->SortUrl($ticket_list->Subject) == "") { ?>
		<th data-name="Subject" class="<?php echo $ticket_list->Subject->headerCellClass() ?>"><div id="elh_ticket_Subject" class="ticket_Subject"><div class="ew-table-header-caption"><?php echo $ticket_list->Subject->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Subject" class="<?php echo $ticket_list->Subject->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->Subject) ?>', 1);"><div id="elh_ticket_Subject" class="ticket_Subject">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->Subject->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->Subject->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->Subject->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketReportDate->Visible) { // TicketReportDate ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketReportDate) == "") { ?>
		<th data-name="TicketReportDate" class="<?php echo $ticket_list->TicketReportDate->headerCellClass() ?>"><div id="elh_ticket_TicketReportDate" class="ticket_TicketReportDate"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketReportDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketReportDate" class="<?php echo $ticket_list->TicketReportDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketReportDate) ?>', 1);"><div id="elh_ticket_TicketReportDate" class="ticket_TicketReportDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketReportDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketReportDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketReportDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->IncidentDate->Visible) { // IncidentDate ?>
	<?php if ($ticket_list->SortUrl($ticket_list->IncidentDate) == "") { ?>
		<th data-name="IncidentDate" class="<?php echo $ticket_list->IncidentDate->headerCellClass() ?>"><div id="elh_ticket_IncidentDate" class="ticket_IncidentDate"><div class="ew-table-header-caption"><?php echo $ticket_list->IncidentDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncidentDate" class="<?php echo $ticket_list->IncidentDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->IncidentDate) ?>', 1);"><div id="elh_ticket_IncidentDate" class="ticket_IncidentDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->IncidentDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->IncidentDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->IncidentDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->IncidentTime->Visible) { // IncidentTime ?>
	<?php if ($ticket_list->SortUrl($ticket_list->IncidentTime) == "") { ?>
		<th data-name="IncidentTime" class="<?php echo $ticket_list->IncidentTime->headerCellClass() ?>"><div id="elh_ticket_IncidentTime" class="ticket_IncidentTime"><div class="ew-table-header-caption"><?php echo $ticket_list->IncidentTime->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IncidentTime" class="<?php echo $ticket_list->IncidentTime->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->IncidentTime) ?>', 1);"><div id="elh_ticket_IncidentTime" class="ticket_IncidentTime">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->IncidentTime->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->IncidentTime->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->IncidentTime->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketCategory->Visible) { // TicketCategory ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketCategory) == "") { ?>
		<th data-name="TicketCategory" class="<?php echo $ticket_list->TicketCategory->headerCellClass() ?>"><div id="elh_ticket_TicketCategory" class="ticket_TicketCategory"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketCategory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketCategory" class="<?php echo $ticket_list->TicketCategory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketCategory) ?>', 1);"><div id="elh_ticket_TicketCategory" class="ticket_TicketCategory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketCategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketCategory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketCategory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketType->Visible) { // TicketType ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketType) == "") { ?>
		<th data-name="TicketType" class="<?php echo $ticket_list->TicketType->headerCellClass() ?>"><div id="elh_ticket_TicketType" class="ticket_TicketType"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketType" class="<?php echo $ticket_list->TicketType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketType) ?>', 1);"><div id="elh_ticket_TicketType" class="ticket_TicketType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketType->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->ReportedBy->Visible) { // ReportedBy ?>
	<?php if ($ticket_list->SortUrl($ticket_list->ReportedBy) == "") { ?>
		<th data-name="ReportedBy" class="<?php echo $ticket_list->ReportedBy->headerCellClass() ?>"><div id="elh_ticket_ReportedBy" class="ticket_ReportedBy"><div class="ew-table-header-caption"><?php echo $ticket_list->ReportedBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReportedBy" class="<?php echo $ticket_list->ReportedBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->ReportedBy) ?>', 1);"><div id="elh_ticket_ReportedBy" class="ticket_ReportedBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->ReportedBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->ReportedBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->ReportedBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketStatus->Visible) { // TicketStatus ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketStatus) == "") { ?>
		<th data-name="TicketStatus" class="<?php echo $ticket_list->TicketStatus->headerCellClass() ?>"><div id="elh_ticket_TicketStatus" class="ticket_TicketStatus"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketStatus" class="<?php echo $ticket_list->TicketStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketStatus) ?>', 1);"><div id="elh_ticket_TicketStatus" class="ticket_TicketStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketStatus->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketNumber->Visible) { // TicketNumber ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketNumber) == "") { ?>
		<th data-name="TicketNumber" class="<?php echo $ticket_list->TicketNumber->headerCellClass() ?>"><div id="elh_ticket_TicketNumber" class="ticket_TicketNumber"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketNumber" class="<?php echo $ticket_list->TicketNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketNumber) ?>', 1);"><div id="elh_ticket_TicketNumber" class="ticket_TicketNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->ReporterEmail->Visible) { // ReporterEmail ?>
	<?php if ($ticket_list->SortUrl($ticket_list->ReporterEmail) == "") { ?>
		<th data-name="ReporterEmail" class="<?php echo $ticket_list->ReporterEmail->headerCellClass() ?>"><div id="elh_ticket_ReporterEmail" class="ticket_ReporterEmail"><div class="ew-table-header-caption"><?php echo $ticket_list->ReporterEmail->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReporterEmail" class="<?php echo $ticket_list->ReporterEmail->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->ReporterEmail) ?>', 1);"><div id="elh_ticket_ReporterEmail" class="ticket_ReporterEmail">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->ReporterEmail->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->ReporterEmail->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->ReporterEmail->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->ReporterMobile->Visible) { // ReporterMobile ?>
	<?php if ($ticket_list->SortUrl($ticket_list->ReporterMobile) == "") { ?>
		<th data-name="ReporterMobile" class="<?php echo $ticket_list->ReporterMobile->headerCellClass() ?>"><div id="elh_ticket_ReporterMobile" class="ticket_ReporterMobile"><div class="ew-table-header-caption"><?php echo $ticket_list->ReporterMobile->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ReporterMobile" class="<?php echo $ticket_list->ReporterMobile->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->ReporterMobile) ?>', 1);"><div id="elh_ticket_ReporterMobile" class="ticket_ReporterMobile">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->ReporterMobile->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->ReporterMobile->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->ReporterMobile->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($ticket_list->SortUrl($ticket_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $ticket_list->ProvinceCode->headerCellClass() ?>"><div id="elh_ticket_ProvinceCode" class="ticket_ProvinceCode"><div class="ew-table-header-caption"><?php echo $ticket_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $ticket_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->ProvinceCode) ?>', 1);"><div id="elh_ticket_ProvinceCode" class="ticket_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->LACode->Visible) { // LACode ?>
	<?php if ($ticket_list->SortUrl($ticket_list->LACode) == "") { ?>
		<th data-name="LACode" class="<?php echo $ticket_list->LACode->headerCellClass() ?>"><div id="elh_ticket_LACode" class="ticket_LACode"><div class="ew-table-header-caption"><?php echo $ticket_list->LACode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LACode" class="<?php echo $ticket_list->LACode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->LACode) ?>', 1);"><div id="elh_ticket_LACode" class="ticket_LACode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->LACode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->LACode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->LACode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->DepartmentCode->Visible) { // DepartmentCode ?>
	<?php if ($ticket_list->SortUrl($ticket_list->DepartmentCode) == "") { ?>
		<th data-name="DepartmentCode" class="<?php echo $ticket_list->DepartmentCode->headerCellClass() ?>"><div id="elh_ticket_DepartmentCode" class="ticket_DepartmentCode"><div class="ew-table-header-caption"><?php echo $ticket_list->DepartmentCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DepartmentCode" class="<?php echo $ticket_list->DepartmentCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->DepartmentCode) ?>', 1);"><div id="elh_ticket_DepartmentCode" class="ticket_DepartmentCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->DepartmentCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->DepartmentCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->DepartmentCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->DeptSection->Visible) { // DeptSection ?>
	<?php if ($ticket_list->SortUrl($ticket_list->DeptSection) == "") { ?>
		<th data-name="DeptSection" class="<?php echo $ticket_list->DeptSection->headerCellClass() ?>"><div id="elh_ticket_DeptSection" class="ticket_DeptSection"><div class="ew-table-header-caption"><?php echo $ticket_list->DeptSection->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DeptSection" class="<?php echo $ticket_list->DeptSection->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->DeptSection) ?>', 1);"><div id="elh_ticket_DeptSection" class="ticket_DeptSection">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->DeptSection->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->DeptSection->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->DeptSection->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketLevel->Visible) { // TicketLevel ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketLevel) == "") { ?>
		<th data-name="TicketLevel" class="<?php echo $ticket_list->TicketLevel->headerCellClass() ?>"><div id="elh_ticket_TicketLevel" class="ticket_TicketLevel"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketLevel" class="<?php echo $ticket_list->TicketLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketLevel) ?>', 1);"><div id="elh_ticket_TicketLevel" class="ticket_TicketLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->AllocatedTo->Visible) { // AllocatedTo ?>
	<?php if ($ticket_list->SortUrl($ticket_list->AllocatedTo) == "") { ?>
		<th data-name="AllocatedTo" class="<?php echo $ticket_list->AllocatedTo->headerCellClass() ?>"><div id="elh_ticket_AllocatedTo" class="ticket_AllocatedTo"><div class="ew-table-header-caption"><?php echo $ticket_list->AllocatedTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="AllocatedTo" class="<?php echo $ticket_list->AllocatedTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->AllocatedTo) ?>', 1);"><div id="elh_ticket_AllocatedTo" class="ticket_AllocatedTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->AllocatedTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->AllocatedTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->AllocatedTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->EscalatedTo->Visible) { // EscalatedTo ?>
	<?php if ($ticket_list->SortUrl($ticket_list->EscalatedTo) == "") { ?>
		<th data-name="EscalatedTo" class="<?php echo $ticket_list->EscalatedTo->headerCellClass() ?>"><div id="elh_ticket_EscalatedTo" class="ticket_EscalatedTo"><div class="ew-table-header-caption"><?php echo $ticket_list->EscalatedTo->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="EscalatedTo" class="<?php echo $ticket_list->EscalatedTo->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->EscalatedTo) ?>', 1);"><div id="elh_ticket_EscalatedTo" class="ticket_EscalatedTo">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->EscalatedTo->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->EscalatedTo->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->EscalatedTo->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->TicketSolution->Visible) { // TicketSolution ?>
	<?php if ($ticket_list->SortUrl($ticket_list->TicketSolution) == "") { ?>
		<th data-name="TicketSolution" class="<?php echo $ticket_list->TicketSolution->headerCellClass() ?>"><div id="elh_ticket_TicketSolution" class="ticket_TicketSolution"><div class="ew-table-header-caption"><?php echo $ticket_list->TicketSolution->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketSolution" class="<?php echo $ticket_list->TicketSolution->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->TicketSolution) ?>', 1);"><div id="elh_ticket_TicketSolution" class="ticket_TicketSolution">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->TicketSolution->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->TicketSolution->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->TicketSolution->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->SeverityLevel->Visible) { // SeverityLevel ?>
	<?php if ($ticket_list->SortUrl($ticket_list->SeverityLevel) == "") { ?>
		<th data-name="SeverityLevel" class="<?php echo $ticket_list->SeverityLevel->headerCellClass() ?>"><div id="elh_ticket_SeverityLevel" class="ticket_SeverityLevel"><div class="ew-table-header-caption"><?php echo $ticket_list->SeverityLevel->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SeverityLevel" class="<?php echo $ticket_list->SeverityLevel->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->SeverityLevel) ?>', 1);"><div id="elh_ticket_SeverityLevel" class="ticket_SeverityLevel">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->SeverityLevel->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->SeverityLevel->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->SeverityLevel->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->Days->Visible) { // Days ?>
	<?php if ($ticket_list->SortUrl($ticket_list->Days) == "") { ?>
		<th data-name="Days" class="<?php echo $ticket_list->Days->headerCellClass() ?>"><div id="elh_ticket_Days" class="ticket_Days"><div class="ew-table-header-caption"><?php echo $ticket_list->Days->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Days" class="<?php echo $ticket_list->Days->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->Days) ?>', 1);"><div id="elh_ticket_Days" class="ticket_Days">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->Days->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->Days->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->Days->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_list->DataLastUpdated->Visible) { // DataLastUpdated ?>
	<?php if ($ticket_list->SortUrl($ticket_list->DataLastUpdated) == "") { ?>
		<th data-name="DataLastUpdated" class="<?php echo $ticket_list->DataLastUpdated->headerCellClass() ?>"><div id="elh_ticket_DataLastUpdated" class="ticket_DataLastUpdated"><div class="ew-table-header-caption"><?php echo $ticket_list->DataLastUpdated->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="DataLastUpdated" class="<?php echo $ticket_list->DataLastUpdated->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_list->SortUrl($ticket_list->DataLastUpdated) ?>', 1);"><div id="elh_ticket_DataLastUpdated" class="ticket_DataLastUpdated">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_list->DataLastUpdated->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_list->DataLastUpdated->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_list->DataLastUpdated->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticket_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ticket_list->ExportAll && $ticket_list->isExport()) {
	$ticket_list->StopRecord = $ticket_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ticket_list->TotalRecords > $ticket_list->StartRecord + $ticket_list->DisplayRecords - 1)
		$ticket_list->StopRecord = $ticket_list->StartRecord + $ticket_list->DisplayRecords - 1;
	else
		$ticket_list->StopRecord = $ticket_list->TotalRecords;
}
$ticket_list->RecordCount = $ticket_list->StartRecord - 1;
if ($ticket_list->Recordset && !$ticket_list->Recordset->EOF) {
	$ticket_list->Recordset->moveFirst();
	$selectLimit = $ticket_list->UseSelectLimit;
	if (!$selectLimit && $ticket_list->StartRecord > 1)
		$ticket_list->Recordset->move($ticket_list->StartRecord - 1);
} elseif (!$ticket->AllowAddDeleteRow && $ticket_list->StopRecord == 0) {
	$ticket_list->StopRecord = $ticket->GridAddRowCount;
}

// Initialize aggregate
$ticket->RowType = ROWTYPE_AGGREGATEINIT;
$ticket->resetAttributes();
$ticket_list->renderRow();
while ($ticket_list->RecordCount < $ticket_list->StopRecord) {
	$ticket_list->RecordCount++;
	if ($ticket_list->RecordCount >= $ticket_list->StartRecord) {
		$ticket_list->RowCount++;

		// Set up key count
		$ticket_list->KeyCount = $ticket_list->RowIndex;

		// Init row class and style
		$ticket->resetAttributes();
		$ticket->CssClass = "";
		if ($ticket_list->isGridAdd()) {
		} else {
			$ticket_list->loadRowValues($ticket_list->Recordset); // Load row values
		}
		$ticket->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ticket->RowAttrs->merge(["data-rowindex" => $ticket_list->RowCount, "id" => "r" . $ticket_list->RowCount . "_ticket", "data-rowtype" => $ticket->RowType]);

		// Render row
		$ticket_list->renderRow();

		// Render list options
		$ticket_list->renderListOptions();
?>
	<tr <?php echo $ticket->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticket_list->ListOptions->render("body", "left", $ticket_list->RowCount);
?>
	<?php if ($ticket_list->Subject->Visible) { // Subject ?>
		<td data-name="Subject" <?php echo $ticket_list->Subject->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_Subject">
<span<?php echo $ticket_list->Subject->viewAttributes() ?>><?php echo $ticket_list->Subject->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketReportDate->Visible) { // TicketReportDate ?>
		<td data-name="TicketReportDate" <?php echo $ticket_list->TicketReportDate->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketReportDate">
<span<?php echo $ticket_list->TicketReportDate->viewAttributes() ?>><?php echo $ticket_list->TicketReportDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->IncidentDate->Visible) { // IncidentDate ?>
		<td data-name="IncidentDate" <?php echo $ticket_list->IncidentDate->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_IncidentDate">
<span<?php echo $ticket_list->IncidentDate->viewAttributes() ?>><?php echo $ticket_list->IncidentDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->IncidentTime->Visible) { // IncidentTime ?>
		<td data-name="IncidentTime" <?php echo $ticket_list->IncidentTime->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_IncidentTime">
<span<?php echo $ticket_list->IncidentTime->viewAttributes() ?>><?php echo $ticket_list->IncidentTime->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketCategory->Visible) { // TicketCategory ?>
		<td data-name="TicketCategory" <?php echo $ticket_list->TicketCategory->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketCategory">
<span<?php echo $ticket_list->TicketCategory->viewAttributes() ?>><?php echo $ticket_list->TicketCategory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketType->Visible) { // TicketType ?>
		<td data-name="TicketType" <?php echo $ticket_list->TicketType->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketType">
<span<?php echo $ticket_list->TicketType->viewAttributes() ?>><?php echo $ticket_list->TicketType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->ReportedBy->Visible) { // ReportedBy ?>
		<td data-name="ReportedBy" <?php echo $ticket_list->ReportedBy->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_ReportedBy">
<span<?php echo $ticket_list->ReportedBy->viewAttributes() ?>><?php echo $ticket_list->ReportedBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketStatus->Visible) { // TicketStatus ?>
		<td data-name="TicketStatus" <?php echo $ticket_list->TicketStatus->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketStatus">
<span<?php echo $ticket_list->TicketStatus->viewAttributes() ?>><?php echo $ticket_list->TicketStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketNumber->Visible) { // TicketNumber ?>
		<td data-name="TicketNumber" <?php echo $ticket_list->TicketNumber->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketNumber">
<span<?php echo $ticket_list->TicketNumber->viewAttributes() ?>><?php echo $ticket_list->TicketNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->ReporterEmail->Visible) { // ReporterEmail ?>
		<td data-name="ReporterEmail" <?php echo $ticket_list->ReporterEmail->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_ReporterEmail">
<span<?php echo $ticket_list->ReporterEmail->viewAttributes() ?>><?php echo $ticket_list->ReporterEmail->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->ReporterMobile->Visible) { // ReporterMobile ?>
		<td data-name="ReporterMobile" <?php echo $ticket_list->ReporterMobile->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_ReporterMobile">
<span<?php echo $ticket_list->ReporterMobile->viewAttributes() ?>><?php echo $ticket_list->ReporterMobile->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $ticket_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_ProvinceCode">
<span<?php echo $ticket_list->ProvinceCode->viewAttributes() ?>><?php echo $ticket_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->LACode->Visible) { // LACode ?>
		<td data-name="LACode" <?php echo $ticket_list->LACode->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_LACode">
<span<?php echo $ticket_list->LACode->viewAttributes() ?>><?php echo $ticket_list->LACode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->DepartmentCode->Visible) { // DepartmentCode ?>
		<td data-name="DepartmentCode" <?php echo $ticket_list->DepartmentCode->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_DepartmentCode">
<span<?php echo $ticket_list->DepartmentCode->viewAttributes() ?>><?php echo $ticket_list->DepartmentCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->DeptSection->Visible) { // DeptSection ?>
		<td data-name="DeptSection" <?php echo $ticket_list->DeptSection->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_DeptSection">
<span<?php echo $ticket_list->DeptSection->viewAttributes() ?>><?php echo $ticket_list->DeptSection->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketLevel->Visible) { // TicketLevel ?>
		<td data-name="TicketLevel" <?php echo $ticket_list->TicketLevel->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketLevel">
<span<?php echo $ticket_list->TicketLevel->viewAttributes() ?>><?php echo $ticket_list->TicketLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->AllocatedTo->Visible) { // AllocatedTo ?>
		<td data-name="AllocatedTo" <?php echo $ticket_list->AllocatedTo->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_AllocatedTo">
<span<?php echo $ticket_list->AllocatedTo->viewAttributes() ?>><?php echo $ticket_list->AllocatedTo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->EscalatedTo->Visible) { // EscalatedTo ?>
		<td data-name="EscalatedTo" <?php echo $ticket_list->EscalatedTo->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_EscalatedTo">
<span<?php echo $ticket_list->EscalatedTo->viewAttributes() ?>><?php echo $ticket_list->EscalatedTo->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->TicketSolution->Visible) { // TicketSolution ?>
		<td data-name="TicketSolution" <?php echo $ticket_list->TicketSolution->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_TicketSolution">
<span<?php echo $ticket_list->TicketSolution->viewAttributes() ?>><?php echo $ticket_list->TicketSolution->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->SeverityLevel->Visible) { // SeverityLevel ?>
		<td data-name="SeverityLevel" <?php echo $ticket_list->SeverityLevel->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_SeverityLevel">
<span<?php echo $ticket_list->SeverityLevel->viewAttributes() ?>><?php echo $ticket_list->SeverityLevel->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->Days->Visible) { // Days ?>
		<td data-name="Days" <?php echo $ticket_list->Days->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_Days">
<span<?php echo $ticket_list->Days->viewAttributes() ?>><?php echo $ticket_list->Days->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_list->DataLastUpdated->Visible) { // DataLastUpdated ?>
		<td data-name="DataLastUpdated" <?php echo $ticket_list->DataLastUpdated->cellAttributes() ?>>
<span id="el<?php echo $ticket_list->RowCount ?>_ticket_DataLastUpdated">
<span<?php echo $ticket_list->DataLastUpdated->viewAttributes() ?>><?php echo $ticket_list->DataLastUpdated->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticket_list->ListOptions->render("body", "right", $ticket_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ticket_list->isGridAdd())
		$ticket_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ticket->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticket_list->Recordset)
	$ticket_list->Recordset->Close();
?>
<?php if (!$ticket_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ticket_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticket_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ticket_list->TotalRecords == 0 && !$ticket->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticket_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ticket_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_list->isExport()) { ?>
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
$ticket_list->terminate();
?>