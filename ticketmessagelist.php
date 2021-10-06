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
$ticketmessage_list = new ticketmessage_list();

// Run the page
$ticketmessage_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$ticketmessage_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$ticketmessage_list->isExport()) { ?>
<script>
var fticketmessagelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fticketmessagelist = currentForm = new ew.Form("fticketmessagelist", "list");
	fticketmessagelist.formKeyCountName = '<?php echo $ticketmessage_list->FormKeyCountName ?>';
	loadjs.done("fticketmessagelist");
});
var fticketmessagelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fticketmessagelistsrch = currentSearchForm = new ew.Form("fticketmessagelistsrch");

	// Dynamic selection lists
	// Filters

	fticketmessagelistsrch.filterList = <?php echo $ticketmessage_list->getFilterList() ?>;

	// Init search panel as collapsed
	fticketmessagelistsrch.initSearchPanel = true;
	loadjs.done("fticketmessagelistsrch");
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
<?php if (!$ticketmessage_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($ticketmessage_list->TotalRecords > 0 && $ticketmessage_list->ExportOptions->visible()) { ?>
<?php $ticketmessage_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($ticketmessage_list->ImportOptions->visible()) { ?>
<?php $ticketmessage_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($ticketmessage_list->SearchOptions->visible()) { ?>
<?php $ticketmessage_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($ticketmessage_list->FilterOptions->visible()) { ?>
<?php $ticketmessage_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$ticketmessage_list->isExport() || Config("EXPORT_MASTER_RECORD") && $ticketmessage_list->isExport("print")) { ?>
<?php
if ($ticketmessage_list->DbMasterFilter != "" && $ticketmessage->getCurrentMasterTable() == "ticket") {
	if ($ticketmessage_list->MasterRecordExists) {
		include_once "ticketmaster.php";
	}
}
?>
<?php } ?>
<?php
$ticketmessage_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$ticketmessage_list->isExport() && !$ticketmessage->CurrentAction) { ?>
<form name="fticketmessagelistsrch" id="fticketmessagelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fticketmessagelistsrch-search-panel" class="<?php echo $ticketmessage_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="ticketmessage">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $ticketmessage_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($ticketmessage_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($ticketmessage_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $ticketmessage_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($ticketmessage_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($ticketmessage_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($ticketmessage_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($ticketmessage_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $ticketmessage_list->showPageHeader(); ?>
<?php
$ticketmessage_list->showMessage();
?>
<?php if ($ticketmessage_list->TotalRecords > 0 || $ticketmessage->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($ticketmessage_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> ticketmessage">
<?php if (!$ticketmessage_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$ticketmessage_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticketmessage_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticketmessage_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fticketmessagelist" id="fticketmessagelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="ticketmessage">
<?php if ($ticketmessage->getCurrentMasterTable() == "ticket" && $ticketmessage->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="ticket">
<input type="hidden" name="fk_TicketNumber" value="<?php echo HtmlEncode($ticketmessage_list->TicketNumber->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_ticketmessage" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($ticketmessage_list->TotalRecords > 0 || $ticketmessage_list->isGridEdit()) { ?>
<table id="tbl_ticketmessagelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$ticketmessage->RowType = ROWTYPE_HEADER;

// Render list options
$ticketmessage_list->renderListOptions();

// Render list options (header, left)
$ticketmessage_list->ListOptions->render("header", "left");
?>
<?php if ($ticketmessage_list->TicketNumber->Visible) { // TicketNumber ?>
	<?php if ($ticketmessage_list->SortUrl($ticketmessage_list->TicketNumber) == "") { ?>
		<th data-name="TicketNumber" class="<?php echo $ticketmessage_list->TicketNumber->headerCellClass() ?>"><div id="elh_ticketmessage_TicketNumber" class="ticketmessage_TicketNumber"><div class="ew-table-header-caption"><?php echo $ticketmessage_list->TicketNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="TicketNumber" class="<?php echo $ticketmessage_list->TicketNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticketmessage_list->SortUrl($ticketmessage_list->TicketNumber) ?>', 1);"><div id="elh_ticketmessage_TicketNumber" class="ticketmessage_TicketNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_list->TicketNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_list->TicketNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_list->TicketNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_list->MessageNumber->Visible) { // MessageNumber ?>
	<?php if ($ticketmessage_list->SortUrl($ticketmessage_list->MessageNumber) == "") { ?>
		<th data-name="MessageNumber" class="<?php echo $ticketmessage_list->MessageNumber->headerCellClass() ?>"><div id="elh_ticketmessage_MessageNumber" class="ticketmessage_MessageNumber"><div class="ew-table-header-caption"><?php echo $ticketmessage_list->MessageNumber->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MessageNumber" class="<?php echo $ticketmessage_list->MessageNumber->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticketmessage_list->SortUrl($ticketmessage_list->MessageNumber) ?>', 1);"><div id="elh_ticketmessage_MessageNumber" class="ticketmessage_MessageNumber">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_list->MessageNumber->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_list->MessageNumber->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_list->MessageNumber->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_list->MessageBy->Visible) { // MessageBy ?>
	<?php if ($ticketmessage_list->SortUrl($ticketmessage_list->MessageBy) == "") { ?>
		<th data-name="MessageBy" class="<?php echo $ticketmessage_list->MessageBy->headerCellClass() ?>"><div id="elh_ticketmessage_MessageBy" class="ticketmessage_MessageBy"><div class="ew-table-header-caption"><?php echo $ticketmessage_list->MessageBy->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MessageBy" class="<?php echo $ticketmessage_list->MessageBy->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticketmessage_list->SortUrl($ticketmessage_list->MessageBy) ?>', 1);"><div id="elh_ticketmessage_MessageBy" class="ticketmessage_MessageBy">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_list->MessageBy->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_list->MessageBy->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_list->MessageBy->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_list->Subject->Visible) { // Subject ?>
	<?php if ($ticketmessage_list->SortUrl($ticketmessage_list->Subject) == "") { ?>
		<th data-name="Subject" class="<?php echo $ticketmessage_list->Subject->headerCellClass() ?>"><div id="elh_ticketmessage_Subject" class="ticketmessage_Subject"><div class="ew-table-header-caption"><?php echo $ticketmessage_list->Subject->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Subject" class="<?php echo $ticketmessage_list->Subject->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticketmessage_list->SortUrl($ticketmessage_list->Subject) ?>', 1);"><div id="elh_ticketmessage_Subject" class="ticketmessage_Subject">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_list->Subject->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_list->Subject->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_list->Subject->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_list->Message->Visible) { // Message ?>
	<?php if ($ticketmessage_list->SortUrl($ticketmessage_list->Message) == "") { ?>
		<th data-name="Message" class="<?php echo $ticketmessage_list->Message->headerCellClass() ?>"><div id="elh_ticketmessage_Message" class="ticketmessage_Message"><div class="ew-table-header-caption"><?php echo $ticketmessage_list->Message->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Message" class="<?php echo $ticketmessage_list->Message->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticketmessage_list->SortUrl($ticketmessage_list->Message) ?>', 1);"><div id="elh_ticketmessage_Message" class="ticketmessage_Message">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_list->Message->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_list->Message->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_list->Message->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($ticketmessage_list->MessageDate->Visible) { // MessageDate ?>
	<?php if ($ticketmessage_list->SortUrl($ticketmessage_list->MessageDate) == "") { ?>
		<th data-name="MessageDate" class="<?php echo $ticketmessage_list->MessageDate->headerCellClass() ?>"><div id="elh_ticketmessage_MessageDate" class="ticketmessage_MessageDate"><div class="ew-table-header-caption"><?php echo $ticketmessage_list->MessageDate->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="MessageDate" class="<?php echo $ticketmessage_list->MessageDate->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $ticketmessage_list->SortUrl($ticketmessage_list->MessageDate) ?>', 1);"><div id="elh_ticketmessage_MessageDate" class="ticketmessage_MessageDate">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $ticketmessage_list->MessageDate->caption() ?></span><span class="ew-table-header-sort"><?php if ($ticketmessage_list->MessageDate->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($ticketmessage_list->MessageDate->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$ticketmessage_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($ticketmessage_list->ExportAll && $ticketmessage_list->isExport()) {
	$ticketmessage_list->StopRecord = $ticketmessage_list->TotalRecords;
} else {

	// Set the last record to display
	if ($ticketmessage_list->TotalRecords > $ticketmessage_list->StartRecord + $ticketmessage_list->DisplayRecords - 1)
		$ticketmessage_list->StopRecord = $ticketmessage_list->StartRecord + $ticketmessage_list->DisplayRecords - 1;
	else
		$ticketmessage_list->StopRecord = $ticketmessage_list->TotalRecords;
}
$ticketmessage_list->RecordCount = $ticketmessage_list->StartRecord - 1;
if ($ticketmessage_list->Recordset && !$ticketmessage_list->Recordset->EOF) {
	$ticketmessage_list->Recordset->moveFirst();
	$selectLimit = $ticketmessage_list->UseSelectLimit;
	if (!$selectLimit && $ticketmessage_list->StartRecord > 1)
		$ticketmessage_list->Recordset->move($ticketmessage_list->StartRecord - 1);
} elseif (!$ticketmessage->AllowAddDeleteRow && $ticketmessage_list->StopRecord == 0) {
	$ticketmessage_list->StopRecord = $ticketmessage->GridAddRowCount;
}

// Initialize aggregate
$ticketmessage->RowType = ROWTYPE_AGGREGATEINIT;
$ticketmessage->resetAttributes();
$ticketmessage_list->renderRow();
while ($ticketmessage_list->RecordCount < $ticketmessage_list->StopRecord) {
	$ticketmessage_list->RecordCount++;
	if ($ticketmessage_list->RecordCount >= $ticketmessage_list->StartRecord) {
		$ticketmessage_list->RowCount++;

		// Set up key count
		$ticketmessage_list->KeyCount = $ticketmessage_list->RowIndex;

		// Init row class and style
		$ticketmessage->resetAttributes();
		$ticketmessage->CssClass = "";
		if ($ticketmessage_list->isGridAdd()) {
		} else {
			$ticketmessage_list->loadRowValues($ticketmessage_list->Recordset); // Load row values
		}
		$ticketmessage->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$ticketmessage->RowAttrs->merge(["data-rowindex" => $ticketmessage_list->RowCount, "id" => "r" . $ticketmessage_list->RowCount . "_ticketmessage", "data-rowtype" => $ticketmessage->RowType]);

		// Render row
		$ticketmessage_list->renderRow();

		// Render list options
		$ticketmessage_list->renderListOptions();
?>
	<tr <?php echo $ticketmessage->rowAttributes() ?>>
<?php

// Render list options (body, left)
$ticketmessage_list->ListOptions->render("body", "left", $ticketmessage_list->RowCount);
?>
	<?php if ($ticketmessage_list->TicketNumber->Visible) { // TicketNumber ?>
		<td data-name="TicketNumber" <?php echo $ticketmessage_list->TicketNumber->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_list->RowCount ?>_ticketmessage_TicketNumber">
<span<?php echo $ticketmessage_list->TicketNumber->viewAttributes() ?>><?php echo $ticketmessage_list->TicketNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticketmessage_list->MessageNumber->Visible) { // MessageNumber ?>
		<td data-name="MessageNumber" <?php echo $ticketmessage_list->MessageNumber->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_list->RowCount ?>_ticketmessage_MessageNumber">
<span<?php echo $ticketmessage_list->MessageNumber->viewAttributes() ?>><?php echo $ticketmessage_list->MessageNumber->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticketmessage_list->MessageBy->Visible) { // MessageBy ?>
		<td data-name="MessageBy" <?php echo $ticketmessage_list->MessageBy->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_list->RowCount ?>_ticketmessage_MessageBy">
<span<?php echo $ticketmessage_list->MessageBy->viewAttributes() ?>><?php echo $ticketmessage_list->MessageBy->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticketmessage_list->Subject->Visible) { // Subject ?>
		<td data-name="Subject" <?php echo $ticketmessage_list->Subject->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_list->RowCount ?>_ticketmessage_Subject">
<span<?php echo $ticketmessage_list->Subject->viewAttributes() ?>><?php echo $ticketmessage_list->Subject->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticketmessage_list->Message->Visible) { // Message ?>
		<td data-name="Message" <?php echo $ticketmessage_list->Message->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_list->RowCount ?>_ticketmessage_Message">
<span<?php echo $ticketmessage_list->Message->viewAttributes() ?>><?php echo $ticketmessage_list->Message->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($ticketmessage_list->MessageDate->Visible) { // MessageDate ?>
		<td data-name="MessageDate" <?php echo $ticketmessage_list->MessageDate->cellAttributes() ?>>
<span id="el<?php echo $ticketmessage_list->RowCount ?>_ticketmessage_MessageDate">
<span<?php echo $ticketmessage_list->MessageDate->viewAttributes() ?>><?php echo $ticketmessage_list->MessageDate->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$ticketmessage_list->ListOptions->render("body", "right", $ticketmessage_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$ticketmessage_list->isGridAdd())
		$ticketmessage_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$ticketmessage->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($ticketmessage_list->Recordset)
	$ticketmessage_list->Recordset->Close();
?>
<?php if (!$ticketmessage_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$ticketmessage_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $ticketmessage_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $ticketmessage_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($ticketmessage_list->TotalRecords == 0 && !$ticketmessage->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $ticketmessage_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$ticketmessage_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$ticketmessage_list->isExport()) { ?>
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
$ticketmessage_list->terminate();
?>