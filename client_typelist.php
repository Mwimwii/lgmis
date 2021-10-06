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
$client_type_list = new client_type_list();

// Run the page
$client_type_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$client_type_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$client_type_list->isExport()) { ?>
<script>
var fclient_typelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fclient_typelist = currentForm = new ew.Form("fclient_typelist", "list");
	fclient_typelist.formKeyCountName = '<?php echo $client_type_list->FormKeyCountName ?>';
	loadjs.done("fclient_typelist");
});
var fclient_typelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fclient_typelistsrch = currentSearchForm = new ew.Form("fclient_typelistsrch");

	// Dynamic selection lists
	// Filters

	fclient_typelistsrch.filterList = <?php echo $client_type_list->getFilterList() ?>;

	// Init search panel as collapsed
	fclient_typelistsrch.initSearchPanel = true;
	loadjs.done("fclient_typelistsrch");
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
<?php if (!$client_type_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($client_type_list->TotalRecords > 0 && $client_type_list->ExportOptions->visible()) { ?>
<?php $client_type_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($client_type_list->ImportOptions->visible()) { ?>
<?php $client_type_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($client_type_list->SearchOptions->visible()) { ?>
<?php $client_type_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($client_type_list->FilterOptions->visible()) { ?>
<?php $client_type_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$client_type_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$client_type_list->isExport() && !$client_type->CurrentAction) { ?>
<form name="fclient_typelistsrch" id="fclient_typelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fclient_typelistsrch-search-panel" class="<?php echo $client_type_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="client_type">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $client_type_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($client_type_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($client_type_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $client_type_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($client_type_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($client_type_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($client_type_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($client_type_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $client_type_list->showPageHeader(); ?>
<?php
$client_type_list->showMessage();
?>
<?php if ($client_type_list->TotalRecords > 0 || $client_type->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($client_type_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> client_type">
<?php if (!$client_type_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$client_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $client_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fclient_typelist" id="fclient_typelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="client_type">
<div id="gmp_client_type" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($client_type_list->TotalRecords > 0 || $client_type_list->isGridEdit()) { ?>
<table id="tbl_client_typelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$client_type->RowType = ROWTYPE_HEADER;

// Render list options
$client_type_list->renderListOptions();

// Render list options (header, left)
$client_type_list->ListOptions->render("header", "left");
?>
<?php if ($client_type_list->ClientType->Visible) { // ClientType ?>
	<?php if ($client_type_list->SortUrl($client_type_list->ClientType) == "") { ?>
		<th data-name="ClientType" class="<?php echo $client_type_list->ClientType->headerCellClass() ?>"><div id="elh_client_type_ClientType" class="client_type_ClientType"><div class="ew-table-header-caption"><?php echo $client_type_list->ClientType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientType" class="<?php echo $client_type_list->ClientType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_type_list->SortUrl($client_type_list->ClientType) ?>', 1);"><div id="elh_client_type_ClientType" class="client_type_ClientType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_type_list->ClientType->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_type_list->ClientType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_type_list->ClientType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_type_list->ClientTypeTypeDesc->Visible) { // ClientTypeTypeDesc ?>
	<?php if ($client_type_list->SortUrl($client_type_list->ClientTypeTypeDesc) == "") { ?>
		<th data-name="ClientTypeTypeDesc" class="<?php echo $client_type_list->ClientTypeTypeDesc->headerCellClass() ?>"><div id="elh_client_type_ClientTypeTypeDesc" class="client_type_ClientTypeTypeDesc"><div class="ew-table-header-caption"><?php echo $client_type_list->ClientTypeTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ClientTypeTypeDesc" class="<?php echo $client_type_list->ClientTypeTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_type_list->SortUrl($client_type_list->ClientTypeTypeDesc) ?>', 1);"><div id="elh_client_type_ClientTypeTypeDesc" class="client_type_ClientTypeTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_type_list->ClientTypeTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($client_type_list->ClientTypeTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_type_list->ClientTypeTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_type_list->IDType->Visible) { // IDType ?>
	<?php if ($client_type_list->SortUrl($client_type_list->IDType) == "") { ?>
		<th data-name="IDType" class="<?php echo $client_type_list->IDType->headerCellClass() ?>"><div id="elh_client_type_IDType" class="client_type_IDType"><div class="ew-table-header-caption"><?php echo $client_type_list->IDType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="IDType" class="<?php echo $client_type_list->IDType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_type_list->SortUrl($client_type_list->IDType) ?>', 1);"><div id="elh_client_type_IDType" class="client_type_IDType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_type_list->IDType->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_type_list->IDType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_type_list->IDType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($client_type_list->PrivilegeType->Visible) { // PrivilegeType ?>
	<?php if ($client_type_list->SortUrl($client_type_list->PrivilegeType) == "") { ?>
		<th data-name="PrivilegeType" class="<?php echo $client_type_list->PrivilegeType->headerCellClass() ?>"><div id="elh_client_type_PrivilegeType" class="client_type_PrivilegeType"><div class="ew-table-header-caption"><?php echo $client_type_list->PrivilegeType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="PrivilegeType" class="<?php echo $client_type_list->PrivilegeType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $client_type_list->SortUrl($client_type_list->PrivilegeType) ?>', 1);"><div id="elh_client_type_PrivilegeType" class="client_type_PrivilegeType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $client_type_list->PrivilegeType->caption() ?></span><span class="ew-table-header-sort"><?php if ($client_type_list->PrivilegeType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($client_type_list->PrivilegeType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$client_type_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($client_type_list->ExportAll && $client_type_list->isExport()) {
	$client_type_list->StopRecord = $client_type_list->TotalRecords;
} else {

	// Set the last record to display
	if ($client_type_list->TotalRecords > $client_type_list->StartRecord + $client_type_list->DisplayRecords - 1)
		$client_type_list->StopRecord = $client_type_list->StartRecord + $client_type_list->DisplayRecords - 1;
	else
		$client_type_list->StopRecord = $client_type_list->TotalRecords;
}
$client_type_list->RecordCount = $client_type_list->StartRecord - 1;
if ($client_type_list->Recordset && !$client_type_list->Recordset->EOF) {
	$client_type_list->Recordset->moveFirst();
	$selectLimit = $client_type_list->UseSelectLimit;
	if (!$selectLimit && $client_type_list->StartRecord > 1)
		$client_type_list->Recordset->move($client_type_list->StartRecord - 1);
} elseif (!$client_type->AllowAddDeleteRow && $client_type_list->StopRecord == 0) {
	$client_type_list->StopRecord = $client_type->GridAddRowCount;
}

// Initialize aggregate
$client_type->RowType = ROWTYPE_AGGREGATEINIT;
$client_type->resetAttributes();
$client_type_list->renderRow();
while ($client_type_list->RecordCount < $client_type_list->StopRecord) {
	$client_type_list->RecordCount++;
	if ($client_type_list->RecordCount >= $client_type_list->StartRecord) {
		$client_type_list->RowCount++;

		// Set up key count
		$client_type_list->KeyCount = $client_type_list->RowIndex;

		// Init row class and style
		$client_type->resetAttributes();
		$client_type->CssClass = "";
		if ($client_type_list->isGridAdd()) {
		} else {
			$client_type_list->loadRowValues($client_type_list->Recordset); // Load row values
		}
		$client_type->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$client_type->RowAttrs->merge(["data-rowindex" => $client_type_list->RowCount, "id" => "r" . $client_type_list->RowCount . "_client_type", "data-rowtype" => $client_type->RowType]);

		// Render row
		$client_type_list->renderRow();

		// Render list options
		$client_type_list->renderListOptions();
?>
	<tr <?php echo $client_type->rowAttributes() ?>>
<?php

// Render list options (body, left)
$client_type_list->ListOptions->render("body", "left", $client_type_list->RowCount);
?>
	<?php if ($client_type_list->ClientType->Visible) { // ClientType ?>
		<td data-name="ClientType" <?php echo $client_type_list->ClientType->cellAttributes() ?>>
<span id="el<?php echo $client_type_list->RowCount ?>_client_type_ClientType">
<span<?php echo $client_type_list->ClientType->viewAttributes() ?>><?php echo $client_type_list->ClientType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_type_list->ClientTypeTypeDesc->Visible) { // ClientTypeTypeDesc ?>
		<td data-name="ClientTypeTypeDesc" <?php echo $client_type_list->ClientTypeTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $client_type_list->RowCount ?>_client_type_ClientTypeTypeDesc">
<span<?php echo $client_type_list->ClientTypeTypeDesc->viewAttributes() ?>><?php echo $client_type_list->ClientTypeTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_type_list->IDType->Visible) { // IDType ?>
		<td data-name="IDType" <?php echo $client_type_list->IDType->cellAttributes() ?>>
<span id="el<?php echo $client_type_list->RowCount ?>_client_type_IDType">
<span<?php echo $client_type_list->IDType->viewAttributes() ?>><?php echo $client_type_list->IDType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($client_type_list->PrivilegeType->Visible) { // PrivilegeType ?>
		<td data-name="PrivilegeType" <?php echo $client_type_list->PrivilegeType->cellAttributes() ?>>
<span id="el<?php echo $client_type_list->RowCount ?>_client_type_PrivilegeType">
<span<?php echo $client_type_list->PrivilegeType->viewAttributes() ?>><?php echo $client_type_list->PrivilegeType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$client_type_list->ListOptions->render("body", "right", $client_type_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$client_type_list->isGridAdd())
		$client_type_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$client_type->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($client_type_list->Recordset)
	$client_type_list->Recordset->Close();
?>
<?php if (!$client_type_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$client_type_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $client_type_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $client_type_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($client_type_list->TotalRecords == 0 && !$client_type->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $client_type_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$client_type_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$client_type_list->isExport()) { ?>
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
$client_type_list->terminate();
?>