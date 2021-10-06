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
$ticket_status_list = new ticket_status_list();

// Run the page
$ticket_status_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_status_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_status_list->isExport()) { ?>
<script>
var fticket_statuslist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fticket_statuslist = currentForm = new ew.Form("fticket_statuslist", "list");
	fticket_statuslist.formKeyCountName = '<?php echo $ticket_status_list->FormKeyCountName ?>';
	loadjs.done("fticket_statuslist");
});
var fticket_statuslistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fticket_statuslistsrch = currentSearchForm = new ew.Form("fticket_statuslistsrch");

	// Dynamic selection lists
	// Filters

	fticket_statuslistsrch.filterList = <?php echo $ticket_status_list->getFilterList() ?>;

	// Init search panel as collapsed
	fticket_statuslistsrch.initSearchPanel = true;
	loadjs.done("fticket_statuslistsrch");
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
<?php if (!$ticket_status_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ticket_status_list->TotalRecords > 0 && $ticket_status_list->ExportOptions->visible()) { ?>
<?php $ticket_status_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_status_list->ImportOptions->visible()) { ?>
<?php $ticket_status_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_status_list->SearchOptions->visible()) { ?>
<?php $ticket_status_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_status_list->FilterOptions->visible()) { ?>
<?php $ticket_status_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ticket_status_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ticket_status_list->isExport() && !$ticket_status->CurrentAction) { ?>
<form name="fticket_statuslistsrch" id="fticket_statuslistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fticket_statuslistsrch-search-panel" class="<?php echo $ticket_status_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ticket_status">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ticket_status_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ticket_status_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ticket_status_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ticket_status_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ticket_status_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ticket_status_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ticket_status_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ticket_status_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ticket_status_list->showPageHeader(); ?>
<?php
$ticket_status_list->showMessage();
?>
<?php if ($ticket_status_list->TotalRecords > 0 || $ticket_status->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ticket_status_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ticket_status">
<?php if (!$ticket_status_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ticket_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticket_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fticket_statuslist" id="fticket_statuslist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_status">
<div id="gmp_ticket_status" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ticket_status_list->TotalRecords > 0 || $ticket_status_list->isGridEdit()) { ?>
<table id="tbl_ticket_statuslist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ticket_status->RowType = ROWTYPE_HEADER;

// Render list options
$ticket_status_list->renderListOptions();

// Render list options (header, left)
$ticket_status_list->ListOptions->render("header", "left");
?>
<?php if ($ticket_status_list->StatusCode->Visible) { // StatusCode ?>
	<?php if ($ticket_status_list->SortUrl($ticket_status_list->StatusCode) == "") { ?>
		<th data-name="StatusCode" class="<?php echo $ticket_status_list->StatusCode->headerCellClass() ?>"><div id="elh_ticket_status_StatusCode" class="ticket_status_StatusCode"><div class="ew-table-header-caption"><?php echo $ticket_status_list->StatusCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="StatusCode" class="<?php echo $ticket_status_list->StatusCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_status_list->SortUrl($ticket_status_list->StatusCode) ?>', 1);"><div id="elh_ticket_status_StatusCode" class="ticket_status_StatusCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_status_list->StatusCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_status_list->StatusCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_status_list->StatusCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_status_list->TicketStatus->Visible) { // TicketStatus ?>
	<?php if ($ticket_status_list->SortUrl($ticket_status_list->TicketStatus) == "") { ?>
		<th data-name="TicketStatus" class="<?php echo $ticket_status_list->TicketStatus->headerCellClass() ?>"><div id="elh_ticket_status_TicketStatus" class="ticket_status_TicketStatus"><div class="ew-table-header-caption"><?php echo $ticket_status_list->TicketStatus->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketStatus" class="<?php echo $ticket_status_list->TicketStatus->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_status_list->SortUrl($ticket_status_list->TicketStatus) ?>', 1);"><div id="elh_ticket_status_TicketStatus" class="ticket_status_TicketStatus">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_status_list->TicketStatus->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_status_list->TicketStatus->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_status_list->TicketStatus->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticket_status_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ticket_status_list->ExportAll && $ticket_status_list->isExport()) {
	$ticket_status_list->StopRecord = $ticket_status_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ticket_status_list->TotalRecords > $ticket_status_list->StartRecord + $ticket_status_list->DisplayRecords - 1)
		$ticket_status_list->StopRecord = $ticket_status_list->StartRecord + $ticket_status_list->DisplayRecords - 1;
	else
		$ticket_status_list->StopRecord = $ticket_status_list->TotalRecords;
}
$ticket_status_list->RecordCount = $ticket_status_list->StartRecord - 1;
if ($ticket_status_list->Recordset && !$ticket_status_list->Recordset->EOF) {
	$ticket_status_list->Recordset->moveFirst();
	$selectLimit = $ticket_status_list->UseSelectLimit;
	if (!$selectLimit && $ticket_status_list->StartRecord > 1)
		$ticket_status_list->Recordset->move($ticket_status_list->StartRecord - 1);
} elseif (!$ticket_status->AllowAddDeleteRow && $ticket_status_list->StopRecord == 0) {
	$ticket_status_list->StopRecord = $ticket_status->GridAddRowCount;
}

// Initialize aggregate
$ticket_status->RowType = ROWTYPE_AGGREGATEINIT;
$ticket_status->resetAttributes();
$ticket_status_list->renderRow();
while ($ticket_status_list->RecordCount < $ticket_status_list->StopRecord) {
	$ticket_status_list->RecordCount++;
	if ($ticket_status_list->RecordCount >= $ticket_status_list->StartRecord) {
		$ticket_status_list->RowCount++;

		// Set up key count
		$ticket_status_list->KeyCount = $ticket_status_list->RowIndex;

		// Init row class and style
		$ticket_status->resetAttributes();
		$ticket_status->CssClass = "";
		if ($ticket_status_list->isGridAdd()) {
		} else {
			$ticket_status_list->loadRowValues($ticket_status_list->Recordset); // Load row values
		}
		$ticket_status->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ticket_status->RowAttrs->merge(["data-rowindex" => $ticket_status_list->RowCount, "id" => "r" . $ticket_status_list->RowCount . "_ticket_status", "data-rowtype" => $ticket_status->RowType]);

		// Render row
		$ticket_status_list->renderRow();

		// Render list options
		$ticket_status_list->renderListOptions();
?>
	<tr <?php echo $ticket_status->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticket_status_list->ListOptions->render("body", "left", $ticket_status_list->RowCount);
?>
	<?php if ($ticket_status_list->StatusCode->Visible) { // StatusCode ?>
		<td data-name="StatusCode" <?php echo $ticket_status_list->StatusCode->cellAttributes() ?>>
<span id="el<?php echo $ticket_status_list->RowCount ?>_ticket_status_StatusCode">
<span<?php echo $ticket_status_list->StatusCode->viewAttributes() ?>><?php echo $ticket_status_list->StatusCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_status_list->TicketStatus->Visible) { // TicketStatus ?>
		<td data-name="TicketStatus" <?php echo $ticket_status_list->TicketStatus->cellAttributes() ?>>
<span id="el<?php echo $ticket_status_list->RowCount ?>_ticket_status_TicketStatus">
<span<?php echo $ticket_status_list->TicketStatus->viewAttributes() ?>><?php echo $ticket_status_list->TicketStatus->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticket_status_list->ListOptions->render("body", "right", $ticket_status_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ticket_status_list->isGridAdd())
		$ticket_status_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ticket_status->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticket_status_list->Recordset)
	$ticket_status_list->Recordset->Close();
?>
<?php if (!$ticket_status_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ticket_status_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_status_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticket_status_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ticket_status_list->TotalRecords == 0 && !$ticket_status->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticket_status_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ticket_status_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_status_list->isExport()) { ?>
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
$ticket_status_list->terminate();
?>