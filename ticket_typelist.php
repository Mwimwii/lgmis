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
$ticket_type_list = new ticket_type_list();

// Run the page
$ticket_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticket_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticket_type_list->isExport()) { ?>
<script>
var fticket_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fticket_typelist = currentForm = new ew.Form("fticket_typelist", "list");
	fticket_typelist.formKeyCountName = '<?php echo $ticket_type_list->FormKeyCountName ?>';
	loadjs.done("fticket_typelist");
});
var fticket_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fticket_typelistsrch = currentSearchForm = new ew.Form("fticket_typelistsrch");

	// Dynamic selection lists
	// Filters

	fticket_typelistsrch.filterList = <?php echo $ticket_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fticket_typelistsrch.initSearchPanel = true;
	loadjs.done("fticket_typelistsrch");
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
<?php if (!$ticket_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ticket_type_list->TotalRecords > 0 && $ticket_type_list->ExportOptions->visible()) { ?>
<?php $ticket_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_type_list->ImportOptions->visible()) { ?>
<?php $ticket_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_type_list->SearchOptions->visible()) { ?>
<?php $ticket_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ticket_type_list->FilterOptions->visible()) { ?>
<?php $ticket_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$ticket_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ticket_type_list->isExport() && !$ticket_type->CurrentAction) { ?>
<form name="fticket_typelistsrch" id="fticket_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fticket_typelistsrch-search-panel" class="<?php echo $ticket_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ticket_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ticket_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ticket_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ticket_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ticket_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ticket_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ticket_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ticket_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ticket_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ticket_type_list->showPageHeader(); ?>
<?php
$ticket_type_list->showMessage();
?>
<?php if ($ticket_type_list->TotalRecords > 0 || $ticket_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ticket_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ticket_type">
<?php if (!$ticket_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ticket_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticket_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fticket_typelist" id="fticket_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticket_type">
<div id="gmp_ticket_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ticket_type_list->TotalRecords > 0 || $ticket_type_list->isGridEdit()) { ?>
<table id="tbl_ticket_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ticket_type->RowType = ROWTYPE_HEADER;

// Render list options
$ticket_type_list->renderListOptions();

// Render list options (header, left)
$ticket_type_list->ListOptions->render("header", "left");
?>
<?php if ($ticket_type_list->TicketType->Visible) { // TicketType ?>
	<?php if ($ticket_type_list->SortUrl($ticket_type_list->TicketType) == "") { ?>
		<th data-name="TicketType" class="<?php echo $ticket_type_list->TicketType->headerCellClass() ?>"><div id="elh_ticket_type_TicketType" class="ticket_type_TicketType"><div class="ew-table-header-caption"><?php echo $ticket_type_list->TicketType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketType" class="<?php echo $ticket_type_list->TicketType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_type_list->SortUrl($ticket_type_list->TicketType) ?>', 1);"><div id="elh_ticket_type_TicketType" class="ticket_type_TicketType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_type_list->TicketType->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_type_list->TicketType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_type_list->TicketType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_type_list->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
	<?php if ($ticket_type_list->SortUrl($ticket_type_list->TicketTypeDesc) == "") { ?>
		<th data-name="TicketTypeDesc" class="<?php echo $ticket_type_list->TicketTypeDesc->headerCellClass() ?>"><div id="elh_ticket_type_TicketTypeDesc" class="ticket_type_TicketTypeDesc"><div class="ew-table-header-caption"><?php echo $ticket_type_list->TicketTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketTypeDesc" class="<?php echo $ticket_type_list->TicketTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_type_list->SortUrl($ticket_type_list->TicketTypeDesc) ?>', 1);"><div id="elh_ticket_type_TicketTypeDesc" class="ticket_type_TicketTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_type_list->TicketTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticket_type_list->TicketTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_type_list->TicketTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticket_type_list->TicketCategory->Visible) { // TicketCategory ?>
	<?php if ($ticket_type_list->SortUrl($ticket_type_list->TicketCategory) == "") { ?>
		<th data-name="TicketCategory" class="<?php echo $ticket_type_list->TicketCategory->headerCellClass() ?>"><div id="elh_ticket_type_TicketCategory" class="ticket_type_TicketCategory"><div class="ew-table-header-caption"><?php echo $ticket_type_list->TicketCategory->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketCategory" class="<?php echo $ticket_type_list->TicketCategory->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticket_type_list->SortUrl($ticket_type_list->TicketCategory) ?>', 1);"><div id="elh_ticket_type_TicketCategory" class="ticket_type_TicketCategory">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticket_type_list->TicketCategory->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticket_type_list->TicketCategory->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticket_type_list->TicketCategory->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticket_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ticket_type_list->ExportAll && $ticket_type_list->isExport()) {
	$ticket_type_list->StopRecord = $ticket_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ticket_type_list->TotalRecords > $ticket_type_list->StartRecord + $ticket_type_list->DisplayRecords - 1)
		$ticket_type_list->StopRecord = $ticket_type_list->StartRecord + $ticket_type_list->DisplayRecords - 1;
	else
		$ticket_type_list->StopRecord = $ticket_type_list->TotalRecords;
}
$ticket_type_list->RecordCount = $ticket_type_list->StartRecord - 1;
if ($ticket_type_list->Recordset && !$ticket_type_list->Recordset->EOF) {
	$ticket_type_list->Recordset->moveFirst();
	$selectLimit = $ticket_type_list->UseSelectLimit;
	if (!$selectLimit && $ticket_type_list->StartRecord > 1)
		$ticket_type_list->Recordset->move($ticket_type_list->StartRecord - 1);
} elseif (!$ticket_type->AllowAddDeleteRow && $ticket_type_list->StopRecord == 0) {
	$ticket_type_list->StopRecord = $ticket_type->GridAddRowCount;
}

// Initialize aggregate
$ticket_type->RowType = ROWTYPE_AGGREGATEINIT;
$ticket_type->resetAttributes();
$ticket_type_list->renderRow();
while ($ticket_type_list->RecordCount < $ticket_type_list->StopRecord) {
	$ticket_type_list->RecordCount++;
	if ($ticket_type_list->RecordCount >= $ticket_type_list->StartRecord) {
		$ticket_type_list->RowCount++;

		// Set up key count
		$ticket_type_list->KeyCount = $ticket_type_list->RowIndex;

		// Init row class and style
		$ticket_type->resetAttributes();
		$ticket_type->CssClass = "";
		if ($ticket_type_list->isGridAdd()) {
		} else {
			$ticket_type_list->loadRowValues($ticket_type_list->Recordset); // Load row values
		}
		$ticket_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ticket_type->RowAttrs->merge(["data-rowindex" => $ticket_type_list->RowCount, "id" => "r" . $ticket_type_list->RowCount . "_ticket_type", "data-rowtype" => $ticket_type->RowType]);

		// Render row
		$ticket_type_list->renderRow();

		// Render list options
		$ticket_type_list->renderListOptions();
?>
	<tr <?php echo $ticket_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticket_type_list->ListOptions->render("body", "left", $ticket_type_list->RowCount);
?>
	<?php if ($ticket_type_list->TicketType->Visible) { // TicketType ?>
		<td data-name="TicketType" <?php echo $ticket_type_list->TicketType->cellAttributes() ?>>
<span id="el<?php echo $ticket_type_list->RowCount ?>_ticket_type_TicketType">
<span<?php echo $ticket_type_list->TicketType->viewAttributes() ?>><?php echo $ticket_type_list->TicketType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_type_list->TicketTypeDesc->Visible) { // TicketTypeDesc ?>
		<td data-name="TicketTypeDesc" <?php echo $ticket_type_list->TicketTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $ticket_type_list->RowCount ?>_ticket_type_TicketTypeDesc">
<span<?php echo $ticket_type_list->TicketTypeDesc->viewAttributes() ?>><?php echo $ticket_type_list->TicketTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticket_type_list->TicketCategory->Visible) { // TicketCategory ?>
		<td data-name="TicketCategory" <?php echo $ticket_type_list->TicketCategory->cellAttributes() ?>>
<span id="el<?php echo $ticket_type_list->RowCount ?>_ticket_type_TicketCategory">
<span<?php echo $ticket_type_list->TicketCategory->viewAttributes() ?>><?php echo $ticket_type_list->TicketCategory->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticket_type_list->ListOptions->render("body", "right", $ticket_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ticket_type_list->isGridAdd())
		$ticket_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ticket_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticket_type_list->Recordset)
	$ticket_type_list->Recordset->Close();
?>
<?php if (!$ticket_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ticket_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticket_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticket_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ticket_type_list->TotalRecords == 0 && !$ticket_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticket_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ticket_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticket_type_list->isExport()) { ?>
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
$ticket_type_list->terminate();
?>