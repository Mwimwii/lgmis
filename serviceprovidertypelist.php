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
$serviceprovidertype_list = new serviceprovidertype_list();

// Run the page
$serviceprovidertype_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$serviceprovidertype_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$serviceprovidertype_list->isExport()) { ?>
<script>
var fserviceprovidertypelist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	fserviceprovidertypelist = currentForm = new ew.Form("fserviceprovidertypelist", "list");
	fserviceprovidertypelist.formKeyCountName = '<?php echo $serviceprovidertype_list->FormKeyCountName ?>';
	loadjs.done("fserviceprovidertypelist");
});
var fserviceprovidertypelistsrch;
loadjs.ready("head", function() {

	// Form object for search
	fserviceprovidertypelistsrch = currentSearchForm = new ew.Form("fserviceprovidertypelistsrch");

	// Dynamic selection lists
	// Filters

	fserviceprovidertypelistsrch.filterList = <?php echo $serviceprovidertype_list->getFilterList() ?>;

	// Init search panel as collapsed
	fserviceprovidertypelistsrch.initSearchPanel = true;
	loadjs.done("fserviceprovidertypelistsrch");
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
<?php if (!$serviceprovidertype_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($serviceprovidertype_list->TotalRecords > 0 && $serviceprovidertype_list->ExportOptions->visible()) { ?>
<?php $serviceprovidertype_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($serviceprovidertype_list->ImportOptions->visible()) { ?>
<?php $serviceprovidertype_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($serviceprovidertype_list->SearchOptions->visible()) { ?>
<?php $serviceprovidertype_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($serviceprovidertype_list->FilterOptions->visible()) { ?>
<?php $serviceprovidertype_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
$serviceprovidertype_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$serviceprovidertype_list->isExport() && !$serviceprovidertype->CurrentAction) { ?>
<form name="fserviceprovidertypelistsrch" id="fserviceprovidertypelistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="fserviceprovidertypelistsrch-search-panel" class="<?php echo $serviceprovidertype_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="serviceprovidertype">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $serviceprovidertype_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($serviceprovidertype_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($serviceprovidertype_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $serviceprovidertype_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($serviceprovidertype_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($serviceprovidertype_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($serviceprovidertype_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($serviceprovidertype_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $serviceprovidertype_list->showPageHeader(); ?>
<?php
$serviceprovidertype_list->showMessage();
?>
<?php if ($serviceprovidertype_list->TotalRecords > 0 || $serviceprovidertype->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($serviceprovidertype_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> serviceprovidertype">
<?php if (!$serviceprovidertype_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$serviceprovidertype_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $serviceprovidertype_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $serviceprovidertype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fserviceprovidertypelist" id="fserviceprovidertypelist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="serviceprovidertype">
<div id="gmp_serviceprovidertype" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($serviceprovidertype_list->TotalRecords > 0 || $serviceprovidertype_list->isGridEdit()) { ?>
<table id="tbl_serviceprovidertypelist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$serviceprovidertype->RowType = ROWTYPE_HEADER;

// Render list options
$serviceprovidertype_list->renderListOptions();

// Render list options (header, left)
$serviceprovidertype_list->ListOptions->render("header", "left");
?>
<?php if ($serviceprovidertype_list->ServiceProviderType->Visible) { // ServiceProviderType ?>
	<?php if ($serviceprovidertype_list->SortUrl($serviceprovidertype_list->ServiceProviderType) == "") { ?>
		<th data-name="ServiceProviderType" class="<?php echo $serviceprovidertype_list->ServiceProviderType->headerCellClass() ?>"><div id="elh_serviceprovidertype_ServiceProviderType" class="serviceprovidertype_ServiceProviderType"><div class="ew-table-header-caption"><?php echo $serviceprovidertype_list->ServiceProviderType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ServiceProviderType" class="<?php echo $serviceprovidertype_list->ServiceProviderType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $serviceprovidertype_list->SortUrl($serviceprovidertype_list->ServiceProviderType) ?>', 1);"><div id="elh_serviceprovidertype_ServiceProviderType" class="serviceprovidertype_ServiceProviderType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $serviceprovidertype_list->ServiceProviderType->caption() ?></span><span class="ew-table-header-sort"><?php if ($serviceprovidertype_list->ServiceProviderType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($serviceprovidertype_list->ServiceProviderType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($serviceprovidertype_list->SPTypeDesc->Visible) { // SPTypeDesc ?>
	<?php if ($serviceprovidertype_list->SortUrl($serviceprovidertype_list->SPTypeDesc) == "") { ?>
		<th data-name="SPTypeDesc" class="<?php echo $serviceprovidertype_list->SPTypeDesc->headerCellClass() ?>"><div id="elh_serviceprovidertype_SPTypeDesc" class="serviceprovidertype_SPTypeDesc"><div class="ew-table-header-caption"><?php echo $serviceprovidertype_list->SPTypeDesc->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="SPTypeDesc" class="<?php echo $serviceprovidertype_list->SPTypeDesc->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $serviceprovidertype_list->SortUrl($serviceprovidertype_list->SPTypeDesc) ?>', 1);"><div id="elh_serviceprovidertype_SPTypeDesc" class="serviceprovidertype_SPTypeDesc">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $serviceprovidertype_list->SPTypeDesc->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($serviceprovidertype_list->SPTypeDesc->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($serviceprovidertype_list->SPTypeDesc->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$serviceprovidertype_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($serviceprovidertype_list->ExportAll && $serviceprovidertype_list->isExport()) {
	$serviceprovidertype_list->StopRecord = $serviceprovidertype_list->TotalRecords;
} else {

	// Set the last record to display
	if ($serviceprovidertype_list->TotalRecords > $serviceprovidertype_list->StartRecord + $serviceprovidertype_list->DisplayRecords - 1)
		$serviceprovidertype_list->StopRecord = $serviceprovidertype_list->StartRecord + $serviceprovidertype_list->DisplayRecords - 1;
	else
		$serviceprovidertype_list->StopRecord = $serviceprovidertype_list->TotalRecords;
}
$serviceprovidertype_list->RecordCount = $serviceprovidertype_list->StartRecord - 1;
if ($serviceprovidertype_list->Recordset && !$serviceprovidertype_list->Recordset->EOF) {
	$serviceprovidertype_list->Recordset->moveFirst();
	$selectLimit = $serviceprovidertype_list->UseSelectLimit;
	if (!$selectLimit && $serviceprovidertype_list->StartRecord > 1)
		$serviceprovidertype_list->Recordset->move($serviceprovidertype_list->StartRecord - 1);
} elseif (!$serviceprovidertype->AllowAddDeleteRow && $serviceprovidertype_list->StopRecord == 0) {
	$serviceprovidertype_list->StopRecord = $serviceprovidertype->GridAddRowCount;
}

// Initialize aggregate
$serviceprovidertype->RowType = ROWTYPE_AGGREGATEINIT;
$serviceprovidertype->resetAttributes();
$serviceprovidertype_list->renderRow();
while ($serviceprovidertype_list->RecordCount < $serviceprovidertype_list->StopRecord) {
	$serviceprovidertype_list->RecordCount++;
	if ($serviceprovidertype_list->RecordCount >= $serviceprovidertype_list->StartRecord) {
		$serviceprovidertype_list->RowCount++;

		// Set up key count
		$serviceprovidertype_list->KeyCount = $serviceprovidertype_list->RowIndex;

		// Init row class and style
		$serviceprovidertype->resetAttributes();
		$serviceprovidertype->CssClass = "";
		if ($serviceprovidertype_list->isGridAdd()) {
		} else {
			$serviceprovidertype_list->loadRowValues($serviceprovidertype_list->Recordset); // Load row values
		}
		$serviceprovidertype->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$serviceprovidertype->RowAttrs->merge(["data-rowindex" => $serviceprovidertype_list->RowCount, "id" => "r" . $serviceprovidertype_list->RowCount . "_serviceprovidertype", "data-rowtype" => $serviceprovidertype->RowType]);

		// Render row
		$serviceprovidertype_list->renderRow();

		// Render list options
		$serviceprovidertype_list->renderListOptions();
?>
	<tr <?php echo $serviceprovidertype->rowAttributes() ?>>
<?php

// Render list options (body, left)
$serviceprovidertype_list->ListOptions->render("body", "left", $serviceprovidertype_list->RowCount);
?>
	<?php if ($serviceprovidertype_list->ServiceProviderType->Visible) { // ServiceProviderType ?>
		<td data-name="ServiceProviderType" <?php echo $serviceprovidertype_list->ServiceProviderType->cellAttributes() ?>>
<span id="el<?php echo $serviceprovidertype_list->RowCount ?>_serviceprovidertype_ServiceProviderType">
<span<?php echo $serviceprovidertype_list->ServiceProviderType->viewAttributes() ?>><?php echo $serviceprovidertype_list->ServiceProviderType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($serviceprovidertype_list->SPTypeDesc->Visible) { // SPTypeDesc ?>
		<td data-name="SPTypeDesc" <?php echo $serviceprovidertype_list->SPTypeDesc->cellAttributes() ?>>
<span id="el<?php echo $serviceprovidertype_list->RowCount ?>_serviceprovidertype_SPTypeDesc">
<span<?php echo $serviceprovidertype_list->SPTypeDesc->viewAttributes() ?>><?php echo $serviceprovidertype_list->SPTypeDesc->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$serviceprovidertype_list->ListOptions->render("body", "right", $serviceprovidertype_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$serviceprovidertype_list->isGridAdd())
		$serviceprovidertype_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$serviceprovidertype->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($serviceprovidertype_list->Recordset)
	$serviceprovidertype_list->Recordset->Close();
?>
<?php if (!$serviceprovidertype_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$serviceprovidertype_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $serviceprovidertype_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $serviceprovidertype_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($serviceprovidertype_list->TotalRecords == 0 && !$serviceprovidertype->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $serviceprovidertype_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$serviceprovidertype_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$serviceprovidertype_list->isExport()) { ?>
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
$serviceprovidertype_list->terminate();
?>