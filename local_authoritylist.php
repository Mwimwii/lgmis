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
$local_authority_list = new local_authority_list();

// Run the page
$local_authority_list->run();

// Setup login status
SetupLoginStatus();
SetClientVar("login", LoginStatus());

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$local_authority_list->Page_Render();
?>
<?php include_once "header.php"; ?>
<?php if (!$local_authority_list->isExport()) { ?>
<script>
var flocal_authoritylist, currentPageID;
loadjs.ready("head", function() {

	// Form object
	currentPageID = ew.PAGE_ID = "list";
	flocal_authoritylist = currentForm = new ew.Form("flocal_authoritylist", "list");
	flocal_authoritylist.formKeyCountName = '<?php echo $local_authority_list->FormKeyCountName ?>';
	loadjs.done("flocal_authoritylist");
});
var flocal_authoritylistsrch;
loadjs.ready("head", function() {

	// Form object for search
	flocal_authoritylistsrch = currentSearchForm = new ew.Form("flocal_authoritylistsrch");

	// Dynamic selection lists
	// Filters

	flocal_authoritylistsrch.filterList = <?php echo $local_authority_list->getFilterList() ?>;

	// Init search panel as collapsed
	flocal_authoritylistsrch.initSearchPanel = true;
	loadjs.done("flocal_authoritylistsrch");
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
<?php if (!$local_authority_list->isExport()) { ?>
<div class="btn-toolbar ew-toolbar">
<?php if ($local_authority_list->TotalRecords > 0 && $local_authority_list->ExportOptions->visible()) { ?>
<?php $local_authority_list->ExportOptions->render("body") ?>
<?php } ?>
<?php if ($local_authority_list->ImportOptions->visible()) { ?>
<?php $local_authority_list->ImportOptions->render("body") ?>
<?php } ?>
<?php if ($local_authority_list->SearchOptions->visible()) { ?>
<?php $local_authority_list->SearchOptions->render("body") ?>
<?php } ?>
<?php if ($local_authority_list->FilterOptions->visible()) { ?>
<?php $local_authority_list->FilterOptions->render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (!$local_authority_list->isExport() || Config("EXPORT_MASTER_RECORD") && $local_authority_list->isExport("print")) { ?>
<?php
if ($local_authority_list->DbMasterFilter != "" && $local_authority->getCurrentMasterTable() == "province") {
	if ($local_authority_list->MasterRecordExists) {
		include_once "provincemaster.php";
	}
}
?>
<?php } ?>
<?php
$local_authority_list->renderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if (!$local_authority_list->isExport() && !$local_authority->CurrentAction) { ?>
<form name="flocal_authoritylistsrch" id="flocal_authoritylistsrch" class="form-inline ew-form ew-ext-search-form" action="<?php echo CurrentPageName() ?>">
<div id="flocal_authoritylistsrch-search-panel" class="<?php echo $local_authority_list->SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="local_authority">
	<div class="ew-extended-search">
<div id="xsr_<?php echo $local_authority_list->SearchRowCount + 1 ?>" class="ew-row d-sm-flex">
	<div class="ew-quick-search input-group">
		<input type="text" name="<?php echo Config("TABLE_BASIC_SEARCH") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH") ?>" class="form-control" value="<?php echo HtmlEncode($local_authority_list->BasicSearch->getKeyword()) ?>" placeholder="<?php echo HtmlEncode($Language->phrase("Search")) ?>">
		<input type="hidden" name="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" id="<?php echo Config("TABLE_BASIC_SEARCH_TYPE") ?>" value="<?php echo HtmlEncode($local_authority_list->BasicSearch->getType()) ?>">
		<div class="input-group-append">
			<button class="btn btn-primary" name="btn-submit" id="btn-submit" type="submit"><?php echo $Language->phrase("SearchBtn") ?></button>
			<button type="button" data-toggle="dropdown" class="btn btn-primary dropdown-toggle dropdown-toggle-split" aria-haspopup="true" aria-expanded="false"><span id="searchtype"><?php echo $local_authority_list->BasicSearch->getTypeNameShort() ?></span></button>
			<div class="dropdown-menu dropdown-menu-right">
				<a class="dropdown-item<?php if ($local_authority_list->BasicSearch->getType() == "") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this);"><?php echo $Language->phrase("QuickSearchAuto") ?></a>
				<a class="dropdown-item<?php if ($local_authority_list->BasicSearch->getType() == "=") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, '=');"><?php echo $Language->phrase("QuickSearchExact") ?></a>
				<a class="dropdown-item<?php if ($local_authority_list->BasicSearch->getType() == "AND") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'AND');"><?php echo $Language->phrase("QuickSearchAll") ?></a>
				<a class="dropdown-item<?php if ($local_authority_list->BasicSearch->getType() == "OR") { ?> active<?php } ?>" href="#" onclick="return ew.setSearchType(this, 'OR');"><?php echo $Language->phrase("QuickSearchAny") ?></a>
			</div>
		</div>
	</div>
</div>
	</div><!-- /.ew-extended-search -->
</div><!-- /.ew-search-panel -->
</form>
<?php } ?>
<?php } ?>
<?php $local_authority_list->showPageHeader(); ?>
<?php
$local_authority_list->showMessage();
?>
<?php if ($local_authority_list->TotalRecords > 0 || $local_authority->CurrentAction) { ?>
<div class="card ew-card ew-grid<?php if ($local_authority_list->isAddOrEdit()) { ?> ew-grid-add-edit<?php } ?> local_authority">
<?php if (!$local_authority_list->isExport()) { ?>
<div class="card-header ew-grid-upper-panel">
<?php if (!$local_authority_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $local_authority_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $local_authority_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="flocal_authoritylist" id="flocal_authoritylist" class="form-inline ew-form ew-list-form" action="<?php echo CurrentPageName() ?>" method="post">
<?php if ($Page->CheckToken) { ?>
<input type="hidden" name="<?php echo Config("TOKEN_NAME") ?>" value="<?php echo $Page->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="local_authority">
<?php if ($local_authority->getCurrentMasterTable() == "province" && $local_authority->CurrentAction) { ?>
<input type="hidden" name="<?php echo Config("TABLE_SHOW_MASTER") ?>" value="province">
<input type="hidden" name="fk_ProvinceCode" value="<?php echo HtmlEncode($local_authority_list->ProvinceCode->getSessionValue()) ?>">
<?php } ?>
<div id="gmp_local_authority" class="<?php echo ResponsiveTableClass() ?>card-body ew-grid-middle-panel">
<?php if ($local_authority_list->TotalRecords > 0 || $local_authority_list->isGridEdit()) { ?>
<table id="tbl_local_authoritylist" class="table ew-table"><!-- .ew-table -->
<thead>
	<tr class="ew-table-header">
<?php

// Header row
$local_authority->RowType = ROWTYPE_HEADER;

// Render list options
$local_authority_list->renderListOptions();

// Render list options (header, left)
$local_authority_list->ListOptions->render("header", "left");
?>
<?php if ($local_authority_list->LAName->Visible) { // LAName ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->LAName) == "") { ?>
		<th data-name="LAName" class="<?php echo $local_authority_list->LAName->headerCellClass() ?>"><div id="elh_local_authority_LAName" class="local_authority_LAName"><div class="ew-table-header-caption"><?php echo $local_authority_list->LAName->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="LAName" class="<?php echo $local_authority_list->LAName->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->LAName) ?>', 1);"><div id="elh_local_authority_LAName" class="local_authority_LAName">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->LAName->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->LAName->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->LAName->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->CouncilType->Visible) { // CouncilType ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->CouncilType) == "") { ?>
		<th data-name="CouncilType" class="<?php echo $local_authority_list->CouncilType->headerCellClass() ?>"><div id="elh_local_authority_CouncilType" class="local_authority_CouncilType"><div class="ew-table-header-caption"><?php echo $local_authority_list->CouncilType->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="CouncilType" class="<?php echo $local_authority_list->CouncilType->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->CouncilType) ?>', 1);"><div id="elh_local_authority_CouncilType" class="local_authority_CouncilType">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->CouncilType->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->CouncilType->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->CouncilType->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->ProvinceCode->Visible) { // ProvinceCode ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->ProvinceCode) == "") { ?>
		<th data-name="ProvinceCode" class="<?php echo $local_authority_list->ProvinceCode->headerCellClass() ?>"><div id="elh_local_authority_ProvinceCode" class="local_authority_ProvinceCode"><div class="ew-table-header-caption"><?php echo $local_authority_list->ProvinceCode->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ProvinceCode" class="<?php echo $local_authority_list->ProvinceCode->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->ProvinceCode) ?>', 1);"><div id="elh_local_authority_ProvinceCode" class="local_authority_ProvinceCode">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->ProvinceCode->caption() ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->ProvinceCode->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->ProvinceCode->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->Clients->Visible) { // Clients ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->Clients) == "") { ?>
		<th data-name="Clients" class="<?php echo $local_authority_list->Clients->headerCellClass() ?>"><div id="elh_local_authority_Clients" class="local_authority_Clients"><div class="ew-table-header-caption"><?php echo $local_authority_list->Clients->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Clients" class="<?php echo $local_authority_list->Clients->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->Clients) ?>', 1);"><div id="elh_local_authority_Clients" class="local_authority_Clients">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->Clients->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->Clients->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->Clients->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->Beneficiaries->Visible) { // Beneficiaries ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->Beneficiaries) == "") { ?>
		<th data-name="Beneficiaries" class="<?php echo $local_authority_list->Beneficiaries->headerCellClass() ?>"><div id="elh_local_authority_Beneficiaries" class="local_authority_Beneficiaries"><div class="ew-table-header-caption"><?php echo $local_authority_list->Beneficiaries->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Beneficiaries" class="<?php echo $local_authority_list->Beneficiaries->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->Beneficiaries) ?>', 1);"><div id="elh_local_authority_Beneficiaries" class="local_authority_Beneficiaries">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->Beneficiaries->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->Beneficiaries->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->Beneficiaries->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->ExecutiveAuthority) == "") { ?>
		<th data-name="ExecutiveAuthority" class="<?php echo $local_authority_list->ExecutiveAuthority->headerCellClass() ?>"><div id="elh_local_authority_ExecutiveAuthority" class="local_authority_ExecutiveAuthority"><div class="ew-table-header-caption"><?php echo $local_authority_list->ExecutiveAuthority->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ExecutiveAuthority" class="<?php echo $local_authority_list->ExecutiveAuthority->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->ExecutiveAuthority) ?>', 1);"><div id="elh_local_authority_ExecutiveAuthority" class="local_authority_ExecutiveAuthority">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->ExecutiveAuthority->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->ExecutiveAuthority->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->ExecutiveAuthority->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->ControllingOfficer->Visible) { // ControllingOfficer ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->ControllingOfficer) == "") { ?>
		<th data-name="ControllingOfficer" class="<?php echo $local_authority_list->ControllingOfficer->headerCellClass() ?>"><div id="elh_local_authority_ControllingOfficer" class="local_authority_ControllingOfficer"><div class="ew-table-header-caption"><?php echo $local_authority_list->ControllingOfficer->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ControllingOfficer" class="<?php echo $local_authority_list->ControllingOfficer->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->ControllingOfficer) ?>', 1);"><div id="elh_local_authority_ControllingOfficer" class="local_authority_ControllingOfficer">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->ControllingOfficer->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->ControllingOfficer->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->ControllingOfficer->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($local_authority_list->Comment->Visible) { // Comment ?>
	<?php if ($local_authority_list->SortUrl($local_authority_list->Comment) == "") { ?>
		<th data-name="Comment" class="<?php echo $local_authority_list->Comment->headerCellClass() ?>"><div id="elh_local_authority_Comment" class="local_authority_Comment"><div class="ew-table-header-caption"><?php echo $local_authority_list->Comment->caption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Comment" class="<?php echo $local_authority_list->Comment->headerCellClass() ?>"><div class="ew-pointer" onclick="ew.sort(event, '<?php echo $local_authority_list->SortUrl($local_authority_list->Comment) ?>', 1);"><div id="elh_local_authority_Comment" class="local_authority_Comment">
			<div class="ew-table-header-btn"><span class="ew-table-header-caption"><?php echo $local_authority_list->Comment->caption() ?><?php echo $Language->phrase("SrchLegend") ?></span><span class="ew-table-header-sort"><?php if ($local_authority_list->Comment->getSort() == "ASC") { ?><i class="fas fa-sort-up"></i><?php } elseif ($local_authority_list->Comment->getSort() == "DESC") { ?><i class="fas fa-sort-down"></i><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$local_authority_list->ListOptions->render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($local_authority_list->ExportAll && $local_authority_list->isExport()) {
	$local_authority_list->StopRecord = $local_authority_list->TotalRecords;
} else {

	// Set the last record to display
	if ($local_authority_list->TotalRecords > $local_authority_list->StartRecord + $local_authority_list->DisplayRecords - 1)
		$local_authority_list->StopRecord = $local_authority_list->StartRecord + $local_authority_list->DisplayRecords - 1;
	else
		$local_authority_list->StopRecord = $local_authority_list->TotalRecords;
}
$local_authority_list->RecordCount = $local_authority_list->StartRecord - 1;
if ($local_authority_list->Recordset && !$local_authority_list->Recordset->EOF) {
	$local_authority_list->Recordset->moveFirst();
	$selectLimit = $local_authority_list->UseSelectLimit;
	if (!$selectLimit && $local_authority_list->StartRecord > 1)
		$local_authority_list->Recordset->move($local_authority_list->StartRecord - 1);
} elseif (!$local_authority->AllowAddDeleteRow && $local_authority_list->StopRecord == 0) {
	$local_authority_list->StopRecord = $local_authority->GridAddRowCount;
}

// Initialize aggregate
$local_authority->RowType = ROWTYPE_AGGREGATEINIT;
$local_authority->resetAttributes();
$local_authority_list->renderRow();
while ($local_authority_list->RecordCount < $local_authority_list->StopRecord) {
	$local_authority_list->RecordCount++;
	if ($local_authority_list->RecordCount >= $local_authority_list->StartRecord) {
		$local_authority_list->RowCount++;

		// Set up key count
		$local_authority_list->KeyCount = $local_authority_list->RowIndex;

		// Init row class and style
		$local_authority->resetAttributes();
		$local_authority->CssClass = "";
		if ($local_authority_list->isGridAdd()) {
		} else {
			$local_authority_list->loadRowValues($local_authority_list->Recordset); // Load row values
		}
		$local_authority->RowType = ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$local_authority->RowAttrs->merge(["data-rowindex" => $local_authority_list->RowCount, "id" => "r" . $local_authority_list->RowCount . "_local_authority", "data-rowtype" => $local_authority->RowType]);

		// Render row
		$local_authority_list->renderRow();

		// Render list options
		$local_authority_list->renderListOptions();
?>
	<tr <?php echo $local_authority->rowAttributes() ?>>
<?php

// Render list options (body, left)
$local_authority_list->ListOptions->render("body", "left", $local_authority_list->RowCount);
?>
	<?php if ($local_authority_list->LAName->Visible) { // LAName ?>
		<td data-name="LAName" <?php echo $local_authority_list->LAName->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_LAName">
<span<?php echo $local_authority_list->LAName->viewAttributes() ?>><?php echo $local_authority_list->LAName->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->CouncilType->Visible) { // CouncilType ?>
		<td data-name="CouncilType" <?php echo $local_authority_list->CouncilType->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_CouncilType">
<span<?php echo $local_authority_list->CouncilType->viewAttributes() ?>><?php echo $local_authority_list->CouncilType->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->ProvinceCode->Visible) { // ProvinceCode ?>
		<td data-name="ProvinceCode" <?php echo $local_authority_list->ProvinceCode->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_ProvinceCode">
<span<?php echo $local_authority_list->ProvinceCode->viewAttributes() ?>><?php echo $local_authority_list->ProvinceCode->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->Clients->Visible) { // Clients ?>
		<td data-name="Clients" <?php echo $local_authority_list->Clients->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_Clients">
<span<?php echo $local_authority_list->Clients->viewAttributes() ?>><?php echo $local_authority_list->Clients->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->Beneficiaries->Visible) { // Beneficiaries ?>
		<td data-name="Beneficiaries" <?php echo $local_authority_list->Beneficiaries->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_Beneficiaries">
<span<?php echo $local_authority_list->Beneficiaries->viewAttributes() ?>><?php echo $local_authority_list->Beneficiaries->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->ExecutiveAuthority->Visible) { // ExecutiveAuthority ?>
		<td data-name="ExecutiveAuthority" <?php echo $local_authority_list->ExecutiveAuthority->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_ExecutiveAuthority">
<span<?php echo $local_authority_list->ExecutiveAuthority->viewAttributes() ?>><?php echo $local_authority_list->ExecutiveAuthority->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->ControllingOfficer->Visible) { // ControllingOfficer ?>
		<td data-name="ControllingOfficer" <?php echo $local_authority_list->ControllingOfficer->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_ControllingOfficer">
<span<?php echo $local_authority_list->ControllingOfficer->viewAttributes() ?>><?php echo $local_authority_list->ControllingOfficer->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($local_authority_list->Comment->Visible) { // Comment ?>
		<td data-name="Comment" <?php echo $local_authority_list->Comment->cellAttributes() ?>>
<span id="el<?php echo $local_authority_list->RowCount ?>_local_authority_Comment">
<span<?php echo $local_authority_list->Comment->viewAttributes() ?>><?php echo $local_authority_list->Comment->getViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$local_authority_list->ListOptions->render("body", "right", $local_authority_list->RowCount);
?>
	</tr>
<?php
	}
	if (!$local_authority_list->isGridAdd())
		$local_authority_list->Recordset->moveNext();
}
?>
</tbody>
</table><!-- /.ew-table -->
<?php } ?>
</div><!-- /.ew-grid-middle-panel -->
<?php if (!$local_authority->CurrentAction) { ?>
<input type="hidden" name="action" id="action" value="">
<?php } ?>
</form><!-- /.ew-list-form -->
<?php

// Close recordset
if ($local_authority_list->Recordset)
	$local_authority_list->Recordset->Close();
?>
<?php if (!$local_authority_list->isExport()) { ?>
<div class="card-footer ew-grid-lower-panel">
<?php if (!$local_authority_list->isGridAdd()) { ?>
<form name="ew-pager-form" class="form-inline ew-form ew-pager-form" action="<?php echo CurrentPageName() ?>">
<?php echo $local_authority_list->Pager->render() ?>
</form>
<?php } ?>
<div class="ew-list-other-options">
<?php $local_authority_list->OtherOptions->render("body", "bottom") ?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div><!-- /.ew-grid -->
<?php } ?>
<?php if ($local_authority_list->TotalRecords == 0 && !$local_authority->CurrentAction) { // Show other options ?>
<div class="ew-list-other-options">
<?php $local_authority_list->OtherOptions->render("body") ?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php
$local_authority_list->showPageFooter();
if (Config("DEBUG"))
	echo GetDebugMessage();
?>
<?php if (!$local_authority_list->isExport()) { ?>
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
$local_authority_list->terminate();
?>