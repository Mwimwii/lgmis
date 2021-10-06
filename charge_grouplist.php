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
$charge_group_list = new charge_group_list();

// Run the page
$charge_group_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$charge_group_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$charge_group_list->isExport()) { ?>
<script>
var fcharge_grouplist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fcharge_grouplist = currentForm = new ew.Form("fcharge_grouplist", "list");
	fcharge_grouplist.formKeyCountName = '<?php echo $charge_group_list->FormKeyCountName ?>';
	loadjs.done("fcharge_grouplist");
});
var fcharge_grouplistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fcharge_grouplistsrch = currentSearchForm = new ew.Form("fcharge_grouplistsrch");

	// Dynamic selection lists
	// Filters

	fcharge_grouplistsrch.filterList = <?php echo $charge_group_list->getFilterList() ?>;

	// Init search panel as collapsed
	fcharge_grouplistsrch.initSearchPanel = true;
	loadjs.done("fcharge_grouplistsrch");
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
<?php if (!$charge_group_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($charge_group_list->TotalRecords > 0 && $charge_group_list->ExportOptions->visible()) { ?>
<?php $charge_group_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($charge_group_list->ImportOptions->visible()) { ?>
<?php $charge_group_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($charge_group_list->SearchOptions->visible()) { ?>
<?php $charge_group_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($charge_group_list->FilterOptions->visible()) { ?>
<?php $charge_group_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$charge_group_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$charge_group_list->isExport() && !$charge_group->CurrentAction) { ?>
<form name="fcharge_grouplistsrch" id="fcharge_grouplistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fcharge_grouplistsrch-search-panel" class="<?php echo $charge_group_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="charge_group">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $charge_group_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($charge_group_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($charge_group_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $charge_group_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($charge_group_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $charge_group_list->showPageHeader(); ?>
<?php
$charge_group_list->showMessage();
?>
<?php if ($charge_group_list->TotalRecords > 0 || $charge_group->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($charge_group_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> charge_group">
<?php if (!$charge_group_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$charge_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charge_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fcharge_grouplist" id="fcharge_grouplist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="charge_group">
<div id="gmp_charge_group" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($charge_group_list->TotalRecords > 0 || $charge_group_list->isGridEdit()) { ?>
<table id="tbl_charge_grouplist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$charge_group->RowType = ROWTYPE_HEADER;

// Render list options
$charge_group_list->renderListOptions();

// Render list options (header, left)
$charge_group_list->ListOptions->render("header", "left");
?>
<?php if ($charge_group_list->ChargeGroup->Visible) { // ChargeGroup ?>
	<?php if ($charge_group_list->SortUrl($charge_group_list->ChargeGroup) == "") { ?>
		<th data-name="ChargeGroup" class="<?php echo $charge_group_list->ChargeGroup->headerCellClass() ?>"><div id="elh_charge_group_ChargeGroup" class="charge_group_ChargeGroup"><div class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroup->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroup" class="<?php echo $charge_group_list->ChargeGroup->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_group_list->SortUrl($charge_group_list->ChargeGroup) ?>', 1);"><div id="elh_charge_group_ChargeGroup" class="charge_group_ChargeGroup">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroup->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_group_list->ChargeGroup->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_group_list->ChargeGroup->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_group_list->ChargeGroupDesc->Visible) { // ChargeGroupDesc ?>
	<?php if ($charge_group_list->SortUrl($charge_group_list->ChargeGroupDesc) == "") { ?>
		<th data-name="ChargeGroupDesc" class="<?php echo $charge_group_list->ChargeGroupDesc->headerCellClass() ?>"><div id="elh_charge_group_ChargeGroupDesc" class="charge_group_ChargeGroupDesc"><div class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroupDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ChargeGroupDesc" class="<?php echo $charge_group_list->ChargeGroupDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_group_list->SortUrl($charge_group_list->ChargeGroupDesc) ?>', 1);"><div id="elh_charge_group_ChargeGroupDesc" class="charge_group_ChargeGroupDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_group_list->ChargeGroupDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($charge_group_list->ChargeGroupDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_group_list->ChargeGroupDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_group_list->Charges->Visible) { // Charges ?>
	<?php if ($charge_group_list->SortUrl($charge_group_list->Charges) == "") { ?>
		<th data-name="Charges" class="<?php echo $charge_group_list->Charges->headerCellClass() ?>"><div id="elh_charge_group_Charges" class="charge_group_Charges"><div class="ew-table-header-caption"><?php echo $charge_group_list->Charges->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Charges" class="<?php echo $charge_group_list->Charges->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_group_list->SortUrl($charge_group_list->Charges) ?>', 1);"><div id="elh_charge_group_Charges" class="charge_group_Charges">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_group_list->Charges->caption() ?></span><span class="ew-table-header-sort"><?php if ($charge_group_list->Charges->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_group_list->Charges->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($charge_group_list->Account->Visible) { // Account ?>
	<?php if ($charge_group_list->SortUrl($charge_group_list->Account) == "") { ?>
		<th data-name="Account" class="<?php echo $charge_group_list->Account->headerCellClass() ?>"><div id="elh_charge_group_Account" class="charge_group_Account"><div class="ew-table-header-caption"><?php echo $charge_group_list->Account->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Account" class="<?php echo $charge_group_list->Account->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $charge_group_list->SortUrl($charge_group_list->Account) ?>', 1);"><div id="elh_charge_group_Account" class="charge_group_Account">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $charge_group_list->Account->caption() ?></span><span class="ew-table-header-sort"><?php if ($charge_group_list->Account->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($charge_group_list->Account->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$charge_group_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($charge_group_list->ExportAll && $charge_group_list->isExport()) {
	$charge_group_list->StopRecord = $charge_group_list->TotalRecords;
} else {

	// Set the last record to display
	if ($charge_group_list->TotalRecords > $charge_group_list->StartRecord + $charge_group_list->DisplayRecords - 1)
		$charge_group_list->StopRecord = $charge_group_list->StartRecord + $charge_group_list->DisplayRecords - 1;
	else
		$charge_group_list->StopRecord = $charge_group_list->TotalRecords;
}
$charge_group_list->RecordCount = $charge_group_list->StartRecord - 1;
if ($charge_group_list->Recordset && !$charge_group_list->Recordset->EOF) {
	$charge_group_list->Recordset->moveFirst();
	$selectLimit = $charge_group_list->UseSelectLimit;
	if (!$selectLimit && $charge_group_list->StartRecord > 1)
		$charge_group_list->Recordset->move($charge_group_list->StartRecord - 1);
} elseif (!$charge_group->AllowAddDeleteRow && $charge_group_list->StopRecord == 0) {
	$charge_group_list->StopRecord = $charge_group->GridAddRowCount;
}

// Initialize aggregate
$charge_group->RowType = ROWTYPE_AGGREGATEINIT;
$charge_group->resetAttributes();
$charge_group_list->renderRow();
while ($charge_group_list->RecordCount < $charge_group_list->StopRecord) {
	$charge_group_list->RecordCount++;
	if ($charge_group_list->RecordCount >= $charge_group_list->StartRecord) {
		$charge_group_list->RowCount++;

		// Set up key count
		$charge_group_list->KeyCount = $charge_group_list->RowIndex;

		// Init row class and style
		$charge_group->resetAttributes();
		$charge_group->CssClass = "";
		if ($charge_group_list->isGridAdd()) {
		} else {
			$charge_group_list->loadRowValues($charge_group_list->Recordset); // Load row values
		}
		$charge_group->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$charge_group->RowAttrs->merge(["data-rowindex" => $charge_group_list->RowCount, "id" => "r" . $charge_group_list->RowCount . "_charge_group", "data-rowtype" => $charge_group->RowType]);

		// Render row
		$charge_group_list->renderRow();

		// Render list options
		$charge_group_list->renderListOptions();
?>
	<tr <?php echo $charge_group->rowAttributes() ?>>
<?php

// Render list options (body, left)
$charge_group_list->ListOptions->render("body", "left", $charge_group_list->RowCount);
?>
	<?php if ($charge_group_list->ChargeGroup->Visible) { // ChargeGroup ?>
		<td data-name="ChargeGroup" <?php echo $charge_group_list->ChargeGroup->cellAttributes() ?>>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroup">
<span<?php echo $charge_group_list->ChargeGroup->viewAttributes() ?>><?php echo $charge_group_list->ChargeGroup->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_group_list->ChargeGroupDesc->Visible) { // ChargeGroupDesc ?>
		<td data-name="ChargeGroupDesc" <?php echo $charge_group_list->ChargeGroupDesc->cellAttributes() ?>>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_ChargeGroupDesc">
<span<?php echo $charge_group_list->ChargeGroupDesc->viewAttributes() ?>><?php echo $charge_group_list->ChargeGroupDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_group_list->Charges->Visible) { // Charges ?>
		<td data-name="Charges" <?php echo $charge_group_list->Charges->cellAttributes() ?>>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_Charges">
<span<?php echo $charge_group_list->Charges->viewAttributes() ?>><?php echo $charge_group_list->Charges->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($charge_group_list->Account->Visible) { // Account ?>
		<td data-name="Account" <?php echo $charge_group_list->Account->cellAttributes() ?>>
<span id="el<?php echo $charge_group_list->RowCount ?>_charge_group_Account">
<span<?php echo $charge_group_list->Account->viewAttributes() ?>><?php echo $charge_group_list->Account->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$charge_group_list->ListOptions->render("body", "right", $charge_group_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$charge_group_list->isGridAdd())
		$charge_group_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$charge_group->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($charge_group_list->Recordset)
	$charge_group_list->Recordset->Close();
?>
<?php if (!$charge_group_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$charge_group_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $charge_group_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $charge_group_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($charge_group_list->TotalRecords == 0 && !$charge_group->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $charge_group_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$charge_group_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$charge_group_list->isExport()) { ?>
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
$charge_group_list->terminate();
?>